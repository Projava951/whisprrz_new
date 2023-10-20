<?php
set_time_limit(0);
header('Access-Control-Allow-Origin: *');
$user_id = $_POST['user_id'];
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
	$partyhouz = array();
	$sql = "SELECT partyhou_id, partyhou_title
			FROM partyhouz_partyhou
			WHERE user_id = '" . $user_id . "'";
	$result = $conn->query($sql);
	$no = 0;
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$partyhou = array("partyhou_id" => $row["partyhou_id"], "partyhou_title" => $row["partyhou_title"]);
			$no++;
			array_push($partyhouz, $partyhou);
		}
	}
} catch (Exception $e) {

}
$conn->close();
echo json_encode(
	[
		"status" => "success",
		"total" => $no,
		"partyhouz" => $partyhouz
	]
);