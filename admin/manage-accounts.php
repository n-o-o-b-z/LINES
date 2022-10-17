<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0 || $_SESSION['role'] !== 'Admin') {
	header('location:index.php');
}
if(isset($_GET['del']))
{
	$id=$_GET['del'];
	$sql = "DELETE FROM admin  WHERE id=:id";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':id',$id, PDO::PARAM_STR);
	$query -> execute();
	$msg="Data Deleted successfully";
    header("Refresh:0");
}

if(isset($_POST['ban']))
{
    $id = $_POST['ban'];
    $status = 2;
    $sql = "UPDATE admin SET status = :status WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query -> execute();
    $msg="Data Deleted successfully";
    // header("Refresh:0");
}

if(isset($_POST['mark-unban']) || isset($_POST['mark-active']))
{
    $the_value = '';
    if(isset($_POST['mark-unban'])){
        $the_value = $_POST['mark-unban'];
    }
    if(isset($_POST['mark-active'])){
        $the_value = $_POST['mark-active'];
    }

    $id = $the_value;
    $status = 0;
    $sql = "UPDATE admin SET status = :status WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query -> execute();
    $msg="Data Deleted successfully";
    // header("Refresh:0");
}

if(isset($_POST['mark-inactive']))
{
    $id = $_POST['mark-inactive'];
    $status = 1;
    $sql = "UPDATE admin SET status = :status WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query -> execute();
    $msg="Data Deleted successfully";
    // header("Refresh:0");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('includes/new-header.php'); ?>
</head>
<body>
    <?php include('includes/nav.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Accounts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="index.php">Home</a></li> -->
              <li class="breadcrumb-item active">
                <!-- <span>Manage Blood Groups</span> -->
                <!-- <button type="button" class="btn btn-primary" id="addBtn" data-toggle="modal" data-target="#modal-lg2">ADD BLOOD GROUP</button> -->
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-sm">
					ADD ACCOUNT
				</button>  
			</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
			<div id="reloadable">
				<table id="example" class="display" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>ROLE</th>
							<th>STATUS</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="test">
					
                    <?php $sql = "SELECT admin.*, roles.name from  admin LEFT JOIN roles ON admin.role_id = roles.id ";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $key => $result) { ?>
                                <tr>
                                    <td><?=++$key?></td>
                                    <td><?php echo htmlentities($result->Full_name); ?></td>
                                    <td><?php echo htmlentities($result->Email); ?></td>
                                    <td><?php echo htmlentities($result->name); ?></td>
                                    <!-- <td><?php echo htmlentities($result->status); ?></td> -->
                                    <td>
                                        <?php if($result->status == 0):?>
                                                <span class="badge badge-success">Active</span>
                                            <?php elseif($result->status == 1):?>
                                                <span class="badge badge-dark">INACTIVE</span>
                                            <?php else:?>
                                                <span class="badge badge-danger">BANNED</span>
                                        <?php endif ?>
                                            
                                    </td>

                                    <td>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="manage-accounts.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');">DELETE</a>
                                                
                                                <button type="button" class="btn btn-primary dropdown-item" id="editBtn" data-id="<?php echo $result->id;?>" data-toggle="modal" data-target="#modal-lg">EDIT</button>
                                                
                                                <div class="dropdown-divider"></div>
                                                    <form action="" method="POST">
                                                        <?php if($result->status == 0):?>
                                                            <!-- <button type="button" class="btn btn-default dropdown-item" data-id="<?=$result->id; ?>" id="ban">
                                                                        BAN
                                                            </button> -->

                                                            <button type="submit" class="btn btn-default dropdown-item" data-id="<?=$result->id; ?>" name="ban" value="<?=$result->id; ?>">
                                                                        BAN
                                                            </button>

                                                            <button type="submit" class="btn btn-default dropdown-item" data-id="<?=$result->id; ?>" name="mark-inactive" value="<?=$result->id; ?>">
                                                                        MARK INACTIVE
                                                            </button>
                                                            <?php elseif($result->status == 1):?>
                                                                <button type="submit" class="btn btn-default dropdown-item" data-id="<?=$result->id; ?>" name="mark-active" value="<?=$result->id; ?>">
                                                                        MARK ACTIVE
                                                                </button>
                                                            <?php else:?>
                                                                <button type="submit" class="btn btn-default dropdown-item" data-id="<?=$result->id; ?>" name="mark-unban" value="<?=$result->id; ?>">
                                                                        UNBAN
                                                                </button>
                                                        <?php endif ?>
                                                    </form>
                                                </div>
                                        </div>

                                       
            
                                        
                                    </td>
                                </tr>
                        <?php $cnt = $cnt + 1;
                            }
                        } ?>
					</tbody>
				</table>
			</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="modal-sm" style="display: none;" aria-hidden="true" wfd-invisible="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">ADD ACCOUNT</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#">

                        <div class="form-group">
                            <label for="username">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="username">Password</label>
                            <input type="text" name="pass" id="pass" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="username">Role</label>
                            <select name="role" id="role" class="form-control">
                                <?php 
                                    $sql = "SELECT * FROM roles ";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $key => $result) { ?>
                                        <option value="<?=$result->id?>"><?php echo $result->name ?></option>
                                    <?php }} ?>
                            </select>
                        </div>

					</form>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="AddAccount">Save</button>
				</div>
			</div>
		</div>
	</div>


  	<div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Account</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="username">Full Name</label>
                            <input type="text" name="name" id="name-edit" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="text" name="email" id="email-edit" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="username">Role</label>
                            <select name="role" id="role-edit" class="form-control">
                                <?php 
                                    $sql = "SELECT * FROM roles ";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                
                                    foreach ( $results as $result ):
                                        // $selected = "";
                                        // if ( $result == $user_country )
                                        //     $selected = "selected";
                                    ?>
                                    <!-- <option value="<?php echo $country; ?>" 
                                            selected="<?php echo $selected; ?>">
                                            <?php echo $country; ?>
                                    </option> -->
                                    <option value="<?=$result->id?>"><?php echo $result->name ?></option>
                                    <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="catch" id="uId">
                        </div>
                      
					</form>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="btnSubmit">Save changes</button>
				</div>
			</div>
		</div>
	</div>



