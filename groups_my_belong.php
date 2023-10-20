<?php
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
	$sql = "SELECT gg.group_id, gg.group_title FROM groups_group_member ggm 
			LEFT JOIN groups_group gg ON gg.group_id = ggm.group_id
			WHERE ggm.user_id='".$user_id."'";
	$result = $conn->query($sql);
	$groups = array();
	$no = 0;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$u = array("group_name"=>$row["group_title"],"group_id"=>$row["group_id"]);
			$no++;
			array_push($groups,$u);						
		}
	}	
} catch (Exception $e) {
   
}
$conn-> close();
echo json_encode(
	[
		"status"=>"success", 
		"total"=>$no, 
		"groups"=>$groups
	]
);
