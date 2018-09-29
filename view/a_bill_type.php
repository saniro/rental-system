<?php
    if(!isset($_SESSION['user_id'])){
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
		<input type="text" id="bill_type" name="bill_type"><br>
		<textarea id="bill_desc" name="bill_desc"></textarea><br>
		<button type="button" class="create">Create</button>
	</form>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.create').on('click', function() {
				var bill_type = $("#bill_type").val();
				var bill_desc = $("#bill_desc").val();
				$.ajax({
					url: 'functions/insert_function.php',
					method: 'POST',
					data: {
						bill_type_data: bill_type,
						bill_desc_data: bill_desc
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

					}
				});
			});
		});
	</script>
</body>
</html>