<?php
    if(!isset($_SESSION['admin_id'])){
        header("location:index");
    }
?>
<?php
    require("functions/select_all_function.php");
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
    <link rel="icon" href="img/apicon.png">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Rooms Map -->
    <link href="dist/css/map.css" rel="stylesheet">


</head>

<body>

    <div id="wrapper">

        <?php
            require("a_navigation.php");
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Rooms Map</h1>
                    <div class="floordivider"></div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="floortitle">First Floor</h4>
                            <button class="room <?php if(room_check(1) == 1){ echo 'occupied'; }; ?> leftcorner" id= "1" data-id="1">Room 01</button>
                            <button class="room <?php if(room_check(2) == 1){ echo 'occupied'; }; ?>" id= "2" data-id="2">Room 02</button>
                            <button class="room <?php if(room_check(3) == 1){ echo 'occupied'; }; ?>" id= "3" data-id="3">Room 03</button>
                            <button class="room <?php if(room_check(4) == 1){ echo 'occupied'; }; ?>" id= "4" data-id="4">Room 04</button>
                            <br>
                    </div>
                </div>

                <div class="floordivider"><br></div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="floortitle">Second Floor</h4>
                            <button class="room <?php if(room_check(5) == 1){ echo 'occupied'; }; ?> leftcorner" id= "5" data-id="5">Room 05</button>
                            <button class="room <?php if(room_check(6) == 1){ echo 'occupied'; }; ?>" id= "6" data-id="6">Room 06</button>
                            <button class="room <?php if(room_check(7) == 1){ echo 'occupied'; }; ?>" id= "7" data-id="7">Room 07</button>
                            <button class="room <?php if(room_check(8) == 1){ echo 'occupied'; }; ?>" id= "8" data-id="8">Room 08</button>
                            <br>
                    </div>
                </div>

                <div class="floordivider"><br></div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="floortitle">Third Floor</h4>
                            <button class="room <?php if(room_check(9) == 1){ echo 'occupied'; }; ?> leftcorner" id= "9" data-id="9">Room 09</button>
                            <button class="room <?php if(room_check(10) == 1){ echo 'occupied'; }; ?>" id= "10" data-id="10">Room 10</button>
                            <button class="room <?php if(room_check(11) == 1){ echo 'occupied'; }; ?>" id= "11" data-id="11">Room 11</button>
                            <button class="room <?php if(room_check(12) == 1){ echo 'occupied'; }; ?>" id= "12" data-id="12">Room 12</button>
                            <br>
                    </div>
                </div>

                <div class="floordivider"><br></div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="floortitle">Fourth Floor</h4>
                            <button class="room <?php if(room_check(13) == 1){ echo 'occupied'; }; ?> leftcorner" id= "13" data-id="13">Room 13</button>
                            <button class="room <?php if(room_check(14) == 1){ echo 'occupied'; }; ?>" id= "14" data-id="14">Room 14</button>
                            <button class="room <?php if(room_check(15) == 1){ echo 'occupied'; }; ?>" id= "15" data-id="15">Room 15</button>
                            <button class="room <?php if(room_check(16) == 1){ echo 'occupied'; }; ?>" id= "16" data-id="16">Room 16</button>
                            <br>
                    </div>
                </div>

                <div class="floordivider"><br></div>

                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="floortitle">Fifth Floor</h4>
                            <button class="room <?php if(room_check(17) == 1){ echo 'occupied'; }; ?> leftcorner" id= "17" data-id="17">Room 17</button>
                            <button class="room <?php if(room_check(18) == 1){ echo 'occupied'; }; ?>" id= "18" data-id="18">Room 18</button>
                            <button class="room <?php if(room_check(19) == 1){ echo 'occupied'; }; ?>" id= "19" data-id="19">Room 19</button>
                            <button class="room <?php if(room_check(20) == 1){ echo 'occupied'; }; ?>" id= "20" data-id="20">Room 20</button>
                            <br>
                    </div>
                </div>
            </div>
            <div class="floordivider"><br></div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<!-- This is the Modal that will be called for vacant room btn -->
    <div id = "modalVacantRoom" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Add Room Tenant </h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#v_room" data-toggle="tab" aria-expanded="false">Room</a>
                            </li>
                            <li class=""><a href="#v_add" data-toggle="tab" aria-expanded="true">+ ADD</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="v_room">
                                <center><br><h4>Room Information</h4></center>
                                <form>
                                    <!-- <div class="form-group">
                                        <label> Picture: </label>
                                        <label id="v_room_picture" class="form-control"></label>
                                    </div> -->
                                    <div class="form-group">
                                        <label> ID: </label>
                                        <label id="v_room_id" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Room Name: </label>
                                        <label id="v_room_name" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Rent Rate: </label>
                                        <label id="v_rent_rate" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Description: </label>
                                        <label id="v_room_description" class="form-control"></label>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="v_add">
                                <center><br><h4>Tenant</h4></center>
                                <form>
                                    <div class="form-group">
                                        <label> First Name: </label>
                                        <input type="text" id="a_first_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label> Middle Name: </label>
                                        <input type="text" id="a_middle_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label> Last Name: </label>
                                        <input type="text" id="a_last_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Birthdate:</label>
                                        <input type="date" id="a_birth_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Gender:</label>
                                        <div class="form-control">
                                            <input style="width:30%;" type="radio" name="a_gender" id="a_gender" value="1" checked />Male
                                            <input style="width:30%;" type="radio" name="a_gender" id="a_gender" value="0"/>Female
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact No:</label>
                                        <input type="text" id="a_contactno" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="text" id="a_email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Profile Picture:</label>
                                        <input type="file" id="a_profile_picture" class="form-control">
                                    </div>
                                </form>
                                <br>
                                <button type="button" id="AddTenantSubmit" class="btn btn-primary btn-lg btn-block">ADD TENANT</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "modal-footer">
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                </div>
            </div>
        </div>
    </div>
