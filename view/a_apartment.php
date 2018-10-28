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
                    <h1 class="page-header">Apartment</h1>
                </div>
            </div>
            

<!-- room table start -->
<div class="row">
                <div class="col-lg-12">
                   <!--  <h1 class="page-header">Complaints</h1> -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button title="Add New Room" class="btn btn-info" id="btnAdd"><span class="glyphicon glyphicon-plus"></span> Add</button>
                            <!-- <button data-toggle="tooltip" title="Add Complaint" class="btn btn-info" id="btnAdd"><span class="glyphicon glyphicon-plus"></span> Add</button> -->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="tblroom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Apartment Name</th>
                                        <th>Apartment Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $all_apartment = all_apartment();
                                    $all_apartment = json_decode($all_apartment);

                                    foreach ($all_apartment as $value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value -> {'apartment_id'}; ?></td>
                                        <td><?php echo $value -> {'apartment_name'}; ?></td>
                                        <td><?php echo $value -> {'apartment_desc'}; ?></td>
                                        <td><?php echo $value -> {'status'}; ?></td>
                                        <td class="center">
                                            <center>
                                                <?php
                                                    if($value -> {'status'} == 'Accepted'){
                                                ?>
                                                <button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnViewDetails" data-id="<?php echo $value -> {'apartment_id'}; ?>"><span class="fa fa-file-text-o"></span></button>
                                                <button data-toggle="tooltip" title="Edit Details" class="btn btn-success" id="btnEdit" data-id="<?php echo $value -> {'apartment_id'}; ?>"><span class="fa fa-edit"></span></button>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                <button data-toggle="tooltip" title="View Full Details" class="btn btn-info" id="btnViewDetails" data-id="<?php echo $value -> {'apartment_id'}; ?>"><span class="fa fa-file-text-o"></span></button>
                                                <button data-toggle="tooltip" title="Delete" class="btn btn-danger" id="btnDelete" data-id="<?php echo $value -> {'apartment_id'}; ?>"><span class="glyphicon glyphicon-remove"></span></button>
                                                <?php
                                                    }
                                                ?>        
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

<!-- room table end -->




        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<!-- This is the Modal that will be called for vacant room btn -->
    <div id = "modalView" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Apartment </h4>
                </div>
                <div class="modal-body">
                    <center><br><h4>Apartment Information</h4></center>
                    <form>
                        <!-- <div class="form-group">
                            <label> Picture: </label>
                            <label id="v_room_picture" class="form-control"></label>
                        </div> -->
                        <div class="form-group">
                            <label> ID: </label>
                            <label id="v_id" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Apartment Name: </label>
                            <label id="v_apartment" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Description </label>
                            <label id="v_apartment_desc" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Address </label>
                            <label id="v_address" class="form-control"></label>
                        </div>
                        <div class="form-group">
                            <label> Status </label>
                            <label id="v_status" class="form-control"></label>
                        </div>
                    </form>
                </div>
                <div class = "modal-footer">
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

 <!-- modalEditRoomDetails -->
      <div class = "modal fade" id = "modalEdit" role = "dialog">
        <div class = "modal-dialog">

          <div class="modal-content">
            <div class = "modal-header">
              <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Edit Room Details </h4>
                  </div>
                  <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>ID:</label>
                            <label class="form-control" id="e_id"></label>
                        </div>
                        <div class="form-group">
                            <label>Apartment Name</label>
                            <input class="form-control" id="e_name" placeholder="Room Name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input class="form-control" id="e_description">
                        </div>
                        <div class="form-group">
                            <label>Address:</label>
                            <label class="form-control" id="e_address">
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <label class="form-control" id="e_status"></label>
                        </div>
                    </form>
                  </div>
                  <div class = "modal-footer">
                    <button type ="button" class= "btn btn-success" id="SubmitUpdate">UPDATE </button>
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CANCEL </button>
                  </div>
                </div>
          </div>
        </div>

    <!-- This is the Modal that will be called for add btn -->
    <div id = "modalAdd" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Add New Apartment </h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label> Apartment Name: </label>
                            <input class="form-control" id="a_apartment" placeholder="Apartment name" required />
                        </div>
                        <div class="form-group">
                            <label> Apartment Description: </label>
                            <input class="form-control" id="a_description" placeholder="Apartment description" required />
                        </div>
                        <div class="form-group">
                            <label> Address: </label>
                            <input class="form-control" id="a_address" placeholder="Address" required />
                        </div>
                        <div class="form-group">
                            <label> Room Picture: </label>
                            <input type="file" class="form-control" />
                        </div>
                    </form>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-primary" id="SubmitAdd" data-dismiss = "modal"> ADD ROOM </button>
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                </div>
            </div>
        </div>
    </div>

    <!-- This is the Modal that will be called for delete btn -->
    <div id = "modalDelete" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Confirmation </h4>
                </div>
                <div class="modal-body">
                    By clicking yes, the application of this apartment will be cancelled.
                    <form>
                        <div class="form-group">
                            <label> ID: </label>
                            <label class="form-control" id="v_d_apartment_id"></label>
                        </div>
                        <div class="form-group">
                            <label> Apartment: </label>
                            <label class="form-control" id="v_d_apartment_name"></label>
                        </div>
                    </form>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-primary" id="SubmitDelete" data-dismiss = "modal"> YES </button>
                    <button type ="button" class = "btn btn-danger" data-dismiss = "modal"> NO </button>
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

            $('#tblroom').DataTable({
                responsive: true
            });

            var table = $('#tblroom').DataTable();
            
            $(document).on('click', '#btnAdd', function(){
                $('#modalAdd').modal('show');
            });

            $(document).on('click', '#SubmitAdd', function(){
                var add_apartment = 'selected';
                var apartment_name = $('#a_apartment').val();
                var description = $('#a_description').val();
                var address = $('#a_address').val();

                $.ajax({
                    url: 'functions/insert_function.php',
                    method: 'POST',
                    data: {
                        add_apartment_data: add_apartment,
                        apartment_name_data: apartment_name,
                        description_data: description,
                        address_data: address
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            
                            table.row.add( [
                                data.id,
                                data.name,
                                data.description,
                                'Pending',
                                data.buttons
                            ] ).draw( false );
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

            $(document).on('click', '#btnDelete', function(){
                var view_cancel_apartment = 'selected';
                var apartment_id = $(this).attr('data-id');
                table_row = $(this).parents('tr');

                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_cancel_apartment_data: view_cancel_apartment,
                        apartment_id_data: apartment_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $("#v_d_apartment_id").html(data.apartment_id);
                            $("#v_d_apartment_name").html(data.apartment_name);

                            $('#SubmitDelete').attr('data-id', data.apartment_id);
                            $('#modalDelete').modal('show');
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

            $(document).on('click', '#SubmitDelete', function(){
                var apartment_id = $(this).attr('data-id');
                var submit_cancel_apartment = 'selected';

                $.ajax({
                    url: 'functions/update_function.php',
                    method: 'POST',
                    data: {
                        submit_cancel_apartment_data: submit_cancel_apartment,
                        apartment_id_data: apartment_id
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

            $(document).on('click', '#btnViewDetails', function(){
                var apartment_id = $(this).attr('data-id');
                var view_apartment_details_check = 'selected';
                table_row = $(this).parents('tr');
                
                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_apartment_details_check_data: view_apartment_details_check,
                        apartment_id_data: apartment_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $("#v_id").html(data.apartment_id);
                            $("#v_apartment").html(data.apartment_name);
                            $("#v_apartment_desc").html(data.apartment_desc);
                            $("#v_address").html(data.apartment_address);
                            $("#v_status").html(data.status);
                            
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

            $(document).on('click', '#btnEdit', function(){
                var apartment_id = $(this).attr('data-id');
                var view_apartment_details_check = 'selected';
                table_row = $(this).parents('tr');

                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_apartment_details_check_data: view_apartment_details_check,
                        apartment_id_data: apartment_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $("#e_id").html(data.apartment_id);
                            $("#e_name").html(data.apartment_name);
                            $("#e_description").html(data.apartment_desc);
                            $("#e_address").html(data.apartment_address);
                            $("#e_status").html(data.status);
                            
                            $('#modalEdit').modal('show');
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

            $(document).on('click', '#SubmitUpdate', function(){
                var room_id = $(this).attr('data-id');
                var update_room_details = 'selected';
                var room_name =  $("#e_room_name").val();
                var rent_rate = $("#e_rent_rate").val();
                var room_description = $("#e_room_description").val();

                $.ajax({
                    url: 'functions/update_function.php',
                    method: 'POST',
                    data: {
                        update_room_details_data: update_room_details,
                        room_id_data: room_id,
                        room_name_data: room_name,
                        rent_rate_data: rent_rate,
                        room_description_data: room_description
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            var rData = [ data.room_id, data.room_name, data.rent_rate, data.room_description, data.status, data.buttons];
                            table.row( table_row ).data(rData).draw();
 
                            alert(data.message);
                            $('#modalEdit').modal('toggle');
                        }
                        else if (data.success == "false"){
                            if(data.error == "minor"){
                                alert(data.message);
                            }
                            else{
                                alert(data.message);
                                $('#modalEdit').modal('toggle');
                            }
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.status + ":" + xhr.statusText);
                    }
                });
            });

            $(document).on('click', '#btnTerminate', function(){
                var view_terminate_details = 'selected';
                var rental_id = $(this).attr('data-id');

                $.ajax({
                    url: 'functions/select_function.php',
                    method: 'POST',
                    data: {
                        view_terminate_details_data: view_terminate_details,
                        rental_id_data: rental_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            $('#c_room_name').html(data.room_name);
                            $('#c_name').html(data.name);
                            $('#SubmitTerminate').attr('data-id', data.rental_id);
                            $('#modalTerminate').modal('show');
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

            $(document).on('click', '#SubmitTerminate', function(){
                var rental_terminate_table = 'selected';
                var rental_id = $(this).attr('data-id');

                $.ajax({
                    url: 'functions/delete_function.php',
                    method: 'POST',
                    data: {
                        rental_terminate_table_data: rental_terminate_table,
                        rental_id_data: rental_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            var rData = [ data.room_id, data.room_name, data.rent_rate, data.room_description, data.status, data.buttons];
                            table.row( table_row ).data(rData).draw();
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

            $(document).on('click', '#AddTenantSubmit', function(){
                var add_tenant_table = 'selected';
                var room_id = $(this).attr('data-id');
                var first_name = $('#a_first_name').val();
                var middle_name = $('#a_middle_name').val();
                var last_name = $('#a_last_name').val();
                var birth_date = $('#a_birth_date').val();
                var gender = $('#a_gender').val();
                var contactno = $('#a_contactno').val();
                var email = $('#a_email').val();

                $.ajax({
                    url: 'functions/insert_function.php',
                    method: 'POST',
                    data: {
                        add_tenant_table_data: add_tenant_table,
                        room_id_data: room_id,
                        first_name_data: first_name,
                        middle_name_data:  middle_name,
                        last_name_data: last_name,
                        birth_date_data: birth_date,
                        gender_data: gender,
                        contactno_data: contactno,
                        email_data: email
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        if(data.success == "true"){
                            var rData = [ data.room_id, data.room_name, data.rent_rate, data.room_description, data.status, data.buttons];
                            table.row( table_row ).data(rData).draw();
                            $('#modalVacantRoom').modal('toggle');
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

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>
