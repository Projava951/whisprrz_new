<?php
/* (C) Websplosion LTD., 2001-2014

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */

$area = "login";
include("./_include/core/main_start.php");
require_once("./_include/current/main/custom_head.php");
require_once("./_include/current/main/header.php");
require_once("./_include/current/main/sidebar.php");
require_once("./_include/current/main/tools.php");
require_once("./_include/current/main/event_show.php");
require_once("./_include/current/main/event_image_list.php");
require_once("./_include/current/main/event_guest_list.php");
require_once("./_include/current/main/event_comment_list.php");
require_once("./_include/current/main/event_list.php");
require_once("./_include/current/main/calendar.php");

class CEvents extends CHtmlBlock
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


$page = new CEvents("", getPageCustomTemplate('main_calendar.html', 'calendar_template'));
$header = new CHeader("header", $g['tmpl']['dir_tmpl_main'] . "_header.html");

if (Common::isParseModule('events_custom_head')) {
    $events_custom_head = new CEventsCustomHead("custom_head", $g['tmpl']['dir_tmpl_main'] . "_events_custom_head.html");
    $header->add($events_custom_head);
}

$page->add($header);
$footer = new CFooter("footer", $g['tmpl']['dir_tmpl_main'] . "_footer.html");
$page->add($footer);

if (Common::isParseModule('main_header')) {
    $main_header = new CEventsHeader("main_header", $g['tmpl']['dir_tmpl_main'] . "_main_header.html");
    $page->add($main_header);
}

if (Common::isParseModule('main_sidebar')) {
    $main_sidebar = new CEventsSidebar("main_sidebar", $g['tmpl']['dir_tmpl_main'] . "_main_sidebar.html");
    $page->add($main_sidebar);
}

$tmpl = $g['tmpl']['dir_tmpl_main'] . "_main_content_calendar.html";
if (Common::isOptionActiveTemplate('event_social_enabled')) {
    $tmpl = array(
        'main' => $g['tmpl']['dir_tmpl_main'] . '_main_content_calendar.html',
        'items' => $g['tmpl']['dir_tmpl_main'] . '_main_calendar_items.html',
    );
}
$main_calendar = new CEventsCalendar("main_calendar", $tmpl);


$page->add($main_calendar);

include("./_include/core/main_close.php");
