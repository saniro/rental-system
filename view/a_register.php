<?php
    if(!isset($_SESSION['admin_id'])){
        header("location:index");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
    <link rel="icon" href="img/apicon.png">
	<script type="text/javascript" src = "lib\jQuery-3.3.1\jquery-3.3.1.min.js"></script>
</head>
<body>
	<form>
		First Name: <input type="text" id="firstname" name="first_name"><br>
		Middle Name: <input type="text" id="middlename" name="middlename"><br>
		Last Name: <input type="text" id="lastname" name="lastname"><br>
		Birth Date: <input type="date" id="birthdate" name="birthdate"><br>
		Gender: <input type="radio" id="gender" name="gender" value="1" checked> Male <input type="radio" id="gender" name="gender" value="0"> Female<br>
		Contact Number: <input type="text" id="contactno" name="contactno"><br>
		Room No: <input type="text" id="roomno" name="roomno"><br>
		Email: <input type="text" id="email" name="email"><br>
		Password: <input type="text" id="password" name="password"><br>
		Profile Picture: <input type="file" id="profilepic" name="profilepic"><br>
		<button type="button" class="register">Register</button>
	</form>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.register').on('click', function() {
				var room_new_tenant = 'Clicked';
				var firstname = $('#firstname').val();
				var middlename = $('#middlename').val();
				var lastname = $('#lastname').val();
				var birthdate = $('#birthdate').val();
				var gender = $('input[name=gender]:checked').val();
				var contactno = $('#contactno').val();
				var profilepic = $('#profilepic').val();
				var email = $('#email').val();
				var password = $('#password').val();
				var roomno = $('#roomno').val();
				$.ajax({
					url: 'functions/insert_function.php',
					method: 'POST',
					data: {
						room_new_tenant_data: room_new_tenant,
						firstname_data: firstname,
						middlename_data: middlename,
						lastname_data: lastname,
						birthdate_data: birthdate,
						gender_data: gender,
						contactno_data: contactno,
						profilepic_data: profilepic,
						roomno_data: roomno,
						email_data: email,
						password_data: password
					},
					success: function(data){
						var data = JSON.parse(data);
						if(data.success == "true"){
							alert(data.message);
						}
						else if(data.success == "false"){
							alert(data.message);
						}
					},
					error: function(xhr){
						console.log(xhr.status + ":" + xhr.statusText);
					}
				});
			});
		});
	</script>
</body>
</html>
