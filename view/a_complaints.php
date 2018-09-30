<?php
    if(!isset($_SESSION['user_id'])){
        header("location:index");
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Complainant</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>1</td>
                                        <td>Neighbor</td>
                                        <td>Jan 23 2019</td>
                                        <td>Dessuh Albuh</td>
                                        <td>Noisy neighbor room 03</td>
                                        <td class="center">
                                            <center>
                                                <button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnDetails"><span class="fa fa-file-text-o"></span></button>
                                                <button data-toggle="tooltip" title="Completed" class="btn btn-primary" id="btnCompleted"><span class="fa fa-check"></span></button>
                                            </center>
                                        </td>
                                    </tr>
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

        $(document).on('click', '#btnCompleted', function(){
            $('#modalCompleted').modal('show');
        });

        $(document).on('click', '#btnDetails', function(){
            $('#modalDetails').modal('show');
        });

    });
    </script>

    
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
                            <div class="form-group">
                                <label> Description: </label>
                                <label id="" class="form-control"></label>
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


</body>

</html>
