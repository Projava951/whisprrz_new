<?php
/* (C) Websplosion LLC, 2001-2021

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */


$g['to_root'] = '../../';
include($g['to_root'] . '_include/core/main_start.php');

$custom = urldecode(get_param('custom', get_param('X-custom')));
echo Pay::getAfterHtml($custom, 'ccbill');