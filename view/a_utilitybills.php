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
                    <h1 class="page-header">Utility Bills</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button title="Add New Utility Bill" data-toggle="tooltip" class="btn btn-info" id="btnAdd"><span class="glyphicon glyphicon-plus"></span> Add</button>
                            <!-- <label> &emsp; By being part of the house, we imply that you agree to the house rules stated below. In case of disagreement or request, you may file a complaint or request and wait for the admin's respond. </label> -->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="tblutility">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th width="60%">Description</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $all_bill_types = bill_types_list();
                                    $all_bill_types = json_decode($all_bill_types);

                                    foreach ($all_bill_types as $value) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $value -> {'utility_bill_type_id'}; ?></td>
                                            <td><?php echo $value -> {'utility_bill_type'}; ?></td>
                                            <td><?php echo $value -> {'description'}; ?></td>
                                            <td>
                                                <button data-toggle="tooltip" data-id="<?php echo $value -> {'utility_bill_type_id'}; ?>" title="Edit" class="btn btn-success btn_edit" id="btnEdit"><span class="fa fa-edit"></span></button> 
                                                <button data-toggle="tooltip" data-id="<?php echo $value -> {'utility_bill_type_id'}; ?>" title="Delete" class="btn btn-danger" id="btnDelete" ><span class="glyphicon glyphicon-trash"></span></button>
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

    
<!-- This is the Modal that will be called for add btn -->
    <div id = "modalAdd" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Add New Utility Bill </h4>
                </div>
                <div class="modal-body">
                    <form>
                        <table>
                            <div class="form-group">
                                <label> Type: </label>
                                <input class="form-control" id="a_type" required>
                            </div>
                            <div class="form-group">
                                <label> Description: </label>
                                <textarea class="form-control" id="a_description" placeholder="Describe new utility bill here ..." required></textarea>
                            </div>
                        </table>
                    </form>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-primary" id="SubmitAdd"> ADD UTILITY BILL </button>
                    <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                </div>
            </div>
        </div>
    </div>

   
<!-- This is the Modal that will be called for edit btn -->
    <div id = "modalEdit" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                  <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                        <h4 class ="modal-title"> Edit Utility Bill </h4>
                      </div>
                      <div class="modal-body">
                            <form>
                                <table>
                                    <div class="form-group">
                                        <label> ID: </label>
                                        <label class="form-control" id="e_id">
                                    </div>
                                    <div class="form-group">
                                        <label> Type: </label>
                                        <input class="form-control" id="e_type" required>
                                    </div>
                                    <div class="form-group">
                                        <label> Description: </label>
                                        <textarea class="form-control" id="e_description" placeholder="Describe utility bill here ..." required></textarea>
                                    </div>
                                </table>
                            </form>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class="btn btn-success" id="SubmitUpdate"> SAVE CHANGES </button>
                        <button type ="button" class = "btn btn-default" data-dismiss = "modal"> CLOSE </button>
                      </div>
                    </div>
              </div>
            </div>


   
<!-- This is the Modal that will be called for add btn -->
    <div id = "modalDelete" class = "modal fade"  role = "dialog">
        <div class = "modal-dialog">
            <div class="modal-content">
                <div class = "modal-header">
                    <button type="button" class = "close" data-dismiss ="modal"> &times;</button>
                    <h4 class ="modal-title"> Delete Utility Bill </h4>
                </div>
                <div class="modal-body">
                    <form>
                        <table>
                            <div class="form-group">
                                <label> ID: </label>
                                <label class="form-control" id="d_id">
                            </div>
                            <div class="form-group">
                                <label> Type: </label>
                                <label class="form-control" id="d_type"></label>
                            </div>
                            <div class="form-group">
                                <label> Description: </label>
                                <textarea class="form-control" id="d_description" disabled="true"></textarea>
                            </div>
                        </table>
                    </form>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-danger" data-dismiss = "modal" id="SubmitDelete"> DELETE UTILITY BILL </button>
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

        $('#tblutility').DataTable({
            responsive: true
        });

        var table = $('#tblutility').DataTable();

        $(document).on('click', '#btnAdd', function(){
            $('#modalAdd').modal('show');
        });

        $(document).on('click', '#SubmitAdd', function(){
            var add_utility_bills = 'selected';
            var type  = $('#a_type').val();
            var description = $('#a_description').val();

            $.ajax({
                url: 'functions/insert_function.php',
                method: 'POST',
                data: {
                    add_utility_bills_data: add_utility_bills,
                    type_data: type,
                    description_data: description
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if(data.success == "true"){
                        table.row.add( [
                            data.utility_bill_type_id,
                            data.type,
                            data.description,
                            data.buttons
                        ] ).draw( false );
                        $('#modalAdd').modal('toggle');
                        $("#formAdd").trigger('reset');
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

        $(document).on('click', '#btnEdit', function(){
            var view_utility_bills = 'selected';
            var utility_bill_type_id  = $(this).attr('data-id');
            table_row = $(this).parents('tr');

            $.ajax({
                url: 'functions/select_function.php',
                method: 'POST',
                data: {
                    view_utility_bills_data: view_utility_bills,
                    utility_bill_type_id_data: utility_bill_type_id
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if(data.success == "true"){
                        $('#e_id').html(data.id);
                        $('#e_type').val(data.type);
                        $('#e_description').val(data.description);
                        $('#SubmitUpdate').attr('data-id', data.id);
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
            var update_utility_bills = 'selected';
            var utility_bill_type_id  = $(this).attr('data-id');
            var type  = $('#e_type').val();
            var description = $('#e_description').val();

            $.ajax({
                url: 'functions/update_function.php',
                method: 'POST',
                data: {
                    update_utility_bills_data: update_utility_bills,
                    utility_bill_type_id_data: utility_bill_type_id,
                    type_data: type,
                    description_data: description
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if(data.success == "true"){
                        var rData = [ data.id, data.type, data.description, data.buttons];
                            table.row( table_row ).data(rData).draw();
                        $('#modalEdit').modal('toggle');
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
            var view_utility_bills = 'selected';
            var utility_bill_type_id  = $(this).attr('data-id');
            table_row = $(this).parents('tr');

            $.ajax({
                url: 'functions/select_function.php',
                method: 'POST',
                data: {
                    view_utility_bills_data: view_utility_bills,
                    utility_bill_type_id_data: utility_bill_type_id
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    if(data.success == "true"){
                        $('#d_id').html(data.id);
                        $('#d_type').html(data.type);
                        $('#d_description').val(data.description);
                        $('#SubmitDelete').attr('data-id', data.id);
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
            var delete_utility_bills = 'selected';
            var id  = $(this).attr('data-id');

            $.ajax({
                url: 'functions/delete_function.php',
                method: 'POST',
                data: {
                    delete_utility_bills_data: delete_utility_bills,
                    id_data: id,
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
