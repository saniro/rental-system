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
                    <h1 class="page-header">Payments History</h1>
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
                                        <th>Contact No.</th>
                                        <th>Room Name</th>
                                        <th>Amount Paid</th>
                                        <th>Due Date</th>
                                        <th>Date of Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $all_payments = all_payments();
                                        $all_payments = json_decode($all_payments);
                                        foreach ($all_payments as $value) {
                                        ?>
                                        <tr class="odd gradeX" id = "<?php echo $value -> {'m_rent_id'}; ?>">
                                            <td><?php echo $value -> {'m_rent_id'}; ?></td>
                                            <td><?php echo $value -> {'user_name'}; ?></td>
                                            <td><?php echo $value -> {'contact_no'}; ?></td>
                                            <td class="center"><?php echo $value -> {'room_name'}; ?></td>
                                            <td></td>
                                            <td class="center"><?php echo $value -> {'due_date'}; ?></td>
                                            <td class="center"></td>
                                            <td class="center">
                                                <button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnDetails"><span class="fa fa-file-text-o"></span></button>
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

        $('[data-toggle="tooltip"]').tooltip();

        $(document).on('click', '#btnDetails', function(){
            $('#modalDetails').modal('show');
        });

    });
    </script>



<!-- This is the Modal that will be called for view btn -->
          <div id = "modalDetails" class = "modal fade"  role = "dialog">
            <div class = "modal-dialog">

              <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Payment Details </h4>
                      </div>
                      <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label> ID: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Name: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Contact No: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Room Name: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Amount Paid: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Due Date: </label>
                                <label id="" class="form-control"></label>
                            </div>
                            <div class="form-group">
                                <label> Date of Payment: </label>
                                <label id="" class="form-control"></label>
                            </div>
                      </form>
                      </div>
                      <div class = "modal-footer">
                        <!-- <button type="button" class = "btn btn-primary" data-dismiss = "modal">MARK AS READ </button> -->
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                      </div>
                    </div>
              </div>
            </div>




</body>

</html>
