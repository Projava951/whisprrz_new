<?php
set_time_limit(0);
header('Access-Control-Allow-Origin: *');  
$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$user_mail=$_POST['user_mail'];
$servername = "localhost";
$username = "eric_cui";
$password = "nnsscc123456!#";
// Create connection
$conn = new mysqli($servername, $username, $password,"eric_whisprrz_db");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}	
try
{
	$sql = "update video_rooms set create_state=0 where user_id=".$user_id;
	$result = $conn->query($sql);
} catch (Exception $e) {
	$no = -1;
}
$conn-> close();
echo json_encode(
	[
		"status"=>"success"
	]
);