</body>
	<?php include('includes/footer.php'); ?>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
   
   $(document).ready(function () {


		$('#AddAccount').click(function (e) { 
            e.preventDefault();
            var fname = $('#name').val();
            var email  = $('#email').val();
            var password = $('#pass').val();
            var role = $('#role').val();

            var url = 'xhr/add-accounts.php';
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    fname:fname,
                    email:email,
                    password:password,
                    role:role
                },
                dataType: "JSON",
                success: function (response) {
                    window.location.reload(true);
                }
            });
            
        });


        $('#example').on('click','#editBtn', function () {
            var ids = $(this).data('id')
            // var bg = $('#names').val();
            var url = 'xhr/edit-accounts.php';
            $.ajax({
                type: "GET",
                url: url,
                data: {id: ids},
                dataType: "json",
                success: function (response) {
                    $('#uId').val(response[0].id);
                    $('#name-edit').val(response[0].Full_name);
                    $('#email-edit').val(response[0].Email);
                    $('#role-edit').val(response[0].role_id);
                },
                
            });
        });

		$('#btnSubmit').click(function (e) { 
			e.preventDefault();
      		var url = 'xhr/update-accounts.php';
            var id = $('#uId').val();
            var name_edit = $('#name-edit').val();
            var email_edit = $('#email-edit').val();
            var role_edit = $('#role-edit').val();
			$.ajax({
				type: "GET",
				url: url,
				data: {id:id,fname:name_edit,email:email_edit,role:role_edit},
				dataType: "json",
				success: function (response) {
                    window.location.reload(true);
				},
			});
		});    
        
   });
  </script>
  <script>
    $(document).ready( function () {
		$('#example').DataTable();

        $('#datetimepicker5').datetimepicker({
                icons: {
                    time: "fas fa-clock",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });

        $('#datetimepicker15').datetimepicker({
            icons: {
                time: "fas fa-clock",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });

            
    } );

    

  </script>

</html>