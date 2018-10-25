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
		$query = "SELECT user_id, concat(last_name,  ', ', first_name, ' ', middle_name) AS name, email, contact_no, (SELECT room_name FROM room_tbl WHERE room_id = (SELECT room_id FROM rental_tbl AS RL WHERE RL.user_id = UR.user_id)) AS room_name FROM user_tbl AS UR WHERE (SELECT apartment_id FROM room_tbl AS RM WHERE RM.room_id = (SELECT room_id FROM rental_tbl AS RL WHERE Rl.user_id = UR.user_id)) = :apartment_id AND user_type = 0 AND flag = 1";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
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

	// a_roomstable.php
	function all_rooms(){
		require("./connection/connection.php");
		$query = "SELECT room_id, room_name, rent_rate, room_description, (CASE WHEN (SELECT rental_id FROM rental_tbl AS RL WHERE RL.room_id = RM.room_id AND status = 1) IS NULL THEN 'Vacant' ELSE 'Occupied' END) AS status FROM room_tbl AS RM WHERE apartment_id = :apartment_id AND flag = 1";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$rowCount = $stmt->rowCount();
		$results = json_encode($results);
		return $results;
	}

	// a_complaints.php
	function all_complaints(){
		require("./connection/connection.php");
		$query = "SELECT complaint_id, DATE_FORMAT(message_date, '%M %d, %Y') AS message_date, (SELECT concat(last_name, ', ', first_name, ' ', middle_name) FROM user_tbl AS UR WHERE UR.user_id = CT.user_id) AS name, (CASE WHEN status = 1 THEN 'Not yet read' WHEN response IS NULL AND status = 2 THEN 'Read' ELSE 'Responded' END) AS status FROM complaint_tbl AS CT WHERE (SELECT apartment_id FROM room_tbl AS RM WHERE RM.room_id = CT.room_id) = :apartment_id";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$rowCount = $stmt->rowCount();
		$results = json_encode($results);
		return $results;
	}

	function rules_list(){
		require("./connection/connection.php");
		$query = "SELECT rules_id, description FROM rules_tbl WHERE apartment_id = :apartment_id AND flag = 1";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$results = json_encode($results);
		return $results;
	}

	function bill_types_list(){
		require("./connection/connection.php");
		$query = "SELECT utility_bill_type_id, utility_bill_type, description FROM utility_bill_type_tbl WHERE apartment_id = :apartment_id AND flag = 1";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$results = json_encode($results);
		return $results;
	}

	function request_change_room_list(){
		require("./connection/connection.php");
		$query = "SELECT request_id, date_requested, (SELECT concat(last_name, ', ', first_name, ' ', middle_name) FROM user_tbl AS US WHERE US.user_id = RCR.user_id) AS name, (SELECT room_name FROM room_tbl AS RM WHERE RM.room_id = (SELECT RL.room_id FROM rental_tbl AS RL WHERE RL.rental_id = RCR.current_rental_id)) AS current_room, (SELECT room_name FROM room_tbl AS RM WHERE RM.room_id = RCR.requested_room) AS requested_room FROM request_change_room_tbl AS RCR WHERE apartment_id = :apartment_id AND status = 2";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetchAll();
		$results = json_encode($results);
		return $results;
	}
?>