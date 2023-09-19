var MobileApp = (function () {

	var $this = {};
    var pushTokenCookieName = 'appPushToken';
    var userId = 0;
    var isActive = true;

    var iapUrl = null;
    var iapUrlGoogle = '_pay/iapgoogle/after.php';
    var iapUrlApple = '_pay/iapapple/after.php';

    $this.isTokenUpdateRequired = false;
    $this.iapInitialized = false;

    $this.iapTransactionInProcess = {};

    function bindEvents() {
        document.addEventListener('pause', onPause, false);
        document.addEventListener('resume', onResume, false);
        document.addEventListener('deviceready', hideSplashscreen, false);
		if(typeof inAppPurchaseProducts === 'object') {
			document.addEventListener('deviceready', initInAppPurchase, false);
        }
    }

    function onPause() {
        isActive = false;
    };

    function onResume() {
        isActive = true;
    };

    function hideSplashscreen()
    {
        if($this.isAndroid()) {
            navigator.splashscreen.hide();
        }
    }

    $this.init = function(userId)
    {
        bindEvents();
        appSetExternalUrlHandler();
        if(!$this.isAndroid()) {
            // disable for ios webview
            document.ondragstart = function(){ return false; };
            disableHoverStyles();
        }

        // for compatibility with old templates
        if(userId !== false) {
            document.addEventListener(
                'deviceready',
                function(){
                    $(function(){
                        $this.initPushNotifications(userId);
                    });

                    if(typeof adMobBannerConfig !== 'undefined') {
                        showAdmobBanner(adMobBannerConfig);
                    }
                },
                false
            );
        }
    }

    $this.initPushNotifications = function(currentUserId) {

        console.log('MobileApp.initPushNotifications START', currentUserId);

        $this.pushPlugin = window.FirebasePlugin;

        userId = Number.parseInt(currentUserId);

        if(userId) {

            $this.pushPlugin.hasPermission(function(hasPermission){
				if(!hasPermission) {
                    $this.pushPlugin.grantPermission(function(hasPermission){
						console.log("$this.pushPlugin.grantPermission > Notifications permission was " + (hasPermission ? "granted" : "denied"));
					});
                }
            });

            $this.pushPlugin.isAutoInitEnabled(function(enabled){
                if(!enabled) {
                    $this.pushPlugin.setAutoInitEnabled(true);
                }
            });

            $this.pushPlugin.onTokenRefresh(
                $this.saveToken,
                function(error) {
                    console.log(error);
                }
            );

            $this.pushPlugin.onMessageReceived(function(message) {
                console.log(message);
                if(message.messageType === 'notification' && message.tap) {

                    var url = '';

                    var type = message.type;
                    var userFrom = message.userFrom || 0;

                    var urls = {
                            im : 'messages.php?display=one_chat&user_id=' + userFrom,
                            city : urlCity + 'index.php?view=mobile&from=' + userFrom,
                        };

                    if (tmplCurrent == 'edge') {
                        urls.city = urlPageCity + '?from=' + userFrom;
                        if (type == 'im') {
                            var groupUserId=0, groupId=0;
                            if (message.group_user_id && message.group_id) {
                                groupUserId=message['group_user_id'];
                                groupId=message['group_id'];
                            }
                            clMessages.openMessagesFromAppNotifications(userFrom, groupUserId, groupId);
                            return;
                        }
                    }
                    if(type == 'city'){
                        openMessagesCityFromAppNotifications(userFrom, urls['city']);
                        return;
                    }

                    // disabled due too long time for loading
                    urls.city = null;

                    if (message.url) {
                        url = message.url;
                    } else if (type == 'im' && appCurrentImUserId != userFrom) {
                        url = urls.im;
                    } else if (type in urls) {
                        url = urls[type];
                    }

                    if (url) {

                        var currentPage = document.location.href.split('#')[0];
                        var redirectPage = url.split('#')[0];
                        if(currentPage != redirectPage) {
                            appPreloaderShow();
                        }

                        setTimeout(function(){document.location.href = url;}, 100);
                    }
                    // else update content before show to user - it can contain old data

                    console.log("Notification message received");
                    if(message.tap){
                        console.log("Tapped in " + message.tap);
                    }
                }
            }, function(error) {
                //alert('onNotificationOpen ERROR');
                console.error(error);
            });

            //TODO: get token by timer every 10 seconds till correct value
            $this.updateTokenInfo();
            console.log('MobileApp.initPushNotifications FINISH', userId);
        } else {
            $this.pushNotificationsOff();
            console.log('MobileApp.initPushNotifications OFF', currentUserId);
        }

        console.log('MobileApp.initPushNotifications END', currentUserId);
    };

    // get token depend on app version

    $this.updateTokenInfo = function() {

        // run by timer till success response

        $this.pushPlugin.getToken(
            $this.saveToken,
            function(error) {
                console.error(error);
            }
        );
    };

    $this.saveToken = function(token) {

        var oldToken = getTokenFromCookie();
        if(token && (!oldToken || oldToken.token !== token || oldToken.userId !== userId || $this.isTokenUpdateRequired)) {

            var params = {
                    cmd: 'mobile_app_push_token_add',
                    token: token,
                    oldToken: JSON.stringify(oldToken)
                };

            var callback = function(data) {
                if(data && data === true) {
                    if(userId) {
                        $this.isTokenUpdateRequired = false;
                        saveTokenInCookie(token);
                    } else {
                        $this.deleteTokenFromSite();
                    }
                }
            };

            $this.sendRequestToSite(params, callback);
        }
    };

    $this.deleteTokenFromSite = function() {

        var tokenInfo = getTokenFromCookie();
        if(tokenInfo) {

            var params = {
                    cmd: 'mobile_app_push_token_delete',
                    token: tokenInfo.token,
                    userId: tokenInfo.userId
                };

            var callback = function(data) {
                if(data && data === true) {
                    $.removeCookie(pushTokenCookieName);
                }
            };

            $this.sendRequestToSite(params, callback);
        }
    };

    $this.sendRequestToSite = function(params, callback, url, prepareUrl)
    {
        var url = defaultFunctionParamValue(url, 'ajax.php');
        var prepareUrl = defaultFunctionParamValue(prepareUrl, true);

        if(prepareUrl && tmplCurrent != 'edge') {
            url = '../' + url;
        }

        $.post(
            url,
            params,
            function(response) {
                var data = getDataAjax(response, 'data');
                callback(data);
            }
        );
    };


    function saveTokenInCookie(token)
    {
        if(token) {
            var tokenInfo = {token: token, userId: userId};
            $.cookie(pushTokenCookieName, JSON.stringify(tokenInfo));
        }
    }

    function getTokenFromCookie()
    {
        var data = false;

        var tokenInfo = $.cookie(pushTokenCookieName);
        if(tokenInfo) {
            data = JSON.parse(tokenInfo);
        }

        return data;
    }

    function disableHoverStyles()
    {
        try {
            for (var si in document.styleSheets) {
                var styleSheet = document.styleSheets[si];
                if (!styleSheet.rules) continue;

                for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
                    if (!styleSheet.rules[ri].selectorText) continue;

                    if (styleSheet.rules[ri].selectorText.match(':hover')) {
                        styleSheet.deleteRule(ri);
                    }
                }
            }
        } catch (ex) {}
    }

    $this.pushNotificationsOff = function() {

        $this.pushPlugin.isAutoInitEnabled(function(enabled){
            if(enabled) {
                $this.pushPlugin.setAutoInitEnabled(false, function(){
                    $this.pushPlugin.unregister();
                });
            } else {
                $this.pushPlugin.unregister();
            }
        });

        $this.setBadgeNumber(0);

        $this.deleteTokenFromSite();

    };

    $this.setBadgeNumber = function(number) {
        document.addEventListener(
            'deviceready',
            function(){
                if($this.isAndroid()) {
                    cordova.plugins.notification.badge.get(function(badge) {
                        if(badge != number) {
                            cordova.plugins.notification.badge.set(number);
                        }
                    });
                } else {
                    $this.pushPlugin.setBadgeNumber(number);
                }
            },
            false
        );
    }

	$this.isAndroid = function() {
		return /AppWebview/i.test(navigator.userAgent);
	};

	$this.getAppVersion = function() {
		var version = 0;
		var versionInfo = navigator.userAgent.match(/Webview-(.*)/);
		if(versionInfo) {
			version = versionInfo[1];
		}
		return version;
	}

	$this.getAppVersionMajor = function() {
		var versionMajor = 0;
		var version = $this.getAppVersion();
		if(version) {
			versionInfo = version.split('.');
			versionMajor = Number(versionInfo[0]);
		}
		return versionMajor;
	}

	$this.getAppVersionMinor = function() {
		var versionMinor = 0;
		var version = $this.getAppVersion();
		if(version) {
			versionInfo = version.split('.');
			if(versionInfo.length > 1) {
				versionMinor = Number(versionInfo[1]);
			}
		}
		return versionMinor;
	}

    function initInAppPurchase()
    {
        if(!$this.iapInitialized) {

            console.log('initInAppPurchase');

			// Android 5.5+
			var storePlatform = false;

			if(typeof CdvPurchase !== 'undefined') {
				window.store = CdvPurchase.store;
				storePlatform = ($this.isAndroid() ? CdvPurchase.Platform.GOOGLE_PLAY : CdvPurchase.Platform.APPLE_APPSTORE);
			}

            if (!window.store) {
                console.log('Store not available');
                return;
            }

            store.verbosity = store.DEBUG;

            if($this.isAndroid()) {
                iapUrl = iapUrlGoogle;
            } else {
                iapUrl = iapUrlApple;
            }

            if(tmplCurrent != 'edge') {
                iapUrl = '../' + iapUrl;
            }

            var requestUri = ($('input[name=request_uri]').length > 0 ? $('input[name=request_uri]').val() : '');
            store.validator = iapUrl + '?cmd=verify&request_uri=' + btoa(requestUri);

            store.error(function(error) {
                console.log('ERROR STORE ' + error.code + ': ' + error.message);
                upgradeButtonRestoreLabel();
            });

            $this.inAppPurchaseSetCallbacks();

            for(var index in inAppPurchaseProducts) {
                var inAppPurchaseProduct = inAppPurchaseProducts[index];

				var isProductFound = false;
				if(storePlatform) {
					inAppPurchaseProduct.platform = storePlatform;
					if(store.registeredProducts.find(storePlatform, inAppPurchaseProduct.id)) {
						isProductFound = true;
					}
				} else {
					if(inAppPurchaseProduct.id in store.products.byId) {
						isProductFound = true;
					}
				}

                if(!isProductFound) {
                    store.register(inAppPurchaseProduct);
                }
            }

            $this.iapTransactionInProcess = {};

			if(typeof CdvPurchase !== 'undefined') {
				console.log('run store.initialize()');
				store.initialize();
			} else {
				console.log('run store.refresh()');
				store.refresh();
			}

            $this.iapInitialized = true;
        }

    }

    $this.inAppPurchaseBuy = function(productId) {
		var product = store.get(productId);
		if(typeof CdvPurchase !== 'undefined') {
			product.getOffer().order();
		} else {
			store.order(product);
		}
    }

    $this.inAppPurchaseSetCallbacks = function() {

        console.log('$this.inAppPurchaseSetCallbacks');

        function verifyPurchase(p)
        {
            var product = Object.assign({}, p);
            if('transaction' in product && product.transaction && 'appStoreReceipt' in product.transaction) {
                delete(product.transaction.appStoreReceipt);
                console.log('verifyPurchase DELETE product.transaction.appStoreReceipt');
            } else {
                console.log('verifyPurchase CANNOT DELETE product.transaction.appStoreReceipt');
            }

            console.log(Date(), 'verifyPurchase START', Math.random(), JSON.stringify(p));

//            Test delayed purchase
//            if(window.location.pathname.indexOf('upgrade') !== -1) {
//                console.log('verifyPurchase test return', window.location.pathname);
//                if('transaction' in p && p.transaction !== null && 'id' in p.transaction) {
//                    console.log('verifyPurchase SKIP for verify at next page', p.transaction.id);
//                        return;
//                }
//
//            } else {
//                console.log('verifyPurchase test run', window.location.pathname);
//            }

            // disable additional notifications about subscriptions

			if($this.iapIsReceiptFinished(p)) {
				console.log('verifyPurchase iapIsReceiptFinished');
				return;
			}

            console.log(Date(), 'verifyPurchase approved - start verify', JSON.stringify(p));
            p.verify();
        }

        function finishPurchase(p) {

			console.log(Date(), 'finishPurchase START', JSON.stringify(p));
            var localStorageReceiptKey = null;

			if(typeof CdvPurchase !== 'undefined') {
				p.transaction = p.sourceReceipt.transactions[0].nativePurchase;
				p.transaction.id = p.transaction.orderId;
				p.id = p.transaction.productId;
			}

            console.log(Date(), 'finishPurchase INIT', ((p.transaction && p.transaction.id) ? p.transaction.id : 'no transaction id'), (p.transactions ? p.transactions : 'no transactions'));

			if($this.iapIsReceiptFinished(p)) {
				console.log(Date(), 'finishPurchase RETURN iapIsReceiptFinished', p);
				return;
			}

            if('customTransactionId' in p) {
                if(p.type === store.APPLICATION) {
                    // set product type by product id from receipt
                    if(p.customProductId in store.products.byId) {
                        p.type = store.products.byId[p.customProductId].type;
                    }
                }

                if(!('transaction' in p)) {
                    p.transaction = {};
                }
                if(!('id' in p.transaction)) {
                    p.transaction.id = p.customTransactionId;
                }

                if(p.type === store.PAID_SUBSCRIPTION && !('transactions' in p)) {
                    p.transactions = [p.transaction.id];
                }

                if(!('original_transaction_id' in p.transaction)) {
                    p.transaction.original_transaction_id = p.customOriginalTransactionId;
                }

                // stop parallel requests, use prefix for separate requests in each function
                var iapPrefix = 'finishPurchase';
                if($this.iapIsTransactionInProcess(iapPrefix, p)) {
                    console.log('finishPurchase transactionInProcess RETURN', p.transaction.id, p.transactions);
                    return;
                } else {
                    $this.iapAddTransactionInProcess(iapPrefix, p);
                    console.log('finishPurchase transactionInProcess CREATED', p.transaction.id, p.transactions);
                }
            }

            if(!$this.isAndroid()) {
                if(p.transaction && 'appStoreReceipt' in p.transaction && p.transaction.appStoreReceipt) {
                    localStorageReceiptKey = 'iap_ ' + $this.appStoreReceiptCreateMd5Hash(p.transaction.appStoreReceipt);
                }
            }

//            Test delayed purchase
//            if(window.location.pathname.indexOf('upgrade') !== -1) {
//                console.log('verifyPurchase test return', window.location.pathname);
//                return;
//            } else {
//                console.log('verifyPurchase test run', window.location.pathname);
//            }

            console.log(Date(), 'finishPurchase p.transaction.id', p.transaction.id);

            var params = {
                cmd : 'finish',
                transaction : p.transaction,
                page : window.location.pathname
            }

            var callback = function(data) {
                console.log('finishPurchase ajax data', data);
                if(data) {
                    if(data.result == 'ok') {
                        console.log('finishPurchase ok');
                        p.finish();

                        finishTransaction(p.id, p.transaction.id, p.customTransactionsInReceipt, localStorageReceiptKey);

                        console.log('finishPurchase data json', JSON.stringify(data));

                        upgradeNotificationBalanceRefilled(data.credits, data.request_uri);

                        console.log('finishPurchase end product info', p.transaction.id);
                    } else {
                        console.log('finishPurchase error', data.result);

                        if(data.result === 'no_alert') {
                            console.log('finishPurchase data.result NO_ALERT > ' + data.message);

                            p.finish();

                            finishTransaction(p.id, p.transaction.id, p.customTransactionsInReceipt, localStorageReceiptKey);

                        } else {
                            console.log('finishPurchase showAlert', data, p.transaction.id);
                            $this.showAlert(data.result);
                        }
                    }
                } else {
                    console.log('finishPurchase no data', data);
                    $this.showAlert(l('server_error_try_again'));
                }
                upgradeButtonRestoreLabel();
            };

            $this.sendRequestToSite(params, callback, iapUrl, false);
        }

        function finishTransaction(productId, transactionId, transactionsInReceipt, localStorageReceiptKey) {

            if(localStorageReceiptKey === null || !localStorageReceiptKey) {
                console.log('finishTransaction > return localStorageReceiptKey incorrect', localStorageReceiptKey);
                return; // disable for Android app
            }

            var localStorageTransactionPrefix = 'transaction_finished_';

            localStorage.setItem(localStorageTransactionPrefix + transactionId, 1);

            var isReceiptFinished = true;
            // save latest transaction for product
            for(var index in transactionsInReceipt) {
                if(localStorage.getItem(localStorageTransactionPrefix + transactionsInReceipt[index])) {
                    console.log('finishTransaction > ' + transactionId + ' finished');
                } else {
                    isReceiptFinished = false;
                    console.log('finishTransaction > ' + transactionId + ' is not finished yet');
                    break;
                }
            }

            if(isReceiptFinished) {
                localStorage.setItem(localStorageReceiptKey, 1);
                console.log('finishTransaction > ' + localStorageReceiptKey + ' receipt finished');
            }

        }

        store.when().updated(function(p){
            console.log(Date(), 'product updated', JSON.stringify(p));
        });

        store.when().approved(verifyPurchase);

        store.when().verified(finishPurchase);

		if(typeof CdvPurchase === 'undefined') {
			store.when().cancelled(function(){upgradeButtonRestoreLabel();});
		}
    }

    $this.appStoreReceiptCreateMd5Hash = function(appStoreReceipt) {
        return store.utils.md5(appStoreReceipt);
    }

    $this.iapAddTransactionInProcess = function(iapPrefix, p) {
        if(p.transaction === null || !p.transaction.id) {
            console.log('iapAddTransactionInProcess return');
            return;
        }

        var transactionKey = iapPrefix + p.transaction.id;

        if(!(transactionKey in $this.iapTransactionInProcess)) {
            $this.iapTransactionInProcess[transactionKey] = [];
        }

        var transactions = p.transactions ? JSON.stringify(p.transactions): '';
        $this.iapTransactionInProcess[transactionKey].push(transactions);
        console.log('iapAddTransactionInProcess', transactionKey, transactions);
    }

    $this.iapIsTransactionInProcess = function(iapPrefix, p) {
        var isTransactionInProcessExists = false;

        if(p.transaction === null || !p.transaction.id) {
            console.log('iapIsTransactionInProcess return');
            return isTransactionInProcessExists;
        }

        var transactions = p.transactions ? JSON.stringify(p.transactions): '';
        var transactionKey = iapPrefix + p.transaction.id;

        if(transactionKey in $this.iapTransactionInProcess && $this.iapTransactionInProcess[transactionKey].indexOf(transactions) !== -1) {
            console.log('isTransactionInProcess exists', transactionKey, transactions);
            isTransactionInProcessExists = true;
        }

        return isTransactionInProcessExists;
    }

    $this.iapIsReceiptFinished = function(p) {

        var isReceiptFinished = false;

        if('transactions' in p) {
            console.log('iapIsReceiptFinished CACHE OFF transactions in p', JSON.stringify(p.transactions));
        } else if('transaction' in p && p.transaction && 'appStoreReceipt' in p.transaction && p.transaction.appStoreReceipt) {
                var localStorageReceiptKey = 'iap_ ' + $this.appStoreReceiptCreateMd5Hash(p.transaction.appStoreReceipt);
                if(localStorage[localStorageReceiptKey] === '1') {
                    console.log('iapIsReceiptFinished exists in localStorage', localStorageReceiptKey, p.transaction.id);
                    isReceiptFinished = true;
                } else {
                    console.log('iapIsReceiptFinished NOT EXISTS in localStorage', localStorageReceiptKey, p.transaction.id);
                }
        } else if('sourceReceipt' in p && 'transactions' in p.sourceReceipt && p.sourceReceipt.transactions.length && p.sourceReceipt.transactions[0].isAcknowledged) {
			isReceiptFinished = true;
		}

		if($this.isAndroid()) {

			if('acknowledged' in p && p.acknowledged === true) {
				console.log('verifyPurchase', 'return already acknowledged(p.acknowledged)');
				isReceiptFinished = true;
			}

			if('transaction' in p && 'receipt' in p.transaction) {
				var receipt = JSON.parse(p.transaction.receipt);
				if('acknowledged' in receipt && receipt.acknowledged === true) {
					console.log('verifyPurchase', 'return already acknowledged(receipt)');
					isReceiptFinished = true;
				}
			}

		} else {

			var iapPrefix = 'verifyPurchase';
			if($this.iapIsTransactionInProcess(iapPrefix, p)) {
				console.log('verifyPurchase iapIsTransactionInProcess');
				isReceiptFinished = true;
			}
		}

        return isReceiptFinished;
    }

    $this.showAlert = function(message) {
        if(typeof tmplCurrent !== 'undefined') {
            switch(tmplCurrent) {
                case 'urban_mobile':
                    showAlert(message, '.st-container');
                    break;
                default:
                    showAlert(message);
                    break;
            }
        }
    }

    // for compatibility with templates 5.2
    $this.init(false);

	return $this;
}());


