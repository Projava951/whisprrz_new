<?php
$urlMainStart = '../../../_include/core/main_start.php';
$g['mobile_redirect_off'] = true;
$formats = array('mp4' => array(37,22,18), 'webm' => array(45,44,43));
$urlSite = '';
include($urlMainStart);

$urlSite = Common::urlSiteSubfolders();
$option = 'loc_' . get_param('location') . '_quality';
$quality = Common::getOption($option, '3d_city_video');
$formatsAll = array('hd1080' => array(0, 37, 45),
                    'hd720' => array(1, 22, 44),
                    'large' => array(1, 22, 44),
                    'medium' => array(2, 18, 43));
$default = $formatsAll[$quality];
$i = 1;
foreach ($formats as $type => $tags) {
    unset($formats[$type][$default[0]]);
    array_unshift($formats[$type], $default[$i++]);
}

include('hash.php');

$urlVideo = get_param('id');
$format = 'mp4';
/*$ua = $_SERVER['HTTP_USER_AGENT'];
$isFirefox = mb_stripos($ua, 'Firefox', 0, 'UTF-8') !== false;
$isOpera = mb_stripos($ua, 'Opera', 0, 'UTF-8') !== false
           || (mb_stripos($ua, 'Chrome', 0, 'UTF-8') !== false && mb_stripos($ua, 'OPR', 0, 'UTF-8') !== false);
if ($isFirefox || $isOpera){
    $format = 'webm';
}*/

$response = checkCodeYouTubeVideoToDownload($urlVideo, $format, true, null, $formats);
echo json_encode($response);

$urlMainClose = '../../../_include/core/main_close.php';
if(file_exists($urlMainClose)) {
    include($urlMainClose);
}
