<?php

	function room_check($room_id){
		require("./connection/connection.php");
		$query = "SELECT rental_id FROM rental_tbl WHERE room_id = :room_id AND status = 1";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
		$stmt->execute();
		//$results = $stmt->fetchAll();
		$rowCount = $stmt->rowCount();
		return $rowCount;
	}

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

	function all_payments(){
		require("./connection/connection.php");
		$query = "SELECT m_rent_id, (SELECT concat(last_name, ', ', first_name, ' ', middle_name) FROM user_tbl AS UR WHERE UR.user_id = (SELECT user_id FROM rental_tbl AS RL WHERE RL.rental_id = MT.rental_id)) AS user_name, (SELECT contact_no FROM user_tbl AS UR WHERE UR.user_id = (SELECT user_id FROM rental_tbl AS RL WHERE RL.rental_id = MT.rental_id)) AS contact_no, (SELECT room_name FROM room_tbl AS RM WHERE room_id = (SELECT room_id FROM rental_tbl AS RL WHERE RL.rental_id = MT.rental_id)) AS room_name, payables, due_date FROM monthly_rent_tbl AS MT";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$rowCount = $stmt->rowCount();
		$results = json_encode($results);
		return $results;
	}
?>