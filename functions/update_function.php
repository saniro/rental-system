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
?>