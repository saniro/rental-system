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
                    <h1 class="page-header">Terms and Conditions</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button title="Add New Policy" class="btn btn-info" id="btnAdd"><span class="glyphicon glyphicon-plus"></span> Add</button>
                            <!-- <label> &emsp; By being part of the house, we imply that you agree to the house rules stated below. In case of disagreement or request, you may file a complaint or request and wait for the admin's respond. </label> -->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="contents">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th width="80%">Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $all_rules = rules_list();
                                    $all_rules = json_decode($all_rules);

                                    foreach ($all_rules as $value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value -> {'rules_id'}; ?></td>
                                        <td><?php echo $value -> {'description'}; ?></td>
                                        <td>
                                            <button data-toggle="tooltip" data-id="<?php echo $value -> {'rules_id'}; ?>" title="Edit" class="btn btn-success btn_edit" id="btnEdit"><span class="fa fa-edit"></span></button> 
                                            <button data-toggle="tooltip" data-id="<?php echo $value -> {'rules_id'}; ?>" title="Delete" class="btn btn-danger" id="btnDelete"><span class="glyphicon glyphicon-trash"></span></button>
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
                    <h4 class ="modal-title"> Add New Policy </h4>
                </div>
                <div class="modal-body">
                    <form>
                        <table>
                            <div class="form-group">
                                <label> Description: </label>
                                <textarea class="form-control" id="a_description" placeholder="Describe new policy here ..." required></textarea>
                            </div>
                        </table>
                    </form>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-primary" id="SubmitAdd" data-dismiss = "modal"> ADD POLICY </button>
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
                        <h4 class ="modal-title"> Edit Policy </h4>
                      </div>
                      <div class="modal-body">
                        <form>
                            <table>
                                <div class="form-group">
                                    <label> ID: </label>
                                    <label class="form-control" id="e_rules_id"></label>
                                </div>
                                <div class="form-group">
                                    <label> Description: </label>
                                    <textarea class="form-control" id="e_description" placeholder="Describe new policy here ..." required></textarea>
                                </div>
                        </table>
                      </form>
                      </div>
                      <div class = "modal-footer">
                        <button type="button" class="btn btn-success" id="SubmitUpdate" data-dismiss="modal"> SAVE CHANGES </button>
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
                    <h4 class ="modal-title"> Delete Policy </h4>
                </div>
                <div class="modal-body">
                    <form>
                        <table>
                            <div class="form-group">
                                <label> ID: </label>
                                <label class="form-control">3</label>
                            </div>
                            <div class="form-group">
                                <label> Description: </label>
                                <textarea class="form-control" placeholder="Describe new policy here ..." disabled>Transferring of room is allowed only upon approval of change room request. Transferring of stuffs must be done the next day after approval.</textarea>
                            </div>
                        </table>
                    </form>
                </div>
                <div class = "modal-footer">
                    <button type="button" class = "btn btn-danger" data-dismiss = "modal"> DELETE POLICY </button>
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

        $(document).on('click', '#btnAdd', function(){
            $('#modalAdd').modal('show');
        });

        $(document).on('click', '#btnEdit', function(){
            var view_edit_tncs = 'selected';
            var tnc_id = $(this).attr('data-id');
            table_row = $(this).parents('tr');

            $.ajax({
                url: 'functions/select_function.php',
                method: 'POST',
                data: {
                    view_edit_tncs_data: view_edit_tncs,
                    tnc_id_data: tnc_id
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    var table = $("#contents").DataTable();
                    if(data.success == "true"){
                        $('#e_rules_id').html(data.tnc_id);
                        $('#e_description').val(data.description);
                        $('#SubmitUpdate').attr('data-id', data.tnc_id);
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
            var update_tncs = 'selected';
            var tnc_id = $(this).attr('data-id');
            var description = $('#e_description').val();

            $.ajax({
                url: 'functions/update_function.php',
                method: 'POST',
                data: {
                    update_tncs_data: update_tncs,
                    tnc_id_data: tnc_id,
                    description_data: description
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    var table = $("#contents").DataTable();
                    if(data.success == "true"){
                        var rData = [ data.rules_id, data.description, data.buttons];
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

        $(document).on('click', '#btnDelete', function(){
            $('#modalDelete').modal('show');
        });

        $(document).on('click', '#SubmitAdd', function(){
            var add_tncs = 'selected';
            var description = $('#a_description').val();
            $.ajax({
                url: 'functions/insert_function.php',
                method: 'POST',
                data: {
                    add_tncs_data: add_tncs,
                    description_data: description
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    var table = $("#contents").DataTable();
                    if(data.success == "true"){
                        table.row.add([
                            data.tnc_id,
                            data.description,
                            data.buttons
                        ]).draw(true);
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
