<?php
	require("../connection/connection.php");
	session_start();
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

	//a_roomstable.php view edit room
	if(isset($_POST['view_edit_room_data'])){
		$room_id = $_POST['room_id_data'];
		
		if($room_id != NULL){
			$query_check = "SELECT room_id FROM room_tbl WHERE room_id = :room_id";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "SELECT room_id, room_name, rent_rate, room_description, (CASE WHEN (SELECT rental_id FROM rental_tbl AS RL WHERE RL.room_id = RM.room_id AND status = 1) IS NULL THEN 'Vacant' ELSE 'Occupied' END) AS status FROM room_tbl AS RM WHERE room_id = :room_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$data = array("success" => "true", "room_id" => $row['room_id'], "room_name" => $row['room_name'], "rent_rate" => $row['rent_rate'], "room_description" => $row['room_description'], "status" => $row['status']);
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

	if(isset($_POST['view_room_details_check_data'])){
		$room_id = $_POST['room_id_data'];

		if($room_id != NULL){
			$query_check = "SELECT room_id FROM room_tbl WHERE room_id = :room_id";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query_check = "SELECT rental_id, user_id FROM rental_tbl WHERE room_id = :room_id AND status = 1";
				$stmt = $con->prepare($query_check);
				$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();
				$rowCount = $stmt->rowCount();
				if($rowCount > 0){
					$user_id = $row['user_id'];
					$rental_id = $row['rental_id'];
					$query = "SELECT room_id, room_name, rent_rate, room_description FROM room_tbl WHERE room_id = :room_id";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
					$stmt->execute();
					$row_room = $stmt->fetch();

					$query = "SELECT user_id, concat(last_name, ', ', first_name, ' ', last_name) AS name, DATE_FORMAT(birth_date, '%M %d, %Y') AS birth_date, (CASE WHEN gender = 1 THEN 'Male' WHEN gender = 0 THEN 'Female' END) AS gender, contact_no, email FROM user_tbl WHERE user_id = :user_id";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
					$stmt->execute();
					$row_user = $stmt->fetch();

					$data = array("success" => "true", "status" => "occupied", "rental_id" => $rental_id,"room_id" => $room_id, "room_name" => $row_room['room_name'], "rent_rate" => $row_room['rent_rate'], "room_description" => $row_room['room_description'], "user_id" => $row_user['user_id'], "name" => $row_user['name'], "birth_date" => $row_user['birth_date'], "gender" => $row_user['gender'], "contact_no" => $row_user['contact_no'], "email" => $row_user['email']);
					$results = json_encode($data);
					echo $results;

				}
				else{
					$query = "SELECT room_id, room_name, rent_rate, room_description FROM room_tbl WHERE room_id = :room_id";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
					$stmt->execute();
					$row_room = $stmt->fetch();

					$data = array("success" => "true", "status" => "vacant", "room_id" => $room_id, "room_name" => $row_room['room_name'], "rent_rate" => $row_room['rent_rate'], "room_description" => $row_room['room_description']);
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
			$data = array("success" => "false", "message" => "Required fields must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}

	if(isset($_POST['view_terminate_details_data'])){
		$rental_id = $_POST['rental_id_data'];

		if($rental_id != NULL){
			$query_check = "SELECT rental_id FROM rental_tbl WHERE rental_id = :rental_id AND status = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "SELECT rental_id, (SELECT concat(last_name, ', ', first_name, ' ', middle_name) FROM user_tbl AS UR WHERE UR.user_id = RL.user_id) AS name, (SELECT room_name FROM room_tbl AS RM WHERE RM.room_id = RL.room_id) AS room_name FROM rental_tbl AS RL WHERE rental_id = :rental_id AND status = 1";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$data = array("success" => "true", "rental_id" => $rental_id,"name" => $row['name'], "room_name" => $row['room_name']);
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

	//a_complaints.php view details
	if(isset($_POST['view_and_reply_complaint_data'])){
		$complaint_id = $_POST['complaint_id_data'];

		if($complaint_id != NULL){
			$query_check = "SELECT complaint_id FROM complaint_tbl WHERE complaint_id = :complaint_id";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query_check = "SELECT complaint_id, (CASE WHEN status = 1 THEN 'Not yet read' WHEN response IS NULL AND status = 2 THEN 'Read' ELSE 'Responded' END) AS status FROM complaint_tbl WHERE complaint_id = :complaint_id";
				$stmt = $con->prepare($query_check);
				$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();
				if($row['status'] == 'Not yet read'){
					$query = "UPDATE complaint_tbl 
								SET status = 2
								WHERE complaint_id = :complaint_id";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
					$stmt->execute();

					$query = "SELECT complaint_id, user_id, (SELECT concat(last_name, ', ', first_name, ' ', middle_name) FROM user_tbl AS UR WHERE UR.user_id = CT.user_id) AS name, DATE_FORMAT(message_date, '%M %d, %Y') AS message_date, message FROM complaint_tbl AS CT WHERE complaint_id = :complaint_id";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
					$stmt->execute();
					$row = $stmt->fetch();

					$data = array("success" => "true", "status" => "Not yet read", "complaint_id" => $row['complaint_id'], "user_id" => $row['user_id'], "name" => $row['name'], "message_date" => $row['message_date'], "message" => $row['message'], "buttons" => '<center><button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnDetails" data-id="'.$row['complaint_id'].'"><span class="fa fa-file-text-o"></span></button></center>');
					$results = json_encode($data);
					echo $results;
				}
				else if($row['status'] == 'Read'){
					$query = "SELECT complaint_id, user_id, (SELECT concat(last_name, ', ', first_name, ' ', middle_name) FROM user_tbl AS UR WHERE UR.user_id = CT.user_id) AS name, DATE_FORMAT(message_date, '%M %d, %Y') AS message_date, message FROM complaint_tbl AS CT WHERE complaint_id = :complaint_id";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
					$stmt->execute();
					$row = $stmt->fetch();
					
					$data = array("success" => "true", "status" => "Read", "complaint_id" => $row['complaint_id'], "user_id" => $row['user_id'], "name" => $row['name'], "message_date" => $row['message_date'], "message" => $row['message']);
					$results = json_encode($data);
					echo $results;
				}
				else if($row['status'] == 'Responded'){
					$query = "SELECT complaint_id, user_id, (SELECT concat(last_name, ', ', first_name, ' ', middle_name) FROM user_tbl AS UR WHERE UR.user_id = CT.user_id) AS name, DATE_FORMAT(message_date, '%M %d, %Y') AS message_date, message, response, DATE_FORMAT(response_date, '%M %d, %Y') AS response_date FROM complaint_tbl AS CT WHERE complaint_id = :complaint_id";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
					$stmt->execute();
					$row = $stmt->fetch();

					$data = array("success" => "true", "status" => "Responded", "complaint_id" => $row['complaint_id'], "user_id" => $row['user_id'], "name" => $row['name'], "message_date" => $row['message_date'], "message" => $row['message'], "response" => $row['response'], "response_date" => $row['response_date']);
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

	//a_tncs.php view details to be edited
	if(isset($_POST['view_edit_tncs_data'])){
		$tnc_id = $_POST['tnc_id_data'];

		if($tnc_id != NULL){
			$query_check = "SELECT rules_id FROM rules_tbl WHERE rules_id = :rules_id AND apartment_id = :apartment_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':rules_id', $tnc_id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "SELECT rules_id, description FROM rules_tbl WHERE rules_id = :rules_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':rules_id', $tnc_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$data = array("success" => "true", "tnc_id" => $row['rules_id'], "description" => $row['description']);
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

	//a_tncs.php view details to be deleted
	if(isset($_POST['view_delete_tncs_data'])){
		$tnc_id = $_POST['tnc_id_data'];

		if($tnc_id != NULL){
			$query_check = "SELECT rules_id FROM rules_tbl WHERE rules_id = :rules_id AND apartment_id = :apartment_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':rules_id', $tnc_id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "SELECT rules_id, description FROM rules_tbl WHERE rules_id = :rules_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':rules_id', $tnc_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$data = array("success" => "true", "tnc_id" => $row['rules_id'], "description" => $row['description']);
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

	//a_roomstable.php view details to be deleted
	if(isset($_POST['view_delete_room_data'])){
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
					$data = array("success" => "true", "room_id" => $row['room_id'], "room_name" => $row['room_name']);
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
			$data = array("success" => "false", "message" => "Required fields must not be empty.");
			$results = json_encode($data);
			echo $results;
		}
	}

	//a_tenants.php view details
	if(isset($_POST['view_tenant_selected_data'])){
		$user_id = $_POST['tenant_id_data'];

		if($user_id != NULL){
			$query_check = "SELECT user_id FROM user_tbl AS UR WHERE user_id = :user_id AND (SELECT apartment_id FROM room_tbl AS RM WHERE RM.room_id = (SELECT room_id FROM rental_tbl AS RL WHERE Rl.user_id = UR.user_id)) = :apartment_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "SELECT user_id, concat(last_name, ', ', first_name, ' ', middle_name) AS name, DATE_FORMAT(birth_date, '%M %d, %Y') AS birth_date, (CASE WHEN gender = 1 THEN 'Male' WHEN gender = 0 THEN 'Female' END) AS gender, contact_no, email, (SELECT room_id FROM room_tbl AS RM WHERE RM.room_id = (SELECT room_id FROM rental_tbl AS RL WHERE Rl.user_id = UR.user_id)) AS room_id FROM user_tbl AS UR WHERE user_id = :user_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
				$stmt->execute();
				$rowUser = $stmt->fetch();

				$room_id = $rowUser['room_id'];
				$query = "SELECT room_id, room_name, rent_rate, room_description FROM room_tbl AS RM WHERE room_id = :room_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				$stmt->execute();
				$rowRoom = $stmt->fetch();

				$data = array("success" => "true", "user_id" => $rowUser['user_id'], "name" => $rowUser['name'], "birth_date" => $rowUser['birth_date'], "gender" => $rowUser['gender'], "contact_no" => $rowUser['contact_no'], "email" => $rowUser['email'], "room_id" => $rowRoom['room_id'], "room_name" => $rowRoom['room_name'], "rent_rate" => $rowRoom['rent_rate'], "room_description" => $rowRoom['room_description']);
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

	//a_utilitybills.php view details
	if(isset($_POST['view_utility_bills_data'])){
		$utility_bill_type_id = $_POST['utility_bill_type_id_data'];

		if($utility_bill_type_id != NULL){
			$query_check = "SELECT utility_bill_type_id FROM utility_bill_type_tbl WHERE utility_bill_type_id = :utility_bill_type_id AND apartment_id = :apartment_id AND flag = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':utility_bill_type_id', $utility_bill_type_id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "SELECT utility_bill_type_id, utility_bill_type, description FROM utility_bill_type_tbl WHERE utility_bill_type_id = :utility_bill_type_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':utility_bill_type_id', $utility_bill_type_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$data = array("success" => "true", "id" => $row['utility_bill_type_id'], "type" => $row['utility_bill_type'], "description" => $row['description']);
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

	//a_crequests.php view details of request
	if(isset($_POST['view_request_pending_details_data'])){
		$request_id = $_POST['request_id_data'];

		if($request_id != NULL){
			$query_check = "SELECT request_id FROM request_change_room_tbl WHERE request_id = :request_id AND apartment_id = :apartment_id AND status = 2";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
			$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				$query = "SELECT request_id, date_requested, user_id, (SELECT concat(last_name, ', ', first_name, ' ', middle_name) FROM user_tbl AS US WHERE US.user_id = RCR.user_id) AS name, (SELECT room_name FROM room_tbl AS RM WHERE RM.room_id = (SELECT RL.room_id FROM rental_tbl AS RL WHERE RL.rental_id = RCR.current_rental_id)) AS current_room, (SELECT room_name FROM room_tbl AS RM WHERE RM.room_id = RCR.requested_room) AS requested_room FROM request_change_room_tbl AS RCR WHERE request_id = :request_id AND apartment_id = :apartment_id AND status = 2";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
				$stmt->bindParam(':apartment_id', $_SESSION['admin_id'], PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();

				$data = array("success" => "true", "id" => $row['request_id'], "date" => $row['date_requested'], "user_id" => $row['user_id'], "name" => $row['name'], "current_room" => $row['current_room'], "requested_room" => $row['requested_room']);
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