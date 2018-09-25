<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<script type="text/javascript" src = "lib\jQuery-3.3.1\jquery-3.3.1.min.js"></script>
</head>
<body>
	<form>
		First Name: <input type="text" id="firstname" name="first_name"><br>
		Middle Name: <input type="text" id="middlename" name="middlename"><br>
		Last Name: <input type="text" id="lastname" name="lastname"><br>
		Birth Date: <input type="date" id="birthdate" name="birthdate"><br>
		Gender: <input type="radio" id="male" name="male" value="male"> Male <input type="radio" id="male" name="male" value="female"> Female<br>
		Contact Number: <input type="text" id="contactno" name="contactno"><br>
		Profile Picture: <input type="file" id="profilepic" name="profilepic"><br>
		<button type="button" class="register">Register</button>
	</form>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.register').on('click', function() {
				var firstname = $('#firstname').val();
				var middlename = $('#middlename').val();
				var lastname = $('#lastname').val();
				var birthdate = $('#birthdate').val();
				if($('input[name=male]:checked').length > 0){
					alert('hey');
				}
				var contactno = $('#contactno').val();
				var profilepic = $('#profilepic').val();
				alert(firstname + ' ' + middlename + ' ' + lastname + ' ' + birthdate + ' ' + gender + ' ' + contactno + ' ' + profilepic);
			});
		});
	</script>
</body>
</html>