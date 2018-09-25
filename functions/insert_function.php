<?php
	require("../connection/connection.php");
	if(isset($_POST['bill_type_data']) && isset($_POST['bill_desc_data'])){
		$bill_type = $_POST['bill_type_data'];
		$bill_desc = $_POST['bill_desc_data'];

		if(($bill_type != NULL) && ($bill_desc != NULL)){
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
?>