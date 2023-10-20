<?php
/* (C) Websplosion LTD., 2001-2014

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */

$area = "login";
include("./_include/core/main_start.php");
require_once("./_include/current/hotdates/custom_head.php");
require_once("./_include/current/hotdates/header.php");
require_once("./_include/current/hotdates/sidebar.php");
require_once("./_include/current/hotdates/tools.php");
require_once("./_include/current/hotdates/hotdate_show.php");
require_once("./_include/current/hotdates/hotdate_image_list.php");
require_once("./_include/current/hotdates/hotdate_guest_list.php");
require_once("./_include/current/hotdates/hotdate_comment_list.php");
require_once("./_include/current/hotdates/hotdate_list.php");
require_once("./_include/current/hotdates/calendar.php");

class CHotdates extends CHtmlBlock
{
	function action()
	{
		global $g_user;
        global $l;
        global $g;

	}

	function parseBlock(&$html)
	{
		global $g_user;
		global $l;
		global $g;

        TemplateEdge::parseColumn($html);

		parent::parseBlock($html);
	}
}


$page = new CHotdates("", getPageCustomTemplate('hotdates_calendar.html', 'calendar_template'));
$header = new CHeader("header", $g['tmpl']['dir_tmpl_main'] . "_header.html");

if (Common::isParseModule('hotdates_custom_head')) {
    $hotdates_custom_head = new CHotdatesCustomHead("custom_head", $g['tmpl']['dir_tmpl_main'] . "_hotdates_custom_head.html");
    $header->add($hotdates_custom_head);
}

$page->add($header);
$footer = new CFooter("footer", $g['tmpl']['dir_tmpl_main'] . "_footer.html");
$page->add($footer);

if (Common::isParseModule('hotdates_header')) {
    $hotdates_header = new CHotdatesHeader("hotdates_header", $g['tmpl']['dir_tmpl_main'] . "_hotdates_header.html");
    $page->add($hotdates_header);
}

if (Common::isParseModule('hotdates_sidebar')) {
    $hotdates_sidebar = new CHotdatesSidebar("hotdates_sidebar", $g['tmpl']['dir_tmpl_main'] . "_hotdates_sidebar.html");
    $page->add($hotdates_sidebar);
}

$tmpl = $g['tmpl']['dir_tmpl_main'] . "_hotdates_calendar.html";
if (Common::isOptionActiveTemplate('hotdate_social_enabled')) {
    $tmpl = array(
        'main' => $g['tmpl']['dir_tmpl_main'] . '_hotdates_calendar.html',
        'items' => $g['tmpl']['dir_tmpl_main'] . '_hotdates_calendar_items.html',
    );
}
$hotdates_calendar = new CHotdatesCalendar("hotdates_calendar", $tmpl);


$page->add($hotdates_calendar);

include("./_include/core/main_close.php");
