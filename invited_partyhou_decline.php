<?php
include("./_include/core/main_start.php");
require_once("./_include/current/partyhouz/tools.php");
require_once("./_include/current/partyhouz/partyhou_image_list.php");

set_time_limit(0);
header('Access-Control-Allow-Origin: *');
$user_id=$_POST['user_id'];
$partyhou_id=$_POST['partyhou_id'];
$servername = "localhost";
$username = "eric_cui";
$password = "nnsscc123456!#";

global $g;

// Create connection
$conn = new mysqli($servername, $username, $password,"eric_whisprrz_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}	
try
{
	$sql = "
		UPDATE partyhouz_partyhou_guest SET declined = 1
		WHERE partyhou_id = '".$partyhou_id."' AND user_id = '".$user_id."';
	";
	$result = $conn->query($sql);
} catch (Exception $e) {
   var_dump($e);
   die();
}
$conn-> close();
echo json_encode(
	[
		"status"=>"success"
	]
);
