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

					$data = array("success" => "true", "status" => "occupied", "room_id" => $room_id, "room_name" => $row_room['room_name'], "rent_rate" => $row_room['rent_rate'], "room_description" => $row_room['room_description'], "user_id" => $row_user['user_id'], "name" => $row_user['name'], "birth_date" => $row_user['birth_date'], "gender" => $row_user['gender'], "contact_no" => $row_user['contact_no'], "email" => $row_user['email']);
					$results = json_encode($data);
					echo $results;

				}
				else{
					$data = array("success" => "true", "status" => "vacant", "message" => "hey");
					$results = json_encode($data);
					echo $results;
				}


				// $query = "SELECT room_id, room_name, rent_rate, room_description, (CASE WHEN (SELECT rental_id FROM rental_tbl AS RL WHERE RL.room_id = RM.room_id AND status = 1) IS NULL THEN 'Vacant' ELSE 'Occupied' END) AS status FROM room_tbl AS RM WHERE room_id = :room_id";
				// $stmt = $con->prepare($query);
				// $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				// $stmt->execute();
				// $row = $stmt->fetch();

				// $data = array("success" => "true", "room_id" => $row['room_id'], "room_name" => $row['room_name'], "rent_rate" => $row['rent_rate'], "room_description" => $row['room_description'], "status" => $row['status']);
				// $results = json_encode($data);
				// echo $results;
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