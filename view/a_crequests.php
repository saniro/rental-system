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


</head>

<body>

    <div id="wrapper">

        <?php
            require("a_navigation.php");
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Change Room Requests</h1>
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="contents">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Requester</th>
                                        <th>Current Room</th>
                                        <th>Room Requested</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $request_change_room = request_change_room_list();
                                    $request_change_room = json_decode($request_change_room);

                                    foreach ($request_change_room as $value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value -> {'request_id'}; ?></td>
                                        <td><?php echo $value -> {'date_requested'}; ?></td>
                                        <td><?php echo $value -> {'name'}; ?></td>
                                        <td><?php echo $value -> {'current_room'}; ?></td>
                                        <td><?php echo $value -> {'requested_room'}; ?></td>
                                        <td class="center">
                                            <center>
                                                <button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnDetails" data-id="<?php echo $value -> {'request_id'}; ?>"><span class="fa fa-file-text-o"></span></button>
                                                <button data-toggle="tooltip" title="Approve Request" class="btn btn-primary" id="btnApprove" data-id="<?php echo $value -> {'request_id'}; ?>"><span class="fa fa-check"></span></button>
                                                <button data-toggle="tooltip" title="Reject Request" class="btn btn-danger" id="btnReject" data-id="<?php echo $value -> {'request_id'}; ?>"><span class="fa fa-times"></span></button>
                                            </center>
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

    
<!-- This is the Modal that will be called for completed btn -->
          <div id = "modalApprove" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Approve Request</h4>
                      </div>
                      <div class="modal-body">
                           <p> &emsp; Are you sure you want to <label style="color:blue;">APPROVE</label> the request of <label id="a_name"></label> to transfer from room <label id="a_current_room"></label> to <label id="a_requested_room"></label>?</p>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-primary" data-dismiss = "modal" id="SubmitApprove"> YES </button>
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> NO </button>
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
                        <h4 class ="modal-title"> Reject Request </h4>
                      </div>
                      <div class="modal-body">
                           <p> &emsp; Are you sure you want to <label style="color:red;">REJECT</label> the request of <label>NAME_OF_TENANT</label> to transfer from room <label>CURRENT_ROOM_NAME</label> to <label>REQUESTED_ROOM_NAME</label>?</p>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-primary" data-dismiss = "modal">YES </button>
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> NO </button>
                      </div>
                    </div>
              </div>
            </div>

   
<!-- This is the Modal that will be called for view btn -->
    <div id = "modalDetails" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Request Details </h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label> ID: </label>
                                <label id="v_id" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Date: </label>
                                <label id="v_date" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Requester ID: </label>
                                <label id="v_requester" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Requester Name: </label>
                                <label id="v_name" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Current Room: </label>
                                <label id="v_current_room" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Room Requested: </label>
                                <label id="v_room_requested" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Status: </label>
                                <label id="v_status" class="form-control"></label>
                            </div>
                        </form>
                    </div>
                    <div class = "modal-footer">
                        <!-- <button type="button" class = "btn btn-primary" data-dismiss = "modal">COMPLETED </button> -->
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
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
            var table_row;
            $('#contents').DataTable({
                responsive: true
            });

            $('[data-toggle="tooltip"]').tooltip();

            $(document).on('click', '#btnApprove', function(){
                var request_id = $(this).attr('data-id');
                var view_request_pending_details = 'selected';
                //table_row = $(this).parents('tr');
                
                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_request_pending_details_data: view_request_pending_details,
                        request_id_data: request_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $('#a_name').html(data.name);
                            $('#a_current_room').html(data.current_room);
                            $('#a_requested_room').html(data.requested_room);

                            $('#SubmitApprove').attr('data-id', data.id);
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

            $(document).on('click', '#SubmitApprove', function(){
                var request_id = $(this).attr('data-id');
                var submit_approve_request = 'selected';
                //table_row = $(this).parents('tr');
                
                $.ajax({
                    url: 'functions/update_function.php',
                    method: 'POST',
                    data: {
                        submit_approve_request_data: submit_approve_request,
                        request_id_data: request_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
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
            
            $(document).on('click', '#btnReject', function(){
                $('#modalReject').modal('show');
            });

            $(document).on('click', '#btnDetails', function(){
                var request_id = $(this).attr('data-id');
                var view_request_pending_details = 'selected';
                //table_row = $(this).parents('tr');
                
                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_request_pending_details_data: view_request_pending_details,
                        request_id_data: request_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $('#v_id').html(data.id);
                            $('#v_date').html(data.date);
                            $('#v_requester').html(data.user_id);
                            $('#v_name').html(data.name);
                            $('#v_current_room').html(data.current_room);
                            $('#v_room_requested').html(data.requested_room);
                            $('#v_status').html('Pending');

                            //$('#AddTenantSubmit').attr('data-id', data.room_id);
                            $('#modalDetails').modal('show');
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
