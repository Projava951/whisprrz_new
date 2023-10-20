<?php

/* (C) Websplosion LTD., 2001-2014

  IMPORTANT: This is a commercial software product
  and any kind of using it must agree to the Websplosion's license agreement.
  It can be found at http://www.chameleonsocial.com/license.doc

  This notice may not be removed from the source code. */

include("./_include/core/main_start.php");

Common::authRequiredExit();

require_once("./_include/current/partyhouz/tools.php");

function do_action() {
    global $g_user;

    $cmd = get_param('cmd');
    $partyhou_id = intval(get_param('partyhou_id'));

    if ($partyhou_id) {
        if ($cmd == "add") {
            CpartyhouzTools::create_partyhou_guest($partyhou_id, intval(get_param('n_friends')));
            Wall::add('partyhou_member', $partyhou_id);
            echo 'ok';
            die();
        } elseif ($cmd == "remove") {
            CpartyhouzTools::delete_partyhou_guest($partyhou_id);
            Wall::remove('partyhou_member', $partyhou_id);
            echo 'ok';
            die();
        }
    }
}

do_action();

include("./_include/core/main_close.php");
?>