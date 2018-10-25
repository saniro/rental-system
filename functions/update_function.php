<?php
	require("../connection/connection.php");
	session_start();
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

	//a_roomstable.php update room
	if(isset($_POST['update_room_details_data'])){
		$room_id = $_POST['room_id_data'];
		$room_name = $_POST['room_name_data'];
        $rent_rate = $_POST['rent_rate_data'];
        $room_description = $_POST['room_description_data'];

		if(($room_id != NULL) && ($room_name != NULL) && ($rent_rate != NULL) && ($room_description != NULL)){
			$query_check = "SELECT room_id FROM room_tbl WHERE room_id = :room_id";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
			$stmt->execute();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query_update = "UPDATE room_tbl 
								SET room_name = :room_name, rent_rate = :rent_rate, room_description = :room_description 
								WHERE room_id = :room_id";
				$stmt = $con->prepare($query_update);
				$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				$stmt->bindParam(':room_name', $room_name, PDO::PARAM_STR);
				$stmt->bindParam(':rent_rate', $rent_rate, PDO::PARAM_INT);
				$stmt->bindParam(':room_description', $room_description, PDO::PARAM_STR);
				$stmt->execute();

				$query_select = "SELECT room_id, room_name, rent_rate, room_description, (CASE WHEN (SELECT rental_id FROM rental_tbl AS RL WHERE RL.room_id = RM.room_id AND status = 1) IS NULL THEN 'Vacant' ELSE 'Occupied' END) AS status FROM room_tbl AS RM WHERE room_id = :room_id";
				$stmt = $con->prepare($query_select);
				$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();
				$data = array("success" => "true", "message" => "Room successfully updated.", "room_id" => $row['room_id'], "room_name" => $row['room_name'], "rent_rate" => $row['rent_rate'], "room_description" => $row['room_description'], "status" => $row['status'], "buttons" => '<center><button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnViewDetails" data-id="' .$room_id.'"><span class="fa fa-file-text-o"></span></button> <button data-toggle="tooltip" title="Edit Details" class="btn btn-success" id="btnEdit" data-id="' .$room_id.'"><span class="fa fa-edit"></span></button> <button data-toggle="tooltip" title="Delete" class="btn btn-danger" id="btnDelete" data-id="'.$row['room_id'].'"><span class="glyphicon glyphicon-remove"></span></button></center>');
				$output = json_encode($data);
				echo $output;
			}
			else{
				$data = array("success" => "false", "error" => "severe", "message" => "Room doesn't exist.");
				$output = json_encode($data);
				echo $output;
			}
		}
		else{
			$data = array("success" => "false", "error" => "minor", "message" => "Required fields must not be empty.");
			$output = json_encode($data);
			echo $output;
		}
	}

	//a_tncs.php update tncs
	if(isset($_POST['update_tncs_data'])){
		$rules_id = $_POST['tnc_id_data'];
		$description = $_POST['description_data'];

		if(($rules_id != NULL) && ($description != NULL)){
			$query_check = "SELECT rules_id FROM rules_tbl WHERE rules_id = :rules_id AND apartment_id = :apartment_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':rules_id', $rules_id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
			$stmt->execute();

			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query_update = "UPDATE rules_tbl 
								SET description = :description 
								WHERE rules_id = :rules_id";
				$stmt = $con->prepare($query_update);
				$stmt->bindParam(':rules_id', $rules_id, PDO::PARAM_INT);
				$stmt->bindParam(':description', $description, PDO::PARAM_STR);
				$stmt->execute();

				$query_select = "SELECT rules_id, description FROM rules_tbl WHERE rules_id = :rules_id";
				$stmt = $con->prepare($query_select);
				$stmt->bindParam(':rules_id', $rules_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();
				$data = array("success" => "true", "message" => "Terms and condition updated successfully.", "rules_id" => $row['rules_id'], "description" => $row['description'], "buttons" => '<button data-toggle="tooltip"'.$row['rules_id'].'" title="Edit" class="btn btn-success btn_edit" id="btnEdit"><span class="fa fa-edit"></span></button> <button data-toggle="tooltip" data-id="'.$row['rules_id'].'" title="Delete" class="btn btn-danger" id="btnDelete"><span class="glyphicon glyphicon-trash"></span></button>');
				$output = json_encode($data);
				echo $output;
			}
			else{
				$data = array("success" => "false", "error" => "severe", "message" => "Item doesn't exist.");
				$output = json_encode($data);
				echo $output;
			}
		}
		else{
			$data = array("success" => "false", "error" => "minor", "message" => "Required fields must not be empty.");
			$output = json_encode($data);
			echo $output;
		}
	}

	//a_utilitybills.php view details
	if(isset($_POST['update_utility_bills_data'])){
		$id = $_POST['utility_bill_type_id_data'];
		$type = $_POST['type_data'];
		$description = $_POST['description_data'];

		if(($id != NULL) && ($type != NULL) && ($description != NULL)){
			$query_check = "SELECT utility_bill_type_id FROM utility_bill_type_tbl WHERE utility_bill_type_id = :utility_bill_type_id AND apartment_id = :apartment_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':utility_bill_type_id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query_update = "UPDATE utility_bill_type_tbl 
								SET utility_bill_type = :type, description = :description 
								WHERE utility_bill_type_id = :id";
				$stmt = $con->prepare($query_update);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->bindParam(':type', $type, PDO::PARAM_STR);
				$stmt->bindParam(':description', $description, PDO::PARAM_STR);
				$stmt->execute();

				$query_select = "SELECT utility_bill_type_id, utility_bill_type, description FROM utility_bill_type_tbl WHERE utility_bill_type_id = :id";
				$stmt = $con->prepare($query_select);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();
				$data = array("success" => "true", "message" => "Utility bill updated successfully.", "id" => $row['utility_bill_type_id'], "type" => $row['utility_bill_type'], "description" => $row['description'], "buttons" => '<button data-toggle="tooltip" data-id="'.$row['utility_bill_type_id'].'" title="Edit" class="btn btn-success btn_edit" id="btnEdit"><span class="fa fa-edit"></span></button> <button data-toggle="tooltip" data-id="'.$row['utility_bill_type_id'].'" title="Delete" class="btn btn-danger" id="btnDelete" ><span class="glyphicon glyphicon-trash"></span></button>');
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

	//a_crequests.php view accept of request
	if(isset($_POST['submit_approve_request_data'])){
		$request_id = $_POST['request_id_data'];
		$apartment_id = $_SESSION['admin_id'];
		if($request_id != NULL){
			$query_check = "SELECT request_id FROM request_change_room_tbl WHERE request_id = :request_id AND apartment_id = :apartment_id AND status = 2";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $apartment_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query_update = "UPDATE request_change_room_tbl 
								SET status = 1 
								WHERE request_id = :request_id";
				$stmt = $con->prepare($query_update);
				$stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
				$stmt->execute();

				$query_select = "SELECT user_id, current_rental_id, requested_room FROM request_change_room_tbl WHERE request_id = :request_id";
				$stmt = $con->prepare($query_select);
				$stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$user_id = $row['user_id'];
				$current_rental_id = $row['current_rental_id'];
				$requested_room = $row['requested_room'];

				$query_update = "UPDATE rental_tbl 
								SET end_date = CURDATE(), status = 0 
								WHERE rental_id = :rental_id";
				$stmt = $con->prepare($query_update);
				$stmt->bindParam(':rental_id', $current_rental_id, PDO::PARAM_INT);
				$stmt->execute();

				$query_insert = "INSERT INTO rental_tbl (starting_date, room_id, user_id) VALUES (CURDATE(), :room_id, :user_id)";
				$stmt = $con->prepare($query_insert);
				$stmt->bindParam(':room_id', $requested_room, PDO::PARAM_INT);
				$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
				$stmt->execute();
				$last_inserted_id = $con->lastInsertId();

				$query_select = "SELECT m_rent_id, payables, due_date FROM monthly_rent_tbl WHERE rental_id = :rental_id";
				$stmt = $con->prepare($query_select);
				$stmt->bindParam(':rental_id', $current_rental_id, PDO::PARAM_INT);
				$stmt->execute();
				$results = $stmt->fetchAll();
				foreach ($results as $row) {
					$m_rent_id = $row['m_rent_id'];
					$payables = $row['payables'];
					$due_date = $row['due_date'];
				}

				$query_update = "UPDATE monthly_rent_tbl 
								SET status = 0 
								WHERE m_rent_id = :m_rent_id";
				$stmt = $con->prepare($query_update);
				$stmt->bindParam(':m_rent_id', $m_rent_id, PDO::PARAM_INT);
				$stmt->execute();

				$query_insert = "INSERT INTO monthly_rent_tbl (rental_id, payables, due_date) VALUES (:rental_id, :payables, :due_date)";
				$stmt = $con->prepare($query_insert);
				$stmt->bindParam(':rental_id', $last_inserted_id, PDO::PARAM_INT);
				$stmt->bindParam(':payables', $payables, PDO::PARAM_INT);
				$stmt->bindParam(':due_date', $due_date, PDO::PARAM_STR);
				$stmt->execute();

				$data = array("success" => "true", "message" => "Change of room request accepted.");
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