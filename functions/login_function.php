<?php
	session_start();
	require("../connection/connection.php");
	if(isset($_POST['email_data']) && isset($_POST['password_data'])){
		$email = $_POST['email_data'];
		$password = $_POST['password_data'];

		if(($email != NULL) || ($password != NULL)){
			$query = "SELECT apartment_id, apartment_name, password FROM apartment_tbl WHERE email = :email AND password = :password AND status = 1 AND flag = 1";
			$stmt = $con->prepare($query);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch();
			$rowCount = $stmt->rowCount();

			if($rowCount == 0){
				$data = array("success" => "false", "message" => "Wrong email or password.");
				$output = json_encode($data);
				echo $output;
			}
			else{
				$_SESSION['admin_id'] = $row['apartment_id'];
				$_SESSION['name'] = $row['apartment_name'];
				$data = array("success" => "true", "first_name" => $row['apartment_name']);
				$output = json_encode($data);
				echo $output;
			}
		}
		else{
			$data = array("success" => "false", "message" => "Email or Password cannot be null.");
			$output = json_encode($data);
			echo $output;
		}
	}
?>