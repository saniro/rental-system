<?php
	require("../connection/connection.php");

	if(isset($_POST['room_check_data'])){
		$room_id = $_POST['room_id_data'];
		$query_check = "SELECT room_id FROM room_tbl WHERE room_id = :room_id";
		$stmt = $con->prepare($query_check);
		$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
		$stmt->execute();
		// $result = $stmt->fetch();
		$rowCount = $stmt->rowCount();
		if ($rowCount > 0){
			$query_check = "SELECT rental_id, room_id, user_id, status FROM rental_tbl WHERE room_id = :room_id AND status = 1";
			$stmt = $con->prepare($query_check);
			$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
			$stmt->execute();
			$results = $stmt->fetch();
			$rowCount = $stmt->rowCount();
			if($rowCount > 0){
				if($results['status'] == 1){
					$user_id = $results['user_id'];
					$rental_id = $results['rental_id'];
					$query = "SELECT room_id, room_name, rent_rate, room_description, room_picture FROM room_tbl WHERE room_id = :room_id";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
					$stmt->execute();
					$room_results = $stmt->fetch();

					$query = "SELECT profile_picture, user_id, concat(last_name,  ', ', first_name, ' ', middle_name) AS name, DATE_FORMAT(birth_date,'%b %d, %Y') AS birth_date, (CASE WHEN gender = 1 THEN 'Male' WHEN gender = 0 THEN 'Female' END) AS gender, contact_no, email FROM user_tbl WHERE user_id = :user_id";
					$stmt = $con->prepare($query);
					$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
					$stmt->execute();
					$user_results = $stmt->fetch();

					$data = array("success" => "true", "status" => "occupied", "rental_id" => $rental_id, "room_id" => $room_results['room_id'], "room_name" => $room_results['room_name'], "rent_rate" => $room_results['rent_rate'], "room_description" => $room_results['room_description'], "room_picture" => $room_results['room_picture'], "profile_picture" => $user_results['profile_picture'], "user_id" => $user_results['user_id'], "name" => $user_results['name'], "birth_date" => $user_results['birth_date'], "gender" => $user_results['gender'], "contact_no" => $user_results['contact_no'], "email" => $user_results['email']);
					$results = json_encode($data);
					echo $results;
				}
			}
			else{
				$user_id = $results['user_id'];
				$query = "SELECT room_id, room_name, rent_rate, room_description, room_picture FROM room_tbl WHERE room_id = :room_id";
				$stmt = $con->prepare($query);
				$stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
				$stmt->execute();
				$room_results = $stmt->fetch();

				$data = array("success" => "true", "status" => "vacant", "room_id" => $room_results['room_id'], "room_name" => $room_results['room_name'], "rent_rate" => $room_results['rent_rate'], "room_description" => $room_results['room_description'], "room_picture" => $room_results['room_picture']);
				$results = json_encode($data);
				echo $results;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Room doesn't exist.");
			$results = json_encode($data);
			echo $results;
		}
	}
?>