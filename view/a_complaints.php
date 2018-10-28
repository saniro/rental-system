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
                    <h1 class="page-header">Complaints</h1>
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
                                        <th>Complainant</th>
                                        <th>Apartment</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $all_complaints = all_complaints();
                                    $all_complaints = json_decode($all_complaints);

                                    foreach ($all_complaints as $value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value -> {'complaint_id'}; ?></td>
                                        <td><?php echo $value -> {'message_date'}; ?></td>
                                        <td><?php echo $value -> {'name'}; ?></td>
                                        <td><?php echo $value -> {'apartment'}; ?></td>
                                        <td><?php echo $value -> {'status'}; ?></td>
                                        <td class="center">
                                            <center>
                                                <button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnDetails" data-id="<?php echo $value -> {'complaint_id'}; ?>"><span class="fa fa-file-text-o"></span></button>
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
          <div id = "modalCompleted" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Mark as Completed </h4>
                      </div>
                      <div class="modal-body">
                       <form>
                            <div class="form-group">
                                <label> ID: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Subject: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Date: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Complainant: </label>
                                <label id="" class="form-control"></label>
                            </div>
                        </form>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-primary" data-dismiss = "modal">COMPLETED </button>
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
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
                        <h4 class ="modal-title"> Complaint Details </h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label> ID: </label>
                                <label id="v_complaint_id" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Message Date: </label>
                                <label id="v_message_date" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Complainant ID: </label>
                                <label id="v_user_id" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Complainant: </label>
                                <label id="v_name" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Message: </label>
                                <textarea id="v_message" class="form-control" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label> Response Date: </label>
                                <label id="v_response_date" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Response: </label>
                                <textarea id="v_response" class="form-control" disabled></textarea>
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

<!-- This is the Modal that will be called for view btn -->
    <div id = "modalSendResponse" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Complaint Details </h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label> ID: </label>
                                <label id="s_complaint_id" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Message Date: </label>
                                <label id="s_message_date" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Complainant ID: </label>
                                <label id="s_user_id" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Complainant: </label>
                                <label id="s_name" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Message: </label>
                                <textarea id="s_message" class="form-control" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label> Send Response: </label>
                                <textarea id="s_response" class="form-control"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class = "modal-footer">
                        <button type="button" class = "btn btn-primary" id="SubmitSendResponse" data-dismiss = "modal">SEND</button>
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

            $(document).on('click', '#btnCompleted', function(){
                $('#modalCompleted').modal('show');
            });

            $(document).on('click', '#btnDetails', function(){
                var complaint_id = $(this).attr('data-id');
                var view_and_reply_complaint = 'selected';
                table_row = $(this).parents('tr');

                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_and_reply_complaint_data: view_and_reply_complaint,
                        complaint_id_data: complaint_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            if(data.status == "Not yet read"){
                                $('#s_complaint_id').html(data.complaint_id);
                                $('#s_message_date').html(data.message_date);
                                $('#s_user_id').html(data.user_id);
                                $('#s_name').html(data.name);
                                $('#s_message').html(data.message);
                                $('#SubmitSendResponse').attr('data-id', data.complaint_id);
                                var table = $('#contents').DataTable();
                                var rData = [ data.complaint_id, data.message_date, data.name, 'Read', data.buttons];
                                table.row( table_row ).data(rData).draw();
                                $('#modalSendResponse').modal('show');
                            }
                            if(data.status == "Read"){
                                $('#s_complaint_id').html(data.complaint_id);
                                $('#s_message_date').html(data.message_date);
                                $('#s_user_id').html(data.user_id);
                                $('#s_name').html(data.name);
                                $('#s_message').html(data.message);
                                $('#SubmitSendResponse').attr('data-id', data.complaint_id);
                                $('#modalSendResponse').modal('show');
                            }
                            else if(data.status == "Responded"){
                                $('#v_complaint_id').html(data.complaint_id);
                                $('#v_message_date').html(data.message_date);
                                $('#v_user_id').html(data.user_id);
                                $('#v_name').html(data.name);
                                $('#v_message').html(data.message);
                                $('#v_response_date').html(data.response_date);
                                $('#v_response').html(data.response);
                                $('#modalDetails').modal('show');
                            }
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

            $(document).on('click', '#SubmitSendResponse', function(){
                var complaint_id = $(this).attr('data-id');
                var response = $('#s_response').val();
                var submit_reply_complaint = 'selected';

                $.ajax({
                    url: 'functions/insert_function.php',
                    method: 'POST',
                    data: {
                        submit_reply_complaint_data: submit_reply_complaint,
                        complaint_id_data: complaint_id,
                        response_data: response
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            var table = $('#contents').DataTable();
                            var rData = [ data.complaint_id, data.message_date, data.name, data.status, data.buttons];
                            table.row( table_row ).data(rData).draw();
                            alert(data.message);
                            // if(data.status == "Not yet read"){
                            //     $('#s_complaint_id').html(data.complaint_id);
                            //     $('#s_message_date').html(data.message_date);
                            //     $('#s_user_id').html(data.user_id);
                            //     $('#s_name').html(data.name);
                            //     $('#s_message').html(data.message);
                            //     $('#SubmitSendResponse').attr('data-id', data.complaint_id);
                            //     var table = $('#contents').DataTable();
                            //     var rData = [ data.complaint_id, data.message_date, data.name, 'Read', data.buttons];
                            //     table.row( table_row ).data(rData).draw();
                            //     $('#modalSendResponse').modal('show');
                            // }
                            // if(data.status == "Read"){
                            //     $('#s_complaint_id').html(data.complaint_id);
                            //     $('#s_message_date').html(data.message_date);
                            //     $('#s_user_id').html(data.user_id);
                            //     $('#s_name').html(data.name);
                            //     $('#s_message').html(data.message);
                            //     $('#SubmitSendResponse').attr('data-id', data.complaint_id);
                            //     $('#modalSendResponse').modal('show');
                            // }
                            // else if(data.status == "Responded"){
                            //     $('#v_complaint_id').html(data.complaint_id);
                            //     $('#v_message_date').html(data.message_date);
                            //     $('#v_user_id').html(data.user_id);
                            //     $('#v_name').html(data.name);
                            //     $('#v_message').html(data.message);
                            //     $('#v_response_date').html(data.response_date);
                            //     $('#v_response').html(data.response);
                            //     $('#modalDetails').modal('show');
                            // }
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
