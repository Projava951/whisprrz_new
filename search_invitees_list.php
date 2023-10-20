<?php
include("./_include/core/main_start.php");
set_time_limit(0);
header('Access-Control-Allow-Origin: *');
$user_id = $_POST['user_id'];
$search_key = $_POST['search_key'];
$search_type = $_POST['search_type'];
$servername = "localhost";
$username = "eric_cui";
$password = "nnsscc123456!#";

// Create connection
$conn = new mysqli($servername, $username, $password, "eric_whisprrz_db");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
try {
	$users = array();
	$sql = "";
	switch ($search_type) {
		case 1:
			$sql = "SELECT u.name, u.user_id FROM user u WHERE u.name LIKE '%" . $search_key . "%' AND u.user_id <> '" . $user_id . "'";
			break;
		case 2:
			$sql = "SELECT u.name, u.user_id FROM friends f
					LEFT JOIN user u ON u.user_id = f.fr_user_id
					WHERE f.user_id = '" . $user_id . "' AND u.name LIKE '%" . $search_key . "%' AND u.user_id <> '" . $user_id . "'";
			break;
		case 3:
			$sql = "SELECT u.name, u.user_id FROM groups_group_member ggm 
					LEFT JOIN groups_group gg ON gg.group_id = ggm.group_id
					LEFT JOIN user u ON u.user_id = ggm.user_id
					WHERE gg.group_id='" . $group_id . "' AND u.user_id <> '" . $user_id . "' AND u.name LIKE '%" . $search_key . "%'";
			break;
		default:
			break;
	}
	$result = $conn->query($sql);
	$no = 0;
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$user_photo = User::getPhotoDefault($row["user_id"], "m");
			$u = array("user_name" => $row["name"], "user_id" => $row["user_id"], "user_photo"=>$user_photo);
			$no++;
			array_push($users, $u);
		}
	}
} catch (Exception $e) {

}
$conn->close();
echo json_encode(
	[
		"status" => "success",
		"total" => $no,
		"users" => $users
	]
);