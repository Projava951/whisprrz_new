<?php
/* (C) Websplosion LLC, 2001-2021

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */
//�������� ����������: $loginHod � $enemyHod
include('common.php');

DB::execute("UPDATE $t_name SET hod_data='checkmate', active='no' WHERE login=".to_sql($_POST['loginHod']));

//������ ��������
DB::execute("UPDATE $t_name SET active='yes' WHERE login=".to_sql($_POST['enemyHod']));
//�����
echo "isOK=1";

?>