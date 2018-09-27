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
?>