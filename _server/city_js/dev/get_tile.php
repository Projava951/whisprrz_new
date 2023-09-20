<?php
$g['mobile_redirect_off'] = true;
include('../../../_include/core/main_start.php');
//$panoId = urlencode(get_param('panoId'));

//file_put_contents('debug', get_param('panoId'));
$panoId = get_param('panoId');
$keyMap = get_param('keyMap');

//$x = intval(get_param('x'));
$y = intval(get_param('y'));
$w = intval(get_param('w'));
$zoom = get_param('zoom');

$pathPano = $g['path']['url_files_city'] . 'city/pano_cache/';

if (file_exists("{$pathPano}{$panoId}_{$zoom}_0.jpg") ) {
    exit();
}

$paramKeyMap = $keyMap ? '&key=' . $keyMap : '';
for ($x = 0; $x < $w; $x++) {
    $file = "{$pathPano}{$panoId}_{$zoom}_{$x}_{$y}.jpg";
    if(file_exists($file) && getimagesize($file)) {
        continue;
    }
    $paramKeyMap = '';
    $url = 'https://maps.google.com/cbk?output=tile&panoid=' . $panoId . '&zoom=' . $zoom . '&x=' . $x . '&y=' . $y . $paramKeyMap;
    for ($n = 0; $n < 10; $n++) {
        $result = urlGetContents($url, 'POST');
        file_put_contents($file, $result);
        if (getimagesize($file)) {
            break;
        } else {
        	usleep(50000);
        }
    }
}