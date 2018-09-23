<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<script type="text/javascript" src = "lib\jQuery-3.3.1\jquery-3.3.1.min.js"></script>
</head>
<body>
	<form method = "post">
		email : <input type="text" id = "email" name="email"><br>
		password : <input type="text" id = "password" name="password"><br>	
		<button type = "button" class = "login" name = "login">Login</button>
	</form>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.login').on('click', function() {
				var email = $("#email").val();
				var password = $("#password").val();
				$.ajax({
					url: 'functions/login_function.php',
					method: 'POST',
					data: {
						email_data: email,
						password_data: password
					},
					success: function(data){
						var data = JSON.parse(data);

						if(data.success == "true"){
							alert("Welcome " + data.first_name + "!");
							window.location.href = "index?route=dashboard";
						}
						else if(data.success == "false"){
							alert(data.message);
						}
					},
					error: function(xhr){
						console.log(xhr.status + ":" + xhr.statusText);
					}
				});
				//alert(email + ' ' + password);
			});
		});
	</script>
</body>
</html>