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
                    <h1 class="page-header">Termination Requests</h1>
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
                                        <th>Room</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $request_termination = request_termination_list();
                                    $request_termination = json_decode($request_termination);

                                    foreach ($request_termination as $value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value -> {'request_terminate_id'}; ?></td>
                                        <td><?php echo $value -> {'date_requested'}; ?></td>
                                        <td><?php echo $value -> {'name'}; ?></td>
                                        <td><?php echo $value -> {'room'}; ?></td>
                                        <td class="center">
                                            <center>
                                                <button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnDetails" data-id="<?php echo $value -> {'request_terminate_id'}; ?>"><span class="fa fa-file-text-o"></span></button>
                                                <button data-toggle="tooltip" title="Approve Request" class="btn btn-primary" id="btnApprove" data-id="<?php echo $value -> {'request_terminate_id'}; ?>"><span class="fa fa-check"></span></button>
                                                <button data-toggle="tooltip" title="Reject Request" class="btn btn-danger" id="btnReject" data-id="<?php echo $value -> {'request_terminate_id'}; ?>"><span class="fa fa-times"></span></button>
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
                           <p> &emsp; Are you sure you want to <label style="color:blue;">APPROVE</label> the request of <label id="a_name">NAME_OF_TENANT</label> to terminate <label id="a_gender"></label> rental?</p>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-primary" data-dismiss = "modal" id="SubmitApprove">YES </button>
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
                           <p> &emsp; Are you sure you want to <label style="color:red;">REJECT</label> the request of <label id="t_name"></label> to terminate <label id="t_gender"></label> rental?</p>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-primary" data-dismiss = "modal" id="SubmitReject">YES </button>
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
                                <label id="v_requester_id" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Requester Name: </label>
                                <label id="v_name" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Current Room: </label>
                                <label id="v_room" class="form-control"></label>
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

            var table = $('#contents').DataTable();
            $('[data-toggle="tooltip"]').tooltip();

            $(document).on('click', '#btnApprove', function(){
                var termination_id = $(this).attr('data-id');
                var view_termination_details = 'selected';
                //table_row = $(this).parents('tr');
                
                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_termination_details_data: view_termination_details,
                        termination_id_data: termination_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $('#a_name').html(data.name);
                            $('#a_gender').html(data.gender);

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
                var termination_id = $(this).attr('data-id');
                var approve_termination = 'selected';
                //table_row = $(this).parents('tr');
                
                $.ajax({
                    url: 'functions/update_function.php',
                    method: 'POST',
                    data: {
                        approve_termination_data: approve_termination,
                        termination_id_data: termination_id
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

            $(document).on('click', '#btnReject', function(){
                var termination_id = $(this).attr('data-id');
                var view_termination_details = 'selected';
                table_row = $(this).parents('tr');
                
                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_termination_details_data: view_termination_details,
                        termination_id_data: termination_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $('#t_name').html(data.name);
                            $('#t_gender').html(data.gender);

                            $('#SubmitReject').attr('data-id', data.id);
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

            $(document).on('click', '#SubmitReject', function(){
                var termination_id = $(this).attr('data-id');
                var reject_termination = 'selected';
                //table_row = $(this).parents('tr');
                
                $.ajax({
                    url: 'functions/update_function.php',
                    method: 'POST',
                    data: {
                        reject_termination_data: reject_termination,
                        termination_id_data: termination_id
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

            $(document).on('click', '#btnDetails', function(){
                var termination_id = $(this).attr('data-id');
                var view_termination_details = 'selected';
                //table_row = $(this).parents('tr');
                
                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_termination_details_data: view_termination_details,
                        termination_id_data: termination_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $('#v_id').html(data.id);
                            $('#v_date').html(data.date);
                            $('#v_requester_id').html(data.user_id);
                            $('#v_name').html(data.name);
                            $('#v_room').html(data.room);
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
