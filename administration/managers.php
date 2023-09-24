<?php
/* (C) Websplosion LTD., 2001-2014

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */
//   Rade 2023-09-23
include("../_include/core/administration_start.php");

class CManagersResults extends CHtmlList
{
	function action()
	{
		global $g, $p;

		$del = get_param('delete');
        $banned = intval(get_param('ban'));
        $isRedirect = false;
		if ($del) {
            $user =  explode(',', $del);
            foreach ($user as $userId) {
                if (Common::isEnabledAutoMail('admin_delete')) {
                    DB::query('SELECT * FROM user WHERE user_id = ' . to_sql($userId, 'Number'));
                    $row = DB::fetch_row();
                    $vars = array(
                        'title' => $g['main']['title'],
                        'name' => $row['name'],
                    );
                    Common::sendAutomail($row['lang'], $row['mail'], 'admin_delete', $vars);
                }
                delete_user($userId);
            }
			$isRedirect = true;
		} elseif ($banned) {
			$sql='UPDATE user SET ban_global=1-ban_global WHERE user_id='. to_sql($banned, 'Number');
			DB::execute($sql);
            $isRedirect = true;
		}
        if ($isRedirect) {
            $offset = intval(get_param('offset'));
            if ($offset) {
                $offset = "?offset={$offset}";
            } else {
                $offset = '';
            }
            redirect($p . $offset);
        }
	}

	function init()
	{
		global $g;

        $this->m_on_page = 20;
		$this->m_on_bar = 10;

		$this->m_sql_count = "SELECT COUNT(m.id) FROM add_manager AS m " . $this->m_sql_from_add . "";
		$this->m_sql = "
			SELECT m.name, m.password
			FROM add_manager AS m
			" . $this->m_sql_from_add . "
		";

		$this->m_field['name'] = array("name", null);
		$this->m_field['password'] = array("password", null);
		
	}
	function parseBlock(&$html)
	{
		parent::parseBlock($html);
	}
    function onPostParse(&$html)
	{
        if ($this->m_total != 0) {
            $html->parse('no_delete');
        }
	}
	function onItem(&$html, $row, $i, $last)
	{
		global $g;

	}
}

$page = new CManagersResults("main", $g['tmpl']['dir_tmpl_administration'] . "managers.html");
$header = new CAdminHeader("header", $g['tmpl']['dir_tmpl_administration'] . "_header.html");
$page->add($header);
$footer = new CAdminFooter("footer", $g['tmpl']['dir_tmpl_administration'] . "_footer.html");
$page->add($footer);

include("../_include/core/administration_close.php");

?>

