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

	if(isset($_POST['rental_terminate_table_data'])){
		$rental_id = $_POST['rental_id_data'];

		if($rental_id != NULL){
			$query_check = "SELECT rental_id FROM rental_tbl WHERE rental_id = :rental_id";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
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
				$room_id = $row['room_id'];

				$query = "SELECT room_id, room_name, rent_rate, room_description FROM room_tbl WHERE room_id = :room_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$data = array("success" => "true", "message" => "Rental terminated.", "room_id"=> $row['room_id'], "room_name" => $row['room_name'], "rent_rate" => $row['rent_rate'], "room_description" => $row['room_description'], "status" => "Vacant", "buttons" => '<center><button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnViewDetails" data-id="' .$room_id.'"><span class="fa fa-file-text-o"></span></button> <button data-toggle="tooltip" title="Edit Details" class="btn btn-success" id="btnEdit" data-id="' .$room_id.'"><span class="fa fa-edit"></span></button></center>');
				$output = json_encode($data);
				echo $output;
			}
			else{
				$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
				$results = json_encode($data);
				echo $results;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Required fields must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}
?>