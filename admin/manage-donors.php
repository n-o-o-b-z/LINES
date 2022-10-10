<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
}
if(isset($_GET['del']))
{
	$id=$_GET['del'];
	$sql = "delete from tblblooddonars  WHERE id=:id";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':id',$id, PDO::PARAM_STR);
	$query -> execute();
	$msg="Data Deleted successfully";   
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
            <h1 class="m-0">Donors List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="index.php">Home</a></li> -->
              <li class="breadcrumb-item active">
                <!-- <span>Manage Blood Groups</span> -->
                <!-- <button type="button" class="btn btn-primary" id="addBtn" data-toggle="modal" data-target="#modal-lg2">ADD BLOOD GROUP</button> -->
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-sm">
					ADD DONORS
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
							<th>Contact No.</th>
							<th>Email</th>
							<th>Gender</th>
							<th>Age</th>
							<th>BLOOD TYPE</th>
							<th>LOCATION</th>
                            <th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="test">
					
                    <?php $sql = "SELECT * FROM tblblooddonars ";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $key => $result) { ?>
                                <tr>
                                    <td><?=++$key?></td>
                                    <td><?php echo htmlentities($result->FullName); ?></td>
                                    <td><?php echo htmlentities($result->MobileNumber); ?></td>
                                    <td><?php echo htmlentities($result->EmailId); ?></td>
                                    <td><?php echo htmlentities($result->Gender); ?></td>
                                    <td><?php echo htmlentities($result->age); ?></td>
                                    <td><?php echo htmlentities($result->BloodGroup); ?></td>
                                    <td><?php echo htmlentities($result->Purok).' '.$result->Barangay;?></td>
                                  
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
                                                <button type="button" class="btn btn-primary dropdown-item" id="viewBtn" data-id="<?php echo $result->id;?>" data-toggle="modal" data-target="#modal-lg">DONATIONS</button>
                                                <div class="dropdown-divider"></div>
                                                    <?php if($result->status == 0):?>
                                                        <button type="button" class="btn btn-default dropdown-item" data-id="'.$result->id.'">
                                                                    BAN
                                                        </button>
                                                        <button type="button" class="btn btn-default dropdown-item" data-id="'.$result->id.'">
                                                                    MARK INACTIVE
                                                        </button>
                                                        <?php elseif($result->status == 1):?>
                                                            <button type="button" class="btn btn-default dropdown-item" data-id="'.$result->id.'">
                                                                    MARK ACTIVE
                                                            </button>
                                                        <?php else:?>
                                                            <button type="button" class="btn btn-default dropdown-item" data-id="'.$result->id.'">
                                                                    UNBAN
                                                            </button>
                                                    <?php endif ?>
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
					<h4 class="modal-title">ADD DONORS</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
                        <div class="form-group">
                            <label for="username">Full Name</label>
                            <input type="text" name="fname" id="fname" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="username">Email</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="username">Mobile No.</label>
                                <input type="text" name="mobile" id="mobile" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="username">Birthday</label>
                                <!-- <input type="text" name="name" id="name" class="form-control"> -->
                                <input type="date" name="bday" class="form-control" id="bDay" required>
                            </div>

                            <div class="form-group col-lg-2">
                                <label for="username">Age</label>
                                <input type="text" name="age" id="age" class="form-control" readonly required>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="username">Gender</label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="username">Blood Type</label>
                                <select class="form-control" name="btype" id="btype" required>
                                    <?php 
                                        $sql = "SELECT * from  tblbloodgroup ";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {?>
                                                <option value="<?php echo htmlentities($result->BloodGroup); ?>"><?php echo htmlentities($result->BloodGroup); ?></option>
                                        <?php }} ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="username">Purok</label>
                                <input type="text" name="purok" id="purok" class="form-control" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="username">Barangay</label>
                                <input type="text" name="bgry" id="barangay" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username">Message</label>
                            <textarea class="form-control" name="message" id="message" cols="30" rows="2"></textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="username">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="username">Confirm Password</label>
                                <input type="password" name="cpassword" id="confirm-password" class="form-control">
                            </div>
                        </div>
                    </form>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="AddDonors">Save</button>
				</div>
			</div>
		</div>
	</div>


  	<div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Announcement</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
                    <form action="#">
						<div class="form-group">
							<label for="bGroup">Title</label>
							<input type="text" class="form-control" id="announcement-title-edit" name="title" required />
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <!-- input type="text" class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5"/> -->
                                    <label for="inputState">Date</label>
                                    <input type="text" class="form-control datetimepicker-input" id="datetimepicker15" data-toggle="datetimepicker" data-target="#datetimepicker15"  autocomplete="off">   

                                    <!-- <input type="text" class="form-control datetimepicker-input dtp-edit" id="datetimepicker52" data-toggle="datetimepicker" data-target="#datetimepicker5">    -->
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputState">Location</label>
                                    <input type="text" class="form-control" id="inputLoc-edit" name="location">
                                </div>
                            </div>
                            <label for="bGroup">Organizer</label>
                            <input type="text" class="form-control" id="organizer-edit" name="organizer" required />
                            <input type="hidden" name="id" id="bgId">
                        </div>

                        <div class="form-group">
                            <label for="bGroup">Details</label>
                            <textarea class="form-control" name="details" id="details-edit"></textarea>
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
		$('#AddDonors').click(function (e) { 
            e.preventDefault();
            var fname = $('#fname').val();
            var email  = $('#email').val();
            var mobile = $('#mobile').val();
            var bday = $('#bDay').val();
            var age = $('#age').val();
            var gender = $('#gender').val();
            var bloodtype  = $('#btype').val();
            var purok = $('#purok').val();
            var barangay = $('#barangay').val();
            var message = $('#message').val();
            var password = $('#password').val();
            var confirm = $('#confirm-password').val();
            var url = 'xhr/add-donors.php';

            if(password !== confirm){
                alert('Password doesnt match');
            }else{
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        fname:fname,
                        email:email,
                        mobile:mobile,
                        bday:bday,
                        age:age,
                        gender:gender,
                        bloodtype:bloodtype,
                        purok:purok,
                        barangay:barangay,
                        message:message,
                        password:password,
                        confirm:confirm
                    },
                    dataType: "JSON",
                    success: function (response) {
                        window.location.reload(true);
                    }
                });
            }
        });


		// $('#editBtn').click(function (e) { 
        $('#example').on('click','#editBtn', function () {
            var ids = $(this).data('id')
            // var bg = $('#names').val();
            var url = 'xhr/edit-donors.php';
            $.ajax({
                type: "GET",
                url: url,
                data: {id: ids},
                dataType: "json",
                success: function (response) {
                    $('#bgId').val(response[0].id);
                    $('#announcement-title-edit').val(response[0].title);
                    $('#datetimepicker15').val(response[0].date);
                    $('#inputLoc-edit').val(response[0].location);
                    $('#organizer-edit').val(response[0].organizer);
                    $('#details-edit').val(response[0].details);

                },
                
            });
        });

		$('#btnSubmit').click(function (e) { 
			e.preventDefault();
      		var url = 'xhr/update-announcement.php';
            var id = $('#bgId').val();
            var title = $('#announcement-title-edit').val();
            var date =    $('#datetimepicker15').val();
            var location =   $('#inputLoc-edit').val();
            var organizer =   $('#organizer-edit').val();
            var details =   $('#details-edit').val();
			$.ajax({
				type: "GET",
				url: url,
				data: {id:id,title:title,date:date,location:location,organizer:organizer,details:details},
				dataType: "html",
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

        $('#bDay').change(function (e) { 
            e.preventDefault();
            var now = new Date();
            var bday = new Date(this.value)
            var d1 = bday.getYear()+1900;
            var d2 = now.getYear()+1900;
            $('#age').val(d2-d1);
        });

  </script>

</html>