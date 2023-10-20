<?php
set_time_limit(0);
header('Access-Control-Allow-Origin: *');
$user_id=$_POST['user_id'];
$group_id=$_POST['group_id'];
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
	$sql = "SELECT u.name, u.user_id FROM groups_group_member ggm 
			LEFT JOIN groups_group gg ON gg.group_id = ggm.group_id
			LEFT JOIN user u ON u.user_id = ggm.user_id
			WHERE gg.group_id='".$group_id."' AND u.user_id<>'".$user_id."'" ;
	$result = $conn->query($sql);
	$users = array();
	$no = 0;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$u = array("user_name"=>$row["name"],"user_id"=>$row["user_id"]);
			$no++;
			array_push($users,$u);						
		}
	}	
} catch (Exception $e) {
   
}
$conn-> close();
echo json_encode(
	[
		"status"=>"success", 
		"total"=>$no, 
		"users"=>$users
	]
);
