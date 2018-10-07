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
                    <h1 class="page-header">Tenants</h1>
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="table-contents">
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
                                        $all_tenants = all_tenants();
                                        $all_tenants = json_decode($all_tenants);

                                        foreach ($all_tenants as $value) {
                                        ?>
                                        <tr class="odd gradeX" id = "<?php echo $value -> {'user_id'}; ?>">
                                            <td><?php echo $value -> {'user_id'}; ?></td>
                                            <td><?php echo $value -> {'name'}; ?></td>
                                            <td><?php echo $value -> {'email'}; ?></td>
                                            <td class="center"><?php echo $value -> {'contact_no'}; ?></td>
                                            <td class="center"><?php echo $value -> {'room_name'}; ?></td>
                                            <td class="center">
                                                <button data-toggle="tooltip" data-id = "<?php echo $value -> {'user_id'}; ?>" title="View Full Details" class="btn btn-info btn_details" id = "btnDetails"><span class="fa fa-file-text-o"></span></button>
                                                <button data-toggle="tooltip" data-id = "<?php echo $value -> {'user_id'}; ?>" title="Edit" class="btn btn-success btn_edit" id="btnEdit"><span class="fa fa-edit"></span></button>
                                                <button data-toggle="tooltip" data-id = "<?php echo $value -> {'user_id'}; ?>" title="Deactivate" class="btn btn-danger" id="btnDelete"><span class="glyphicon glyphicon-trash"></span></button>
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

    <!-- This is the Modal that will be called for add column -->
      <!-- <div class = "modal fade" id = "modalAdd" role = "dialog">
        <div class = "modal-dialog">

          <div class="modal-content">
            <div class = "modal-header">
              <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Add New Tenant </h4>
                  </div>
                  <div class="modal-body">
                    <form>

                      <div class = "form-group">
                        <table>
                            <tr>
                                <td> Tenant Name: </td>
                                <td><input type="text" placeholder="Enter Tenant Name" required></td>
                            </tr>
                        </table>
                      </div><br>

                    </form>
                  </div>
                  <div class = "modal-footer">
                    <button type ="button" class= "btn btn-success" data-dismiss="modal" id="SubmitAdd">ADD </button>
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                  </div>
                </div>
          </div>
        </div>

 -->

 <!-- This is the Modal that will be called for view column -->
    <div id = "modalDetails" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Tenant's Information </h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#o_profile" data-toggle="tab" aria-expanded="true">Tenant</a>
                            </li>
                            <li><a href="#o_room" data-toggle="tab" aria-expanded="false">Room</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="o_profile">
                                <center><br><h4>Tenant</h4></center>
                                <form>
                                    <!-- <div class="form-group">
                                        <label>Profile Picture: </label>
                                        <label id="o_profile_picture" class="form-control"></label>
                                    </div> -->
                                    <div class="form-group">
                                        <label> ID: </label>
                                        <label id="v_user_id" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Name: </label>
                                        <label id="v_name" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Birthdate: </label>
                                        <label id="v_birthdate" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Gender: </label>
                                        <label id="v_gender" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Contact No: </label>
                                        <label id="v_contactno" class="form-control"></label>
                                    </div>
                                    <div class="form-group">
                                        <label> Email: </label>
                                        <label id="v_email" class="form-control"></label>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="o_room">
                                <center><br><h4>Room Information</h4></center>
                                <form>
                                    <!-- <div class="form-group">
                                        <label> Picture: </label>
                                        <label id="o_room_picture" class="form-control"></label>
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
                        </div>
                    </div>
                </div>
                <div class = "modal-footer">
                    <!-- <button type="button" class = "btn btn-success" data-dismiss = "modal" id="SubmitEdit">SAVE CHANGES</button> -->
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                </div>
            </div>
        </div>
    </div>


    <!-- This is the Modal that will be called for edit column -->
    <div id = "modalEdit" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Edit Tenant's Information </h4>
                </div>
                <div class="modal-body">
                     <form>
                        <!-- <div class="form-group">
                            <label>Profile Picture: </label>
                            <label id="view_profilepic" class="form-control"></label>
                        </div> -->
                        <div class="form-group">
                            <label> ID: </label>
                            <label id="view_id" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Name: </label>
                            <label id="view_name" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Room name: </label>
                            <label id="view_roomname" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Birthdate: </label>
                            <label id="view_birthdate" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Gender: </label>
                            <label id="view_gender" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Contact No: </label>
                            <label id="view_contactno" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Email: </label>
                            <label id="view_email" class="form-control"></label>
                        </div>
                    </form>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-success" data-dismiss = "modal" id="SubmitEdit">SAVE CHANGES</button>
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CANCEL </button>
                </div>
            </div>
        </div>
    </div>

<!-- This is the Modal that will be called for edit column -->
   <!--  <div id = "modalEdit" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Edit Tenant's Information </h4>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>Profile Picture: </td>
                            <td id = view_profilepic><input type="file" name=""></td>
                        </tr>
                        <tr>
                            <td> ID: </td>
                            <td id = "view_id"><input type="" name="" disabled="true"></td>
                        </tr>
                        <tr>
                            <td> Name: </td>
                            <td id = "view_name"><input type="text" name=""></td>
                        </tr>
                        <tr>
                            <td> Room name: </td>
                            <td id = "view_roomname"><input type="text" name=""></td>
                        </tr>
                        <tr>
                            <td> Birthdate: </td>
                            <td id = "view_birthdate"><input type="date" name=""></td>
                        </tr>
                        <tr>
                            <td> Gender: </td>
                            <td id = "view_gender"></td>
                        </tr>
                        <tr>
                            <td> Contact No: </td>
                            <td id = "view_contactno"><input type="text" name=""></td>
                        </tr>
                        <tr>
                            <td> Email: </td>
                            <td id = "view_email"><input type="text" name=""></td>
                        </tr>
                    </table>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-success" data-dismiss = "modal" id="SubmitEdit">SAVE CHANGES</button>
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CANCEL </button>
                </div>
            </div>
        </div>
    </div>
 -->

        <!-- This is the Modal that will be called for delete column -->
    <div id = "modalDelete" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Deactivate Tenant </h4>
                </div>
                <div class="modal-body">
                    
                    <form>
                        <!-- <div class="form-group">
                            <label>Profile Picture: </label>
                            <label id="delete_profilepic" class="form-control"></label>
                        </div> -->
                        <div class="form-group">
                            <label> ID: </label>
                            <label id="delete_id" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Name: </label>
                            <label id="delete_name" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Room name: </label>
                            <label id="delete_roomname" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Birthdate: </label>
                            <label id="delete_birthdate" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Gender: </label>
                            <label id="delete_gender" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Contact No: </label>
                            <label id="delete_contactno" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Email: </label>
                            <label id="delete_email" class="form-control"></label>
                        </div>
                    </form>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-danger" data-dismiss = "modal" id="SubmitDelete">DEACTIVATE </button>
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CANCEL </button>
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

    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#table-contents').DataTable({
                responsive: true
            });

            var table = $('#table-contents').DataTable();
            var table_row;
            
            $('[data-toggle="tooltip"]').tooltip();

            $(document).on('click', '#btnDetails', function(){
                var tenant_id = $(this).attr('data-id');
                var view_tenant_selected = 'selected';

                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_tenant_selected_data: view_tenant_selected,
                        tenant_id_data: tenant_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $('#v_user_id').html(data.user_id);
                            $('#v_name').html(data.name);
                            $('#v_birthdate').html(data.birth_date);
                            $('#v_gender').html(data.gender);
                            $('#v_contactno').html(data.contact_no);
                            $('#v_email').html(data.email);

                            $('#v_room_id').html(data.room_id);
                            $('#v_room_name').html(data.room_name);
                            $('#v_rent_rate').html(data.rent_rate);
                            $('#v_room_description').html(data.room_description);

                            $('#modalDetails').modal('show');
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

            $(document).on('click', '#btnEdit', function(){
                $('#modalEdit').modal('show');
                var tenant_selected = 'selected';
                var tenant_id = $(this).attr('data-id');
                $("#SubmitEdit").attr('data-id', tenant_id);
                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        tenant_selected_data: tenant_selected,
                        tenant_id_data: tenant_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#view_profilepic").html(data.profilepic);
                        $("#view_id").html(data.user_id);
                        $("#view_name").html(data.name);
                        $("#view_roomname").html(data.room_name);
                        $("#view_birthdate").html(data.birth_date);     
                        $("#view_gender").html(data.gender);
                        $("#view_contactno").html(data.contact_no);                                
                        $("#view_email").html(data.email);
                    },
                    error: function(xhr) {
                        console.log(xhr.status + ":" + xhr.statusText);
                    }
                });
            });

            $(document).on('click', '#SubmitEdit', function(){
                var tenant_id = $(this).attr('data-id');
                var tenant_selected = 'selected';
                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        tenant_selected_data: tenant_selected,
                        tenant_id_data: tenant_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#delete_profilepic").html(data.profilepic);
                        $("#delete_id").html(data.user_id);
                        $("#delete_name").html(data.name);
                        $("#delete_roomname").html(data.room_name);
                        $("#delete_birthdate").html(data.birth_date);     
                        $("#delete_gender").html(data.gender);
                        $("#delete_contactno").html(data.contact_no);                                
                        $("#delete_email").html(data.email);
                        $("#SubmitDelete").attr('data-id', data.user_id);
                    },
                    error: function(xhr) {
                        console.log(xhr.status + ":" + xhr.statusText);
                    }
                });
            });

            $(document).on('click', '#btnDelete', function(){
                $('#modalDelete').modal('show');
                var tenant_selected = 'selected';
                var tenant_id = $(this).attr('data-id');
                $.ajax({
                    url: 'functions/select_delete_function.php',
                    method: 'POST',
                    data: {
                        tenant_selected_data: tenant_selected,
                        tenant_id_data: tenant_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        $("#delete_profilepic").html(data.profilepic);
                        $("#delete_id").html(data.user_id);
                        $("#delete_name").html(data.name);
                        $("#delete_roomname").html(data.room_name);
                        $("#delete_birthdate").html(data.birth_date);     
                        $("#delete_gender").html(data.gender);
                        $("#delete_contactno").html(data.contact_no);                                
                        $("#delete_email").html(data.email);
                        $("#SubmitDelete").attr('data-id', data.user_id);
                    },
                    error: function(xhr) {
                        console.log(xhr.status + ":" + xhr.statusText);
                    }
                });
            });
            $(document).on('click', '#SubmitDelete', function(){
                var tenant_id = $(this).attr('data-id');
                var tenant_selected = 'selected';
                $.ajax({
                    url: 'functions/delete_function.php',
                    method: 'POST',
                    data: {
                        tenant_delete_data: tenant_selected,
                        tenant_id_data: tenant_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success = "true"){
                            alert(data.message);
                            table.row('#'+tenant_id).remove().draw();
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
