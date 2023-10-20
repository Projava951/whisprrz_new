<?php
include("./_include/core/main_start.php");

set_time_limit(0);
header('Access-Control-Allow-Origin: *');
$user_id=$_POST['user_id'];
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
	$sql = "SELECT u.name, u.user_id FROM friends_requests fr
			LEFT JOIN user u ON u.user_id = fr.friend_id
			WHERE fr.user_id='".$user_id."' AND fr.accepted = 1
			UNION
			SELECT u.name, u.user_id FROM friends_requests fr
			LEFT JOIN user u ON u.user_id = fr.user_id
			WHERE fr.friend_id='".$user_id."' AND fr.accepted = 1";
	$result = $conn->query($sql);
	$friends = array();
	$no = 0;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$user_photo = User::getPhotoDefault($row["user_id"], "m");
			$u = array("user_name"=>$row["name"],"user_id"=>$row["user_id"], "user_photo"=>$user_photo);
			$no++;
			array_push($friends,$u);						
		}
	}	
} catch (Exception $e) {
   
}
$conn-> close();
echo json_encode(
	[
		"status"=>"success", 
		"total"=>$no, 
		"friends"=>$friends
	]
);
