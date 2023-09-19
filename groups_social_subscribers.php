<?php
/* (C) Websplosion LLC, 2001-2021

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */

include('./_include/core/main_start.php');

$optionTmplName = Common::getTmplName();
if ($optionTmplName != 'edge') {
    Common::toHomePage();
}

$isAjaxRequest = get_param('ajax');
$hideFromGuests = Common::isOptionActive('list_photos_hide_from_guests', "{$optionTmplName}_general_settings");
if (!guid() && !$isAjaxRequest) {
    $uid = User::getParamUid(0);
    if ($hideFromGuests || $uid) {
        Common::toLoginPage();
    }
}

Groups::checkAccessGroup();

class CPage extends CHtmlBlock
{
    function init()
    {

    }

    function parseBlock(&$html)
    {
        $guid = guid();
        $uid = User::getParamUid(0);

        $ajax = get_param('ajax');
        $optionTmplName = Common::getTmplName();
        $groupId = Groups::getParamId();

        if (!$groupId) {
            Common::toHomePage();
        }

        $groupInfo = Groups::getInfoBasic($groupId);
        $isPage = $groupInfo['page'];

        $page = get_param_int('page');
        $page = $page < 1 ? 1 : $page;

        if ($isPage) {
            $pageTitle = l('page_title_page');
            $pageDescription = '';
            $pageUrl = Common::pageUrl('group_page_liked', $groupId);
        } else {
            $pageTitle = l('page_title_group');
            $pageDescription = '';
            $pageUrl = Common::pageUrl('group_subscribers', $groupId);
        }

        $vars = array('page_title'   => $pageTitle,
                      'page_description' => $pageDescription,
                      'url_pages'    => $pageUrl,
                      'page_number' => $page,
                      'page_user_id' => $guid,
                      'page_param'   => 'page',
                      'page_type' => 'groups_subscribers',
                      'page_filter' => 0,
                      'page_guid' => $guid,
                      'group_id'    => $groupId
                    );


        $pagerOnPage = Common::getOptionInt('list_people_number_users', "{$optionTmplName}_general_settings");
        $mOnBar = Common::getOption('usersinfo_pages_per_list', 'template_options');
        if (!$mOnBar) {
            $mOnBar = 5;
        }
        $limit = (($page - 1) * $pagerOnPage) . ',' . $pagerOnPage;

        $block = 'list_photos';
        $class = "Template{$optionTmplName}";

        $itemsTotal = Groups::getNumberSubscribers($groupId);

        if ($ajax) {
            $html->setvar('num_total', $itemsTotal);
        } else {
            $html->assign('', $vars);

            TemplateEdge::parseColumn($html, $uid ? $uid : $guid);
        }

        $profileDisplayType = Common::getOption('list_people_display_type', "{$optionTmplName}_general_settings");
        $block = "list_people_{$profileDisplayType}";
        $html->parse($block, false);

        $rows = Groups::getListSubscribers($groupId, false, $limit);
        if ($rows) {

            $numberRow = Common::getOptionInt('list_people_number_row', "{$optionTmplName}_general_settings");

            foreach ($rows as $key => $row) {
                $class::parseUser($html, $row, $numberRow, $profileDisplayType, 'users_list_item');
                $html->parse('users_list_item');
            }
            Common::parsePagesListUrban($html, $page, $itemsTotal, $pagerOnPage, $mOnBar, $pageUrl);
        } else {
            $html->parse('list_noitems');
        }

        parent::parseBlock($html);
    }
}

$tmplList = getPageCustomTemplate('groups_subscribers_template.html', 'groups_subscribers_template');
if ($isAjaxRequest) {
    $tmplList['main'] = $g['tmpl']['dir_tmpl_main'] . 'search_results_ajax.html';
    unset($tmplList['profile_column_left']);
    unset($tmplList['profile_column_right']);
}

$page = new CPage("", $tmplList);

if($isAjaxRequest) {
    getResponsePageAjaxByAuthStop($page, $hideFromGuests ? guid() : 1);
}


$header = new CHeader("header", $g['tmpl']['dir_tmpl_main'] . "_header.html");
$page->add($header);
$footer = new CFooter("footer", $g['tmpl']['dir_tmpl_main'] . "_footer.html");
$page->add($footer);

include('./_include/core/main_close.php');