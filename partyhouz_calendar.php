<?php
/* (C) Websplosion LTD., 2001-2014

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */

$area = "login";
include("./_include/core/main_start.php");
require_once("./_include/current/partyhouz/custom_head.php");
require_once("./_include/current/partyhouz/header.php");
require_once("./_include/current/partyhouz/sidebar.php");
require_once("./_include/current/partyhouz/tools.php");
require_once("./_include/current/partyhouz/partyhou_show.php");
require_once("./_include/current/partyhouz/partyhou_image_list.php");
require_once("./_include/current/partyhouz/partyhou_guest_list.php");
require_once("./_include/current/partyhouz/partyhou_comment_list.php");
require_once("./_include/current/partyhouz/partyhou_list.php");
require_once("./_include/current/partyhouz/calendar.php");

class Cpartyhouz extends CHtmlBlock
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


$page = new Cpartyhouz("", getPageCustomTemplate('partyhouz_calendar.html', 'calendar_template'));
$header = new CHeader("header", $g['tmpl']['dir_tmpl_main'] . "_header.html");

if (Common::isParseModule('partyhouz_custom_head')) {
    $partyhouz_custom_head = new CpartyhouzCustomHead("custom_head", $g['tmpl']['dir_tmpl_main'] . "_partyhouz_custom_head.html");
    $header->add($partyhouz_custom_head);
}

$page->add($header);
$footer = new CFooter("footer", $g['tmpl']['dir_tmpl_main'] . "_footer.html");
$page->add($footer);

if (Common::isParseModule('partyhouz_header')) {
    $partyhouz_header = new CpartyhouzHeader("partyhouz_header", $g['tmpl']['dir_tmpl_main'] . "_partyhouz_header.html");
    $page->add($partyhouz_header);
}

if (Common::isParseModule('partyhouz_sidebar')) {
    $partyhouz_sidebar = new CpartyhouzSidebar("partyhouz_sidebar", $g['tmpl']['dir_tmpl_main'] . "_partyhouz_sidebar.html");
    $page->add($partyhouz_sidebar);
}

$tmpl = $g['tmpl']['dir_tmpl_main'] . "_partyhouz_calendar.html";
if (Common::isOptionActiveTemplate('partyhou_social_enabled')) {
    $tmpl = array(
        'main' => $g['tmpl']['dir_tmpl_main'] . '_partyhouz_calendar.html',
        'items' => $g['tmpl']['dir_tmpl_main'] . '_partyhouz_calendar_items.html',
    );
}
$partyhouz_calendar = new CpartyhouzCalendar("partyhouz_calendar", $tmpl);


$page->add($partyhouz_calendar);

include("./_include/core/main_close.php");
