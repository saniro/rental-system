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
                                        <th>Room No.</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td class="center">X</td>
                                        <td class="center">
                                            <button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnView"><span class="fa fa-file-text-o"></span></button>
                                            <button data-toggle="tooltip" title="Approve" class="btn btn-primary" id="btnApprove"><span class="fa fa-check"></span></button>
                                            <button data-toggle="tooltip" title="Reject" class="btn btn-danger" id="btnReject"><span class="fa fa-times"></span></button>
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

        $(document).on('click', '#btnView', function(){
            $('#modalView').modal('show');
        });

        $(document).on('click', '#btnApprove', function(){
            $('#modalApprove').modal('show');
        });

        $(document).on('click', '#btnReject', function(){
            $('#modalReject').modal('show');
        });
    });
    </script>

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
                            <li class=""><a href="#profile" data-toggle="tab" aria-expanded="true">Tenant</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="room">
                                <h4>Room Information</h4>
                                <table>
                                    <tr>
                                        <td> Picture: </td>
                                        <td><label id="o_room_picture"></label></td>
                                    </tr>
                                    <tr>
                                        <td> ID: </td>
                                        <td><label id="o_room_id"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Room Name: </td>
                                        <td><label id="o_room_name"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Rent Rate: </td>
                                        <td><label id="o_rent_rate"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Description: </td>
                                        <td><label id="o_room_description"></label></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <h4>Tenant</h4>
                                <table>
                                    <tr>
                                        <td>Profile Picture: </td>
                                        <td id="o_profile_picture"></td>
                                    </tr>
                                    <tr>
                                        <td> ID: </td>
                                        <td><label id="o_user_id"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Name: </td>
                                        <td><label id="o_name"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Birthdate: </td>
                                        <td><label id="o_birthdate"></label> </td>
                                    </tr>
                                    <tr>
                                        <td> Gender: </td>
                                        <td><label id="o_gender"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Contact No: </td>
                                        <td><label id="o_contactno"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Email: </td>
                                        <td><label id="o_email"></label></td>
                                    </tr>
                                </table>
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
                            <li class=""><a href="#profile" data-toggle="tab" aria-expanded="true">Tenant</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="room">
                                <h4>Room Information</h4>
                                <table>
                                    <tr>
                                        <td> Picture: </td>
                                        <td><label id="o_room_picture"></label></td>
                                    </tr>
                                    <tr>
                                        <td> ID: </td>
                                        <td><label id="o_room_id"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Room Name: </td>
                                        <td><label id="o_room_name"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Rent Rate: </td>
                                        <td><label id="o_rent_rate"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Description: </td>
                                        <td><label id="o_room_description"></label></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <h4>Tenant</h4>
                                <table>
                                    <tr>
                                        <td>Profile Picture: </td>
                                        <td id="o_profile_picture"></td>
                                    </tr>
                                    <tr>
                                        <td> ID: </td>
                                        <td><label id="o_user_id"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Name: </td>
                                        <td><label id="o_name"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Birthdate: </td>
                                        <td><label id="o_birthdate"></label> </td>
                                    </tr>
                                    <tr>
                                        <td> Gender: </td>
                                        <td><label id="o_gender"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Contact No: </td>
                                        <td><label id="o_contactno"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Email: </td>
                                        <td><label id="o_email"></label></td>
                                    </tr>
                                </table>
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
                            <li class=""><a href="#profile" data-toggle="tab" aria-expanded="true">Tenant</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="room">
                                <h4>Room Information</h4>
                                <table>
                                    <tr>
                                        <td> Picture: </td>
                                        <td><label id="o_room_picture"></label></td>
                                    </tr>
                                    <tr>
                                        <td> ID: </td>
                                        <td><label id="o_room_id"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Room Name: </td>
                                        <td><label id="o_room_name"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Rent Rate: </td>
                                        <td><label id="o_rent_rate"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Description: </td>
                                        <td><label id="o_room_description"></label></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <h4>Tenant</h4>
                                <table>
                                    <tr>
                                        <td>Profile Picture: </td>
                                        <td id="o_profile_picture"></td>
                                    </tr>
                                    <tr>
                                        <td> ID: </td>
                                        <td><label id="o_user_id"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Name: </td>
                                        <td><label id="o_name"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Birthdate: </td>
                                        <td><label id="o_birthdate"></label> </td>
                                    </tr>
                                    <tr>
                                        <td> Gender: </td>
                                        <td><label id="o_gender"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Contact No: </td>
                                        <td><label id="o_contactno"></label></td>
                                    </tr>
                                    <tr>
                                        <td> Email: </td>
                                        <td><label id="o_email"></label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                      <div class = "modal-footer">
                        <button type="button" class = "btn btn-danger" data-dismiss = "modal" id="SubmitDelete">REJECT </button>
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CANCEL </button>
                      </div>
                    </div>
              </div>
            </div>



</body>

</html>
