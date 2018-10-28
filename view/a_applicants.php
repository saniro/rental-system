<?php
    if(!isset($_SESSION['admin_id'])){
        header("location:index");
    }
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


</head>

<body>

    <div id="wrapper">

        <?php
            require("a_navigation.php");
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Applicants</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <!-- <button title="Add New Tenant" class="btn btn-info" id="btnAdd"><span class="glyphicon glyphicon-plus"></span> Add</button> -->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact No.</th>
                                        <th>Room Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $all_applicants = all_applicants();
                                    $all_applicants = json_decode($all_applicants);

                                    foreach ($all_applicants as $value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value -> {'rental_id'}; ?></td>
                                        <td><?php echo $value -> {'name'}; ?></td>
                                        <td><?php echo $value -> {'email'}; ?></td>
                                        <td><?php echo $value -> {'contact_no'}; ?></td>
                                        <td class="center"><?php echo $value -> {'room_name'}; ?></td>
                                        <td class="center">
                                            <button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnView" data-id="<?php echo $value -> {'rental_id'}; ?>"><span class="fa fa-file-text-o"></span></button>
                                            <button data-toggle="tooltip" title="Approve" class="btn btn-primary" id="btnApprove" data-id="<?php echo $value -> {'rental_id'}; ?>"><span class="fa fa-check"></span></button>
                                            <button data-toggle="tooltip" title="Reject" class="btn btn-danger" id="btnReject" data-id="<?php echo $value -> {'rental_id'}; ?>"><span class="fa fa-times"></span></button>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- This is the Modal that will be called for view btn -->
      <div class = "modal fade" id = "modalView" role = "dialog">
        <div class = "modal-dialog">

          <div class="modal-content">
            <div class = "modal-header">
              <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Application Details </h4>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#room" data-toggle="tab" aria-expanded="false">Room</a>
                            </li>
                            <li class=""><a href="#profile" data-toggle="tab" aria-expanded="true">Applicant</a>
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
                                        <label class="form-control" id="v_room_id"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Room Name: </label>
                                        <label class="form-control" id="v_room_name"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Rent Rate: </label>
                                        <label class="form-control" id="v_rent_rate"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Description: </label>
                                        <label class="form-control" id="v_description"></label>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <center><br><h4>Applicant Information</h4></center>
                                <form>
                                    <!-- <div class="form-group">
                                        <label>Profile Picture: </label>
                                        <label id="o_profile_picture" class="form-control"></label>
                                    </div> -->
                                    <div class="form-group">
                                        <label> ID: </label>
                                        <label class="form-control" id="v_user_id"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Name: </label>
                                        <label class="form-control" id="v_name"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Birthdate: </label>
                                        <label class="form-control" id="v_birth"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Gender: </label>
                                        <label class="form-control" id="v_gender"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Contact No: </label>
                                        <label class="form-control" id="v_no"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Email: </label>
                                        <label class="form-control" id="v_email"></label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                  <div class = "modal-footer">
                    <!-- <button type ="button" class= "btn btn-success" data-dismiss="modal" id="SubmitAdd">ADD </button> -->
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                  </div>
                </div>
          </div>
        </div>


    <!-- This is the Modal that will be called for approve btn -->
      <div id = "modalApprove" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">

          <div class="modal-content">
            <div class = "modal-header">
              <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Approve Application </h4>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#room" data-toggle="tab" aria-expanded="false">Room</a>
                            </li>
                            <li class=""><a href="#profile" data-toggle="tab" aria-expanded="true">Applicant</a>
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
                                        <label class="form-control" id="a_room_id"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Room Name: </label>
                                        <label class="form-control" id="a_room_name"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Rent Rate: </label>
                                        <label class="form-control" id="a_rent_rate"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Description: </label>
                                        <label class="form-control" id="a_description"></label>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <center><br><h4>Applicant Information</h4></center>
                                <form>
                                    <!-- <div class="form-group">
                                        <label>Profile Picture: </label>
                                        <label id="o_profile_picture" class="form-control"></label>
                                    </div> -->
                                    <div class="form-group">
                                        <label> ID: </label>
                                        <label class="form-control" id="a_user_id"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Name: </label>
                                        <label class="form-control" id="a_name"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Birthdate: </label>
                                        <label class="form-control" id="a_birth"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Gender: </label>
                                        <label class="form-control" id="a_gender"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Contact No: </label>
                                        <label class="form-control" id="a_no"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Email: </label>
                                        <label class="form-control" id="a_email"></label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                  <div class = "modal-footer">
                    <button type="button" class = "btn btn-primary" data-dismiss = "modal" id="SubmitApprove">APPROVE</button>
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CANCEL </button>
                  </div>
                </div>
          </div>
        </div>


        <!-- This is the Modal that will be called for reject btn -->
          <div id = "modalReject" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Reject Application </h4>
                      </div>
                      <div class="modal-body">
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#room" data-toggle="tab" aria-expanded="false">Room</a>
                            </li>
                            <li class=""><a href="#profile" data-toggle="tab" aria-expanded="true">Applicant</a>
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
                                        <label class="form-control" id="r_room_id"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Room Name: </label>
                                        <label class="form-control" id="r_room_name"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Rent Rate: </label>
                                        <label class="form-control" id="r_rent_rate"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Description: </label>
                                        <label class="form-control" id="r_description"></label>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <center><br><h4>Applicant Information</h4></center>
                                <form>
                                    <!-- <div class="form-group">
                                        <label>Profile Picture: </label>
                                        <label id="o_profile_picture" class="form-control"></label>
                                    </div> -->
                                    <div class="form-group">
                                        <label> ID: </label>
                                        <label class="form-control" id="r_user_id"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Name: </label>
                                        <label class="form-control" id="r_name"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Birthdate: </label>
                                        <label class="form-control" id="r_birth"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Gender: </label>
                                        <label class="form-control" id="r_gender"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Contact No: </label>
                                        <label class="form-control" id="r_no"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Email: </label>
                                        <label class="form-control" id="r_email"></label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-danger" data-dismiss = "modal" id="SubmitReject">REJECT </button>
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CANCEL </button>
                      </div>
                    </div>
              </div>
            </div>
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
        var table = $('#dataTables-example').DataTable();
        $('[data-toggle="tooltip"]').tooltip();

        $(document).on('click', '#btnView', function(){
            var view_application_rent = 'selected';
            var rental_id = $(this).attr('data-id');
            table_row = $(this).parents('tr');

            $.ajax({
                url: 'functions/select_function.php',
                method: 'POST',
                data: {
                    view_application_rent_data: view_application_rent,
                    rental_id_data: rental_id
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if(data.success == "true"){
                        $("#v_room_id").html(data.room_id);
                        $("#v_room_name").html(data.room_name);
                        $("#v_rent_rate").html(data.rent_rate);
                        $("#v_description").html(data.description);

                        $("#v_user_id").html(data.user_id);
                        $("#v_name").html(data.name);
                        $("#v_birth").html(data.birth);
                        $("#v_gender").html(data.gender);
                        $("#v_no").html(data.no);
                        $("#v_email").html(data.email);

                        // $('#SubmitDelete').attr('data-id', room_id);
                        $('#modalView').modal('show');
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

        $(document).on('click', '#btnApprove', function(){
            var view_application_rent = 'selected';
            var rental_id = $(this).attr('data-id');
            table_row = $(this).parents('tr');

            $.ajax({
                url: 'functions/select_function.php',
                method: 'POST',
                data: {
                    view_application_rent_data: view_application_rent,
                    rental_id_data: rental_id
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if(data.success == "true"){
                        $("#a_room_id").html(data.room_id);
                        $("#a_room_name").html(data.room_name);
                        $("#a_rent_rate").html(data.rent_rate);
                        $("#a_description").html(data.description);

                        $("#a_user_id").html(data.user_id);
                        $("#a_name").html(data.name);
                        $("#a_birth").html(data.birth);
                        $("#a_gender").html(data.gender);
                        $("#a_no").html(data.no);
                        $("#a_email").html(data.email);

                        $('#SubmitApprove').attr('data-id', data.rental_id);
                        $('#modalApprove').modal('show');
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

        $(document).on('click', '#btnReject', function(){
            var view_application_rent = 'selected';
            var rental_id = $(this).attr('data-id');
            table_row = $(this).parents('tr');

            $.ajax({
                url: 'functions/select_function.php',
                method: 'POST',
                data: {
                    view_application_rent_data: view_application_rent,
                    rental_id_data: rental_id
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if(data.success == "true"){
                        $("#r_room_id").html(data.room_id);
                        $("#r_room_name").html(data.room_name);
                        $("#r_rent_rate").html(data.rent_rate);
                        $("#r_description").html(data.description);

                        $("#r_user_id").html(data.user_id);
                        $("#r_name").html(data.name);
                        $("#r_birth").html(data.birth);
                        $("#r_gender").html(data.gender);
                        $("#r_no").html(data.no);
                        $("#r_email").html(data.email);

                        $('#SubmitReject').attr('data-id', data.rental_id);
                        $('#modalReject').modal('show');
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

        $(document).on('click', '#SubmitApprove', function(){
            var approve_application_rent = 'selected';
            var rental_id = $(this).attr('data-id');

            $.ajax({
                url: 'functions/update_function.php',
                method: 'POST',
                data: {
                    approve_application_rent_data: approve_application_rent,
                    rental_id_data: rental_id
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if(data.success == "true"){
                        table.row( table_row ).remove().draw();
                        alert(data.message);
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

        $(document).on('click', '#SubmitReject', function(){
            var reject_application_rent = 'selected';
            var rental_id = $(this).attr('data-id');

            $.ajax({
                url: 'functions/update_function.php',
                method: 'POST',
                data: {
                    reject_application_rent_data: reject_application_rent,
                    rental_id_data: rental_id
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if(data.success == "true"){
                        table.row( table_row ).remove().draw();
                        alert(data.message);
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
    });
    </script>
</body>

</html>
