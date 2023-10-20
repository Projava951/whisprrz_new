<?php
set_time_limit(0);
header('Access-Control-Allow-Origin: *');
$user_id = $_POST['user_id'];
$room_type = $_POST['room_type'];
$search_key = $_POST['search_key'];
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
	$sql = "SELECT v.*
			FROM video_rooms v
			WHERE 
				((cum_males = 1 AND EXISTS (SELECT 1 FROM user WHERE user_id = '" . $user_id . "' AND gender = 'M'))
				OR (cum_females = 1 AND EXISTS (SELECT 1 FROM user WHERE user_id = '" . $user_id . "' AND gender = 'F'))
				OR (cum_couples = 1 AND EXISTS (SELECT 1 FROM user WHERE user_id = '" . $user_id . "' AND gender = 'C'))
				OR (FIND_IN_SET('" . $user_id . "', invited_user_ids) > 0)
				OR v.user_id = '" . $user_id . "')
				AND room_type = '" . $room_type . "' 
				AND room_name LIKE '%" . $search_key . "%';";
	$result = $conn->query($sql);
	$rooms = array();
	$no = 0;
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$room = array("user_id" => $row["user_id"], 
						"user_name" => $row["user_name"], 
						"room_name" => $row["room_name"], 
						"party_date" => $row["party_date"], 
						"is_open" => $row["is_open"], 
						"cum_males" => $row["cum_males"], 
						"cum_females" => $row["cum_females"], 
						"cum_couples" => $row["cum_couples"], 
						"cum_everyone" => $row["cum_everyone"], 
						"lookin_males" => $row["lookin_males"], 
						"lookin_females" => $row["lookin_females"], 
						"lookin_couples" => $row["lookin_couples"], 
						"lookin_everyone" => $row["lookin_everyone"]
					);
			$no++;
			array_push($rooms, $room);
		}
	}
} catch (Exception $e) {

}
$conn->close();
echo json_encode(
	[
		"status" => "success",
		"total" => $no,
		"rooms" => $rooms
	]
);