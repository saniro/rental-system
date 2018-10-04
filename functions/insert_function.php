<?php
	require("../connection/connection.php");
	if(isset($_POST['bill_type_data']) && isset($_POST['bill_desc_data'])){
		$bill_type = $_POST['bill_type_data'];
		$bill_desc = $_POST['bill_desc_data'];

		if(($bill_type != NULL) || ($bill_desc != NULL)){
			$query_check = "SELECT bill_type_id FROM bill_type_tbl WHERE bill_type = :bill_type";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':bill_type', $bill_type, PDO::PARAM_STR);
			$stmt->execute();
			$rowCount = $stmt->rowCount();
			if($rowCount < 1){
				$query = "INSERT INTO bill_type_tbl (bill_type, description) VALUES (:bill_type, :description)";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':bill_type', $bill_type, PDO::PARAM_STR);
				$stmt->bindParam(':description', $bill_desc, PDO::PARAM_STR);
				$stmt->execute();
				$data = array("success" => "true", "message" => "New bill type has been added.");
				$output = json_encode($data);
				echo $output;
			}
			else{
				$data = array("success" => "false", "message" => "There is already the same bill type.");
				$output = json_encode($data);
				echo $output;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Bill Type or Bill Description must not be empty.");
			$output = json_encode($data);
			echo $output;
		}
	}

	if(isset($_POST['room_new_tenant_data'])){
		$roomid = $_POST['room_id_data'];
		$firstname = $_POST['first_name_data'];
		$middlename = $_POST['middle_name_data'];
		$lastname = $_POST['last_name_data'];
		$birthdate = $_POST['birth_date_data'];
		$gender = $_POST['gender_data'];
		$contactno = $_POST['contactno_data'];
		$email = $_POST['email_data'];

		//$profilepic = $_POST['profilepic_data'];

		if(($firstname != NULL) && ($lastname != NULL) && ($birthdate != NULL) && ($gender != NULL) && ($contactno != NULL) && ($roomid != NULL) && ($email != NULL)){
			$query_check = "SELECT user_id FROM user_tbl WHERE email = :email";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->execute();
			$rowCount = $stmt->rowCount();
			if($rowCount < 1){
				//Check if room exist
				$query_check = "SELECT room_id, rent_rate FROM room_tbl WHERE room_id = :room_id AND flag = 1";
				$stmt = $con->prepare($query_check);
				$stmt->bindParam(':room_id', $roomid, PDO::PARAM_INT);
				$stmt->execute();
				$rowCount = $stmt->rowCount();
				if($rowCount < 1){
					$data = array("success" => "false", "message" => "The room doesn't exist.");
					$output = json_encode($data);
					echo $output;
				}
				else{
					$row = $stmt->fetch();
					$rent_rate = $row["rent_rate"];

					$query_check = "SELECT rental_id FROM rental_tbl WHERE room_id = :room_id AND status = 1";
					$stmt = $con->prepare($query_check);
					$stmt->bindParam(':room_id', $roomid, PDO::PARAM_INT);
					$stmt->execute();
					$rowCount = $stmt->rowCount();
					if($rowCount < 1){
						$query = "INSERT INTO user_tbl (email, password, last_name, first_name, middle_name, birth_date, gender, contact_no, user_type) VALUES (:email, 1, :last_name, :first_name, :middle_name, :birth_date, :gender, :contact_no, 0)";
						$stmt = $con->prepare($query);
						$stmt->bindParam(':email', $email, PDO::PARAM_STR);
						//$stmt->bindParam(':password', $password, PDO::PARAM_STR);
						$stmt->bindParam(':last_name', $lastname, PDO::PARAM_STR);
						$stmt->bindParam(':first_name', $firstname, PDO::PARAM_STR);
						$stmt->bindParam(':middle_name', $middlename, PDO::PARAM_STR);
						$stmt->bindParam(':birth_date', $birthdate, PDO::PARAM_STR);
						$stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
						$stmt->bindParam(':contact_no', $contactno, PDO::PARAM_STR);
						//$stmt->bindParam(':profile_picture', $profilepic, PDO::PARAM_STR);
						$stmt->execute();
						$lastInsertedID = $con->lastInsertId();

						$query = "INSERT INTO rental_tbl (starting_date, room_id, user_id) VALUES (CURDATE(), :room_id, :lastInsertedID)";
						$stmt = $con->prepare($query);
						$stmt->bindParam(':room_id', $roomid, PDO::PARAM_INT);
						$stmt->bindParam(':lastInsertedID', $lastInsertedID, PDO::PARAM_INT);
						$stmt->execute();
						$rentalLastInsertedID = $con->lastInsertId();

						$query = "INSERT INTO monthly_rent_tbl (rental_id, payables, due_date) VALUES (:lastInsertedID, :rent_rate, DATE_ADD(curdate(), INTERVAL 1 MONTH) )";
						$stmt = $con->prepare($query);
						$stmt->bindParam(':lastInsertedID', $rentalLastInsertedID, PDO::PARAM_INT);
						$stmt->bindParam(':rent_rate', $rent_rate, PDO::PARAM_INT);
						$stmt->execute();

						$data = array("success" => "true", "message" => "New tenant has been added.");
						$output = json_encode($data);
						echo $output;
					}
					else{
						$data = array("success" => "false", "message" => "The room is already occupied.");
						$output = json_encode($data);
						echo $output;
					}
				}
			}
			else{
				$data = array("success" => "false", "message" => "There is already the email. Please choose another.");
				$output = json_encode($data);
				echo $output;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Some required fields are empty.");
			$output = json_encode($data);
			echo $output;
		}
	}

	//a_roomstable.php insert new tenant
	if(isset($_POST['add_tenant_table_data'])){
		$room_id = $_POST['room_id_data'];
		$firstname = $_POST['first_name_data'];
		$middlename = $_POST['middle_name_data'];
		$lastname = $_POST['last_name_data'];
		$birthdate = $_POST['birth_date_data'];
		$gender = $_POST['gender_data'];
		$contactno = $_POST['contactno_data'];
		$email = $_POST['email_data'];

		//$profilepic = $_POST['profilepic_data'];

		if(($room_id) && ($firstname != NULL) && ($lastname != NULL) && ($birthdate != NULL) && ($gender != NULL) && ($contactno != NULL) && ($email != NULL)){
			$query_check = "SELECT user_id FROM user_tbl WHERE email = :email";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->execute();
			$rowCount = $stmt->rowCount();
			if($rowCount < 1){
				//Check if room exist
				$query_check = "SELECT room_id, rent_rate FROM room_tbl WHERE room_id = :room_id AND flag = 1";
				$stmt = $con->prepare($query_check);
				$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				$stmt->execute();
				$rowCount = $stmt->rowCount();
				if($rowCount < 1){
					$data = array("success" => "false", "message" => "The room doesn't exist.");
					$output = json_encode($data);
					echo $output;
				}
				else{
					$row = $stmt->fetch();
					$rent_rate = $row["rent_rate"];

					$query_check = "SELECT rental_id FROM rental_tbl WHERE room_id = :room_id AND status = 1";
					$stmt = $con->prepare($query_check);
					$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
					$stmt->execute();
					$rowCount = $stmt->rowCount();
					if($rowCount < 1){
						$query = "INSERT INTO user_tbl (email, password, last_name, first_name, middle_name, birth_date, gender, contact_no, user_type) VALUES (:email, 1, :last_name, :first_name, :middle_name, :birth_date, :gender, :contact_no, 0)";
						$stmt = $con->prepare($query);
						$stmt->bindParam(':email', $email, PDO::PARAM_STR);
						//$stmt->bindParam(':password', $password, PDO::PARAM_STR);
						$stmt->bindParam(':last_name', $lastname, PDO::PARAM_STR);
						$stmt->bindParam(':first_name', $firstname, PDO::PARAM_STR);
						$stmt->bindParam(':middle_name', $middlename, PDO::PARAM_STR);
						$stmt->bindParam(':birth_date', $birthdate, PDO::PARAM_STR);
						$stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
						$stmt->bindParam(':contact_no', $contactno, PDO::PARAM_STR);
						//$stmt->bindParam(':profile_picture', $profilepic, PDO::PARAM_STR);
						$stmt->execute();
						$lastInsertedID = $con->lastInsertId();

						$query = "INSERT INTO rental_tbl (starting_date, room_id, user_id) VALUES (CURDATE(), :room_id, :lastInsertedID)";
						$stmt = $con->prepare($query);
						$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
						$stmt->bindParam(':lastInsertedID', $lastInsertedID, PDO::PARAM_INT);
						$stmt->execute();
						$rentalLastInsertedID = $con->lastInsertId();

						$query = "INSERT INTO monthly_rent_tbl (rental_id, payables, due_date) VALUES (:lastInsertedID, :rent_rate, DATE_ADD(curdate(), INTERVAL 1 MONTH) )";
						$stmt = $con->prepare($query);
						$stmt->bindParam(':lastInsertedID', $rentalLastInsertedID, PDO::PARAM_INT);
						$stmt->bindParam(':rent_rate', $rent_rate, PDO::PARAM_INT);
						$stmt->execute();

						$query = "SELECT room_id, room_name, rent_rate, room_description FROM room_tbl WHERE room_id = :room_id";
						$stmt = $con->prepare($query);
						$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
						$stmt->execute();
						$row = $stmt->fetch();

						$data = array("success" => "true", "message" => "New tenant has been added.", "room_id" => $row['room_id'], "room_name" => $row['room_name'], "rent_rate" => $row['rent_rate'], "room_description" => $row['room_description'], "status" => "Occupied", "buttons" => '<center><button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnViewDetails" data-id="' .$room_id.'"><span class="fa fa-file-text-o"></span></button> <button data-toggle="tooltip" title="Edit Details" class="btn btn-success" id="btnEdit" data-id="' .$room_id.'"><span class="fa fa-edit"></span></button></center>');
						$output = json_encode($data);
						echo $output;
					}
					else{
						$data = array("success" => "false", "message" => "The room is already occupied.");
						$output = json_encode($data);
						echo $output;
					}
				}
			}
			else{
				$data = array("success" => "false", "message" => "There is already the email. Please choose another.");
				$output = json_encode($data);
				echo $output;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Some required fields are empty.");
			$output = json_encode($data);
			echo $output;
		}
	}

	//a_complaints.php send reply
	if(isset($_POST['submit_reply_complaint_data'])){
		$complaint_id = $_POST['complaint_id_data'];
		$response = $_POST['response_data'];
		//$profilepic = $_POST['profilepic_data'];

		if(($complaint_id) && ($response != NULL)){
			$query_check = "SELECT complaint_id FROM complaint_tbl WHERE complaint_id = :complaint_id AND response IS NULL";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
			$stmt->execute();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				//Check if room exist
				$query = "UPDATE complaint_tbl
						 SET response = :response, response_date = CURDATE()
						 WHERE complaint_id = :complaint_id";

				$stmt = $con->prepare($query);
				$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
				$stmt->bindParam(':response', $response, PDO::PARAM_STR);
				$stmt->execute();
				
				$query_check = "SELECT complaint_id, DATE_FORMAT(message_date, '%M %d, %Y') AS message_date, (SELECT concat(last_name, ', ', first_name, ' ', middle_name) FROM user_tbl AS UR WHERE UR.user_id = CT.user_id) AS name FROM complaint_tbl AS CT WHERE complaint_id = :complaint_id";
				$stmt = $con->prepare($query_check);
				$stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch();
				$data = array("success" => "true", "message" => "Your response has been sent.", "complaint_id" => $row['complaint_id'], "message_date" => $row['message_date'], "name" => $row['name'], "status" => "Responded", "buttons" => '<center><button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnDetails" data-id="'.$row['complaint_id'].'"><span class="fa fa-file-text-o"></span></button></center>');
					$output = json_encode($data);
					echo $output;
			}
			else{
				$data = array("success" => "false", "message" => "Something went wrong. Please try again.");
				$output = json_encode($data);
				echo $output;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Some required fields are empty.");
			$output = json_encode($data);
			echo $output;
		}
	}
?>