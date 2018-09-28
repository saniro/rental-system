<?php
    if(isset($_SESSION['user_id'])){
        header("location:index?route=dashboard");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Apartment Rental</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Apartment Rental Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" id = "email" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" type="password" id="password">
                                </div>
                                <div class="checkbox">
                                   <label>
                                        <input type="checkbox" onclick="showpassword()" value="Show Password">Show Password
                                   </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type = "button" class="btn btn-lg btn-success btn-block login">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script type="text/javascript" src = "lib\jQuery-3.3.1\jquery-3.3.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

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

        function showpassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script type="text/javascript">
        
    </script>


</body>

</html>
