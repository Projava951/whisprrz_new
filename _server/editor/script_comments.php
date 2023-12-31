<?php
/* (C) Websplosion LLC, 2001-2021

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */

$g['to_root'] = "../../";
$g['no_headers'] = true;
include($g['to_root'] . "_include/core/main_start.php");

header("Content-Type: text/xml; charset=UTF-8");
header('Cache-Control: no-cache, must-revalidate');

$url_absolute = "http://".str_replace("//", "/", str_replace("_server/editor", "", str_replace("//", "/", str_replace("\\", "", $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/"))));

$id_owner = intval(get_param('id_owner'));

$e = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
$e .= "<items>";

DB::query("SELECT *, YEAR(FROM_DAYS(TO_DAYS('" . date('Y-m-d H:i:s') . "')-TO_DAYS(birth))) AS age FROM user WHERE user_id=" . $g_user['user_id'] . "", 2);
if ($u = DB::fetch_row(2)) {
	$photo_path = $url_absolute.$g['dir_files'].User::getPhotoDefault($g_user['user_id'],"r");

	$e .= "<this_item>";
	$e .= "<idUser><![CDATA[" . $u['user_id'] . "]]></idUser>";
	$e .= "<photoUrl><![CDATA[" . $photo_path . "]]></photoUrl>";
	$e .= "<userName><![CDATA[" . $u['name'] . "]]></userName>";
	$e .= "<userProf><![CDATA[" . $url_absolute . 'search_results.php?display=profile&name=' . $u['name'] . "]]></userProf>";
	$e .= "</this_item>";
}

DB::query("SELECT * FROM users_comments WHERE user_id=" . $id_owner . " ORDER BY id DESC");
while($row = DB::fetch_row()) {
	DB::query("SELECT *, YEAR(FROM_DAYS(TO_DAYS('" . date('Y-m-d H:i:s') . "')-TO_DAYS(birth))) AS age FROM user WHERE user_id=" . $row['from_user_id'] . "", 2);
	if ($u = DB::fetch_row(2)) {
		
		$photo_path = $url_absolute.$g['dir_files'].User::getPhotoDefault($row['from_user_id'],"r");

		$e .= "<item>";
		$e .= "<idUser><![CDATA[" . $u['user_id'] . "]]></idUser>";
		$e .= "<dateMes><![CDATA[" . $row['date'] . "]]></dateMes>";
		$e .= "<photoUrl><![CDATA[" . $photo_path . "]]></photoUrl>";
		$e .= "<userName><![CDATA[" . $u['name'] . "]]></userName>";
		$e .= "<userProf><![CDATA[" . $url_absolute . 'search_results.php?display=profile&name=' . $u['name'] . "]]></userProf>";
		$e .= "<userComment><![CDATA[" . $row['comment'] . "]]></userComment>";
		$e .= "</item>";
	}
}

$e .= "</items>";

echo $e;

include($g['to_root'] . "_include/core/main_close.php");
