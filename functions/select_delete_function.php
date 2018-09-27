<?php
	require("../connection/connection.php");
	if(isset($_POST['tenant_selected_data'])){
		$user_id = $_POST['tenant_id_data'];
		$query = "SELECT user_id, concat(last_name,  ', ', first_name, ' ', middle_name) AS name, (SELECT room_name FROM room_tbl WHERE room_id = (SELECT room_id FROM rental_tbl AS RL WHERE RL.user_id = UR.user_id)) AS room_name, DATE_FORMAT(birth_date,'%b %d, %Y %r') AS birth_date, gender, contact_no, email, profile_picture FROM user_tbl AS UR WHERE user_id = :user_id";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch();
		$rowCount = $stmt->rowCount();
		$results = json_encode($result);
		echo $results;
	}

	if(isset($_POST['rental_terminate_data'])){
		$rental_id = $_POST['rental_id_data'];
		$query = "SELECT (SELECT concat(last_name,  ', ', first_name, ' ', middle_name) FROM user_tbl AS UR WHERE UR.user_id = RL.user_id) AS user_name, (SELECT room_name FROM room_tbl AS RM WHERE RM.room_id = RL.room_id) AS room_name, rental_id FROM rental_tbl AS RL WHERE rental_id = :rental_id";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch();

		$result = array("rental_id" => $result['rental_id'], "user_name" => $result['user_name'], "room_name" => $result['room_name']);
		$result = json_encode($result);
		echo $result;
	}
?>