<!-- This is the Modal that will be called for occupied room btn -->
    <div id = "modalOccupiedRoom" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Room Details </h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#room" data-toggle="tab" aria-expanded="false">Room</a>
                            </li>
                            <li class=""><a href="#profile" data-toggle="tab" aria-expanded="true">Tenant</a>
                            </li>
                            <li class=""><a href="#rental" data-toggle="tab" aria-expanded="false">Rental Payment</a>
                            </li>
                            <li class=""><a href="#utility" data-toggle="tab" aria-expanded="true">Utility Payment</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="room">
                                <center><br><h4>Room Information</h4></center>
                                <form>
                                    <!-- <div class="form-group">
                                        <label> Picture: </label>
                                        <label id="o_room_picture" class="form-control"></label>
                                    </div> -->
                                    <div class="form-group">
                                        <label> ID: </label>
                                        <label id="o_room_id" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Room Name: </label>
                                        <label id="o_room_name" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Rent Rate: </label>
                                        <label id="o_rent_rate" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Description: </label>
                                        <label id="o_room_description" class="form-control"></label>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <center><br><h4>Tenant</h4></center>
                                <form>
                                    <!-- <div class="form-group">
                                        <label>Profile Picture: </label>
                                        <label id="o_profile_picture" class="form-control"></label>
                                    </div> -->
                                    <div class="form-group">
                                        <label> ID: </label>
                                        <label id="o_user_id" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Name: </label>
                                        <label id="o_name" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Birthdate: </label>
                                        <label id="o_birthdate" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Gender: </label>
                                        <label id="o_gender" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Contact No: </label>
                                        <label id="o_contactno" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Email: </label>
                                        <label id="o_email" class="form-control"></label>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="rental">
                                <center><br><h4>Rental Payment</h4></center>

                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#full" data-toggle="tab" aria-expanded="false">Full Payment</a>
                                        </li>
                                        <li class=""><a href="#partial" data-toggle="tab" aria-expanded="true">Partial Payment</a>
                                        </li>
                                    </ul>


                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="full">
                                        <form>
                                            <div class="form-group">
                                                <label> Amount: </label>
                                                <label id="" class="form-control"></label>
                                            </div>
                                            <div class="form-group">
                                                <label> Due Date: </label>
                                                <label id="" class="form-control"></label>
                                            </div>
                                            <button id="" type="button" class="form-control btn btn-primary">Mark as Fully Paid</button>
                                        </form>
                                        </div>
                                        <div class="tab-pane fade" id="partial">
                                        <form>
                                            <div class="form-group">
                                                <label> Amount: </label>
                                                <label id="" class="form-control"></label>
                                            </div>
                                            <div class="form-group">
                                                <label> Due Date: </label>
                                                <label id="" class="form-control"></label>
                                            </div>
                                            <div class="form-group">
                                                <label> Partial Payment: </label>
                                                <input type="text" name="" class="form-control">
                                            </div>
                                            <button id="" type="button" class="form-control btn btn-primary">Add Partial Payment</button>
                                        </form>
                                        </div>
                                    </div>


                            </div>
                            <div class="tab-pane fade" id="utility">
                                <center><br><h4>Utility Payment</h4></center>
                                <form>
                                    <div class="form-group">
                                        <label> Amount: </label>
                                        <label id="" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Due Date: </label>
                                        <label id="" class="form-control"></label>
                                    </div>
                                    <button id="" type="button" class="form-control btn btn-primary">Mark as Fully Paid</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-danger" id="btnTerminate" data-dismiss = "modal">TERMINATE </button>
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                </div>
            </div>
        </div>
    </div>

    <div id = "modalTerminate" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Terminate Rental </h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label> Room name: </label>
                            <label id = "c_room_name" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Name: </label>
                            <label id = "c_name" class="form-control"></label>
                        </div>
                    </form>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-success" id="SubmitTerminate" data-dismiss = "modal"> YES </button>
                    <button type ="button" class = "btn btn-danger" data-dismiss = "modal"> NO </button>
                </div>
            </div>
        </div>
    </div>

