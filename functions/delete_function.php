<?php
	require("../connection/connection.php");
	session_start();
	if(isset($_POST['tenant_delete_data'])){
		$user_id = $_POST['tenant_id_data'];

		$query_select = "SELECT rental_id FROM rental_tbl WHERE user_id = :user_id";
		$stmt = $con->prepare($query_select);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		$rental_results = $stmt->fetch();
		$rental_id = $rental_results['rental_id'];

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

				$data = array("success" => "true", "message" => "Rental terminated.", "room_id"=> $row['room_id'], "room_name" => $row['room_name'], "rent_rate" => $row['rent_rate'], "room_description" => $row['room_description'], "status" => "Vacant", "buttons" => '<center><button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnViewDetails" data-id="' .$room_id.'"><span class="fa fa-file-text-o"></span></button> <button data-toggle="tooltip" title="Edit Details" class="btn btn-success" id="btnEdit" data-id="' .$room_id.'"><span class="fa fa-edit"></span></button> <button data-toggle="tooltip" title="Delete" class="btn btn-danger" id="btnDelete" data-id="'.$room_id.'"><span class="glyphicon glyphicon-remove"></span></button></center>');
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

	//a_roomstable.php delete room tables
	if(isset($_POST['submit_delete_room_data'])){
		$room_id = $_POST['room_id_data'];

		if($room_id != NULL){
			$query_check = "SELECT room_id FROM room_tbl WHERE room_id = :room_id AND apartment_id = :apartment_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "SELECT room_id, room_name, (SELECT count(rental_id) FROM rental_tbl AS RL WHERE RL.room_id = RM.room_id AND status = 1) AS roomCount FROM room_tbl AS RM WHERE room_id = :room_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();
				if($row['roomCount'] > 0){
					$data = array("success" => "false", "message" => "Cannot delete room that still have a tenant.");
					$results = json_encode($data);
					echo $results;
				}else{
					$query = "UPDATE room_tbl 
							SET flag = 0 
							WHERE room_id = :room_id";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
					$stmt->execute();

					$data = array("success" => "true", "message" => "Room deleted successfully.");
					$results = json_encode($data);
					echo $results;
				}
			}
			else{
				$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
				$results = json_encode($data);
				echo $results;
			}
		}
		else{
			$data = array("sucess" => "false", "message" => "Required fields must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}

	//a_tncs.php delete tnc
	if(isset($_POST['delete_tncs_data'])){
		$rules_id = $_POST['tnc_id_data'];

		if($rules_id != NULL){
			$query_check = "SELECT rules_id FROM rules_tbl WHERE rules_id = :rules_id AND apartment_id = :apartment_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':rules_id', $rules_id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "UPDATE rules_tbl 
						SET flag = 0 
						WHERE rules_id = :rules_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':rules_id', $rules_id, PDO::PARAM_INT);
				$stmt->execute();

				$data = array("success" => "true", "message" => "Terms and conditions deleted.");
				$results = json_encode($data);
				echo $results;
			}
			else{
				$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
				$results = json_encode($data);
				echo $results;
			}
		}
		else{
			$data = array("sucess" => "false", "message" => "Required fields must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}

	//a_tncs.php delete tnc
	if(isset($_POST['delete_tncs_data'])){
		$rules_id = $_POST['tnc_id_data'];

		if($rules_id != NULL){
			$query_check = "SELECT rules_id FROM rules_tbl WHERE rules_id = :rules_id AND apartment_id = :apartment_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':rules_id', $rules_id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "UPDATE rules_tbl 
						SET flag = 0 
						WHERE rules_id = :rules_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':rules_id', $rules_id, PDO::PARAM_INT);
				$stmt->execute();

				$data = array("success" => "true", "message" => "Terms and conditions deleted.");
				$results = json_encode($data);
				echo $results;
			}
			else{
				$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
				$results = json_encode($data);
				echo $results;
			}
		}
		else{
			$data = array("sucess" => "false", "message" => "Required fields must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}

	//a_utilitybills.php delete utility bills
	if(isset($_POST['delete_utility_bills_data'])){
		$id = $_POST['id_data'];

		if($id != NULL){
			$query_check = "SELECT utility_bill_type_id FROM utility_bill_type_tbl WHERE utility_bill_type_id = :utility_bill_type_id AND apartment_id = :apartment_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':utility_bill_type_id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query_update = "UPDATE utility_bill_type_tbl 
								SET flag = 0 
								WHERE utility_bill_type_id = :id";
				$stmt = $con->prepare($query_update);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();

				$data = array("success" => "true", "message" => "Utility bill deleted.");
				$results = json_encode($data);
				echo $results;
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