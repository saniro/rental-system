<?php

	function all_tenants(){
		require("./connection/connection.php");
		$query = "SELECT user_id, concat(last_name,  ', ', first_name, ' ', middle_name) AS name, email, contact_no, (SELECT room_name FROM room_tbl WHERE room_id = (SELECT room_id FROM rental_tbl AS RL WHERE RL.user_id = UR.user_id)) AS room_name FROM user_tbl AS UR WHERE user_type = 0 AND flag = 1";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$rowCount = $stmt->rowCount();
		$results = json_encode($results);
		return $results;

		// foreach ($results as $row) {
		// 	$user_id = $row['user_id'];
		// 	$name = $row['name'];
		// 	$email = $row['name'];
		// 	$contact_no = $row['contact_no'];
		// 	$room_name = $row['room_name'];


		// }
	}
?>