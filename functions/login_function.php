<?php
	session_start();
	require("../connection/connection.php");
	if(isset($_POST['email_data']) && isset($_POST['password_data'])){
		$email = $_POST['email_data'];
		$password = $_POST['password_data'];

		if(($email != NULL) || ($password != NULL)){
			$query = "SELECT host_id, concat(last_name, ', ', first_name, ' ', middle_name) AS name FROM host_tbl WHERE email = :email AND password = :password AND status = 1 AND flag = 1";
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
				$_SESSION['admin_id'] = $row['host_id'];
				$_SESSION['name'] = $row['name'];
				$data = array("success" => "true", "name" => $row['name']);
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