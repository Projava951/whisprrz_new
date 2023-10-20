<?php

/* (C) Websplosion LTD., 2001-2014

  IMPORTANT: This is a commercial software product
  and any kind of using it must agree to the Websplosion's license agreement.
  It can be found at http://www.chameleonsocial.com/license.doc

  This notice may not be removed from the source code. */

include("./_include/core/main_start.php");

Common::authRequiredExit();

require_once("./_include/current/hotdates/tools.php");

function do_action() {
    global $g_user;

    $cmd = get_param('cmd');
    $hotdate_id = intval(get_param('hotdate_id'));

    if ($hotdate_id) {
        if ($cmd == "add") {
            CHotdatesTools::create_hotdate_guest($hotdate_id, intval(get_param('n_friends')));
            Wall::add('hotdate_member', $hotdate_id);
            /* START - Divyesh - 07082023 */
            $hd_user_id = DB::result("SELECT user_id FROM hotdates_hotdate WHERE hotdate_id=".to_sql($hotdate_id,"Number"));
            
            $userTo = User::getInfoBasic($hd_user_id);

            Common::usersms('host_date_sms', $userTo, 'set_sms_alert_hd');

            /* END - Divyesh - 07082023 */
            echo 'ok';
            die();
        } elseif ($cmd == "remove") {
            CHotdatesTools::delete_hotdate_guest($hotdate_id);
            Wall::remove('hotdate_member', $hotdate_id);
            echo 'ok';
            die();
        }
    }
}

do_action();

include("./_include/core/main_close.php");
?>