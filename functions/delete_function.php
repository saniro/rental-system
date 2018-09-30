<?php
	require("../connection/connection.php");
	if(isset($_POST['tenant_delete_data'])){
		$user_id = $_POST['tenant_id_data'];
		$query = "UPDATE user_tbl 
					SET flag = 0 
					WHERE user_id = :user_id";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		
		$data = array("success" => "true", "message" => "Account has been deactivated.");
		$output = json_encode($data);
		echo $output;
	}

	if(isset($_POST['rental_terminate_data'])){
		$rental_id = $_POST['rental_id_data'];
		$query_select = "SELECT user_id FROM rental_tbl WHERE rental_id = :rental_id";
		$stmt = $con->prepare($query_select);
		$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
		$stmt->execute();
		$rental_results = $stmt->fetch();
		$user_id = $rental_results['user_id'];

		$query = "UPDATE user_tbl 
					SET flag = 0 
					WHERE user_id = :user_id";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();

		$query = "UPDATE monthly_rent_tbl 
					SET status = 0 
					WHERE rental_id = :rental_id";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
		$stmt->execute();

		$query = "UPDATE rental_tbl 
					SET status = 0, end_date = CURDATE() 
					WHERE rental_id = :rental_id";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
		$stmt->execute();

		$query = "SELECT room_id FROM rental_tbl WHERE rental_id = :rental_id;";
		$stmt = $con->prepare($query);
		$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch();
		
		$data = array("success" => "true", "message" => "Rental terminated.", "room_id"=> $row['room_id']);
		$output = json_encode($data);
		echo $output;
	}
?>