<!-- 
    <div id = "modalRentalConfirm" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Mark as Fully Paid </h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label> Room name: </label>
                            <label id = "" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Name: </label>
                            <label id = "" class="form-control"></label>
                        </div>
                    </form>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-primary" id="" data-dismiss = "modal"> YES </button>
                    <button type ="button" class = "btn btn-danger" data-dismiss = "modal"> NO </button>
                </div>
            </div>
        </div>
    </div>



    <div id = "modalUtilityConfirm" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Mark as Fully Paid </h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label> Room name: </label>
                            <label id = "" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Name: </label>
                            <label id = "" class="form-control"></label>
                        </div>
                    </form>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-primary" id="" data-dismiss = "modal"> YES </button>
                    <button type ="button" class = "btn btn-danger" data-dismiss = "modal"> NO </button>
                </div>
            </div>
        </div>
    </div> -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });

            // $(document).on('click', '#btnRentalConfirm', function(){
            //     $('#modalRentalConfirm').modal('show');
            // });

            // $(document).on('click', '#btnUtilityConfirm', function(){
            //     $('#modalUtilityConfirm').modal('show');
            // });

            $(document).on('click', '.room', function(){
                var room_id = $(this).attr('data-id');
                var room_check = 'selected';
                $.ajax({
                    url: 'functions/room_function.php',
                    method: 'POST',
                    data: {
                        room_check_data: room_check,
                        room_id_data: room_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            if(data.status == "occupied"){
                                $("#o_room_picture").html(data.room_picture);
                                $("#o_room_id").html(data.room_id);
                                $("#o_room_name").html(data.room_name);
                                $("#o_rent_rate").html(data.rent_rate);
                                $("#o_room_description").html(data.room_description);

                                $("#o_profile_picture").html(data.profile_picture);
                                $("#o_user_id").html(data.user_id);
                                $("#o_name").html(data.name);
                                $("#o_birthdate").html(data.birth_date);
                                $("#o_gender").html(data.gender);
                                $("#o_contactno").html(data.contact_no);
                                $("#o_email").html(data.email);
                                $("#btnTerminate").attr('data-id', data.rental_id);
                                $('#modalOccupiedRoom').modal('show');
                            }
                            else if (data.status == "vacant"){
                                $("#v_room_picture").html(data.room_picture);
                                $("#v_room_id").html(data.room_id);
                                $("#v_room_name").html(data.room_name);
                                $("#v_rent_rate").html(data.rent_rate);
                                $("#v_room_description").html(data.room_description);
                                $("#AddTenantSubmit").attr('data-id', data.room_id);
                                $('#modalVacantRoom').modal('show');
                            }
                            // var table = $('#table-contents').DataTable();
                        //     table.row('#'+tenant_id).remove().draw();
                        }
                        else if (data.success == "false"){
                            alert(data.message);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.status + ":" + xhr.statusText);
                    }
                });
            });

            $(document).on('click', '#AddTenantSubmit', function(){
                var room_id = $(this).attr('data-id');
                var room_new_tenant = 'selected';
                var first_name = $("#a_first_name").val();
                var middle_name = $("#a_middle_name").val();
                var last_name = $("#a_last_name").val();
                var birth_date = $("#a_birth_date").val();
                var gender = $("#a_gender").val();
                var contactno = $("#a_contactno").val();
                var email = $("#a_email").val();
                var profile_picture = $("#a_profile_picture").val();

                $.ajax({
                    url: 'functions/insert_function.php',
                    method: 'POST',
                    data: {
                        room_id_data: room_id,
                        room_new_tenant_data: room_new_tenant,
                        first_name_data: first_name,
                        middle_name_data: middle_name,
                        last_name_data: last_name,
                        birth_date_data: birth_date,
                        gender_data: gender,
                        contactno_data: contactno,
                        email_data: email
                        //profile_picture_data = profile_picture
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            alert(data.message);
                        }
                        else if(data.success == "false"){
                            alert(data.message);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.status + ":" + xhr.statusText);
                    }
                });
            });

            $(document).on('click', '#btnTerminate', function(){
                var rental_id = $(this).attr('data-id');
                var rental_terminate = 'selected';
                $.ajax({
                    url: 'functions/select_delete_function.php',
                    method: 'POST',
                    data: {
                        rental_terminate_data: rental_terminate,
                        rental_id_data: rental_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#c_room_name").html(data.room_name);
                        $("#c_name").html(data.user_name);
                        $("#SubmitTerminate").attr('data-id', data.rental_id);
                        $('#modalTerminate').modal('show');
                    },
                    error: function(xhr) {
                        console.log(xhr.status + ":" + xhr.statusText);
                    }
                });
            });

            $(document).on('click', '#SubmitTerminate', function(){
                var rental_id = $(this).attr('data-id');
                var rental_terminate = 'selected';
                $.ajax({
                    url: 'functions/delete_function.php',
                    method: 'POST',
                    data: {
                        rental_terminate_data: rental_terminate,
                        rental_id_data: rental_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            alert(data.room_id);
                            $("#"+data.room_id).removeClass("occupied");
                            alert(data.message);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.status + ":" + xhr.statusText);
                    }
                });
            });

        });
    </script>
</body>

</html>
