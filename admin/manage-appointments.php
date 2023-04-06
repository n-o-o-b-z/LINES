<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0 || $_SESSION['role'] == 'Hospital') {
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

if(isset($_GET['mark-done']))
{
    $id = $_GET['mark-done'];
    $donated_volume = $_GET['donated_volume'];
    $status = 1;
    $sql = "UPDATE appointments SET status = :status, donated_volume = :donated WHERE id=:id";

    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query-> bindParam(':donated', $donated_volume, PDO::PARAM_STR);
    $query -> execute();
  
    if($query->rowCount() > 0)
    {
        $msg="Data Updated!";
        $page = $_SERVER['PHP_SELF'];
        header("Refresh:0, url=$page");

      
        // $sql2 = "SELECT * FROM appointments WHERE id=:id";
        // $query2 = $dbh->prepare($sql2);
        // $query-> bindParam(':id', $id, PDO::PARAM_STR);
        // $query2->execute();
        // $results=$query->fetchAll(PDO::FETCH_OBJ);
        // $results->requester_id;
        // $results->accepter_id;
     

        // $insert_sql="INSERT INTO donation_history(`user_id`,blood_type_id,donation_date,`status`,`created_at`) VALUES(:userid, :bloodtype, :donationDate, :stats, :created_at)";
        // $insert_query = $dbh->prepare($insert_sql);
        // $insert_query->bindParam(':userid',$userid,PDO::PARAM_STR);
        // $insert_query->bindParam(':bloodtype',$bloodtype,PDO::PARAM_STR);
        // $insert_query->bindParam(':donationDate',$date_true,PDO::PARAM_STR);
        // $insert_query->bindParam(':stats',$stats,PDO::PARAM_STR);
        // $insert_query->bindParam(':created_at',$created_at,PDO::PARAM_STR);
        // $insert_query->execute();

    }
}

if(isset($_POST['mark-cancelled']))
{
    $id = $_POST['mark-cancelled'];
    $status = 2;
    $sql = "UPDATE appointments SET status = :status WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query -> execute();
    $msg="Data Deleted successfully";
    // header("Refresh:0");
}

if(isset($_POST['mark-pending']))
{
    $id = $_POST['mark-pending'];
    $status = 0;
    $sql = "UPDATE appointments SET status = :status WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query -> execute();
    $msg="Data Deleted successfully";
    // header("Refresh:0");
}

    function selectDonor(){
        include('includes/config.php');

        $sql = "SELECT * from  tblblooddonars where status = 0 ";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
          if($query->rowCount() > 0){
            return $results;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('includes/new-header.php'); ?>
    <style>
        .disabled {
       
            cursor: no-drop;
            background-color: #e9ecef;
            opacity: 1;
        }
    </style>
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
            <h1 class="m-0">Appointment List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="index.php">Home</a></li> -->
                <li class="breadcrumb-item active">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-sm" >
                        Add Appointments
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
							<th>Requester</th>
							<th>Accepted By</th>
							<th>Date</th>
							<th>Location</th>
							<th>Donated Volume(mL)</th>
							<th>Status</th>
							<th>Action </th>
						
						</tr>
					</thead>
					<tbody id="test">
					
                    <?php $sql = "SELECT a.*,b.FullName as requester, c.FullName as accepter FROM appointments as a LEFT JOIN tblblooddonars as b ON a.requester_id = b.id LEFT JOIN tblblooddonars as c ON a.accepter_id = c.id";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $key => $result) { ?>
                                <tr>
                                    <td><?=++$key?></td>
                                    <td><?php echo htmlentities($result->requester); ?></td>
                                    <td><?php echo htmlentities($result->accepter); ?></td>
                                    <td><?php echo htmlentities(date_format(date_create($result->date),"M d Y | g:iA")); ?></td>
                                    <td><?php echo htmlentities($result->location); ?></td>
                                  

                                    <td>
                                        <?php if($result->donated_volume > 0):?>
                                                <span class=""><?=$result->donated_volume;?> mL</span>
                                            <?php else:?>
                                                <span class="badge badge-dark">Pending</span>
                                        <?php endif ?>
                                            
                                    </td>

                                    <td>
                                        <?php if($result->status == 0):?>
                                                <span class="badge badge-dark">Pending</span>
                                            <?php elseif($result->status == 1):?>
                                                <span class="badge badge-success">Done</span>
                                            <?php else:?>
                                                <span class="badge badge-danger">Cancelled</span>
                                        <?php endif ?>
                                            
                                    </td>

                                    <td>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <form action="#" method="post">
                                                    <?php if($result->status == 0):?>
                                                        <button type="submit" class="btn btn-default dropdown-item" name="mark-cancelled" value="<?=$result->id;?>" data-id="<?=$result->id;?>">
                                                                    Mark Cancelled
                                                        </button>
                                                        <!-- <button type="submit" class="btn btn-default dropdown-item" name="mark-done" value="<?=$result->id;?>" data-id="<?=$result->id;?>">
                                                                    Mark Done
                                                        </button> -->

                                                        <button type="button" class="btn btn-default dropdown-item" data-toggle="modal" data-target="#exampleModalCenter">
                                                            MARK DONE
                                                        </button>

                                                    
                                                    <?php elseif($result->status == 1):?>
                                                        <button type="submit" class="btn btn-default dropdown-item" name="mark-cancelled" value="<?=$result->id;?>" data-id="<?=$result->id;?>">
                                                                    Mark Cancelled
                                                        </button>
                                                        <button type="submit" class="btn btn-default dropdown-item" name="mark-pending" value="<?=$result->id;?>" data-id="<?=$result->id;?>">
                                                                    Mark Pending
                                                        </button>

                                                    <?php elseif($result->status == 2):?>
                                                        <button type="submit" class="btn btn-default dropdown-item" name="mark-done" value="<?=$result->id;?>" data-id="<?=$result->id;?>">
                                                                    Mark Done
                                                        </button>
                                                        <button type="submit" class="btn btn-default dropdown-item" name="mark-pending" value="<?=$result->id;?>" data-id="<?=$result->id;?>">
                                                                    Mark Pending
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
					<h4 class="modal-title">ADD APPOINTMENT</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="username">DONATOR</label>
                                <select class="form-control" name="btype" id="donator" required>
                                    <option> -- SELECT -- </option>
                                        <?php 
                                            $donors = selectDonor();
                                            foreach($donors as $donor): ?>
                                                <option value="<?php echo htmlentities($donor->id); ?>"><?php echo htmlentities($donor->FullName); ?></option>
                                        <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="username">REQUESTER</label>
                                <select class="form-control" name="requester" id="requesters" required>
                                    <option value='0'> -- SELECT -- </option>
                                        <?php 
                                            $donors = selectDonor();
                                            foreach($donors as $donor): ?>
                                                <option value="<?php echo htmlentities($donor->id); ?>"><?php echo htmlentities($donor->FullName); ?></option>
                                        <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputState">Date</label>
                                <input type="text" name="date" class="form-control datetimepicker-input" id="datetimepicker55" data-toggle="datetimepicker" data-target="#datetimepicker55"  autocomplete="off">   
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
                                                <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->BloodGroup); ?></option>
                                        <?php }} ?>
                                </select>
                            </div>
                        </div>
<!-- 
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="username">Barangay</label>
                                <input type="text" name="bgry" id="barangay" class="form-control" required>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="username">Message</label>
                            <textarea class="form-control" name="message" id="message" cols="30" rows="2"></textarea>
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


    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true" wfd-invisible="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">EDIT DONOR</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
                        <div class="form-group">
                            <label for="username">Full Name</label>
                            <input type="text" name="fname-edit" id="fname-edit" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="username">Email</label>
                                <input type="text" name="email-edit" id="email-edit" class="form-control" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="username">Mobile No.</label>
                                <input type="text" name="mobile-edit" id="mobile-edit" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="username">Birthday</label>
                                <!-- <input type="text" name="name" id="name" class="form-control"> -->
                                <input type="date" name="bday-edit" class="form-control" id="bDay-edit" required>
                            </div>

                            <div class="form-group col-lg-2">
                                <label for="username">Age</label>
                                <input type="text" name="age-edit" id="age-edit" class="form-control" readonly required>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="username">Gender</label>
                                <select class="form-control" name="gender-edit" id="gender-edit" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="username">Blood Type</label>
                                <select class="form-control" name="btype-edit" id="btype-edit" required>
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
                                <input type="text" name="purok-edit" id="purok-edit" class="form-control" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="username">Barangay</label>
                                <input type="text" name="bgry-edit" id="barangay-edit" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username">Message</label>
                            <textarea class="form-control" name="message-edit" id="message-edit" cols="30" rows="2"></textarea>
                        </div>
                        <input type="hidden" name="hiddenId" id="idshidden">
                    </form>
				</div>
				<div class="modal-footer justify-content-between" id="fteer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="EditDonors" data-id="">Save</button>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="modal-xnl" style="display: none;" aria-hidden="true" wfd-invisible="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">DONATION HISTORY <span id="user-name"></span></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
                    <table id="example1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Blood Group</th>
                                <th>Donation Date</th>
                                
                            </tr>
                        </thead>
                        <tbody id="idset">

                        </tbody>
                    </table>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal" style="visibility:hidden">Close</button>
					<button type="button" class="btn btn-primary" id="closer" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Volume Donated in mL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="GET">
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="text" name="donated_volume" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">mL</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        <button type="submit" class="btn btn-default dropdown-item" name="mark-done" value="79" data-id="79">
                            Mark Done
                        </button>
                    </div>
                </form>
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
                    console.log(ids);
                    $('#fname-edit').val(response[0].FullName);
                    $('#email-edit').val(response[0].EmailId);
                    $('#mobile-edit').val(response[0].MobileNumber);
                    $('#bDay-edit').val(response[0].BirthDay);
                    $('#age-edit').val(response[0].age);
                    $('#gender-edit').val(response[0].Gender);
                    $('#btype-edit').val(response[0].BloodGroup);
                    $('#purok-edit').val(response[0].Purok);
                    $('#barangay-edit').val(response[0].Barangay);
                    $('#message-edit').val(response[0].Message);
                    $('#idshidden').val(ids);

                },
                
            });
        });

        

    
        $('#fteer').on('click','#EditDonors', function () {

            var url = 'xhr/update-donors.php';
            var ids = $('#idshidden').val();
            var fname = $('#fname-edit').val();
            var email = $('#email-edit').val();
            var mobile = $('#mobile-edit').val();
            var bday = $('#bDay-edit').val();
            var age = $('#age-edit').val();
            var gender = $('#gender-edit').val();
            var btype = $('#btype-edit').val();
            var purok = $('#purok-edit').val();
            var brgy = $('#barangay-edit').val();
            var msg = $('#message-edit').val();


            $.ajax({
                type: "GET",
                url: url,
                data: {id: ids,fname:fname,email:email,mobile:mobile,bday:bday,age:age,gender:gender,btype:btype,purok:purok,brgy:brgy,msg:msg},
                dataType: "json",
                success: function (response) {
                    window.location.reload(true);
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

        $(document).on('click','#viewBtn', function () {
            var ids=$(this).data('id');
            var urls = 'xhr/view-donation.php';
            $.ajax({
                type: "POST",
                url: urls,
                data: {id:ids},
                dataType: "JSON",
                success: function (response) {
                $('#user-name').html('['+response[0].FullName+']');

                var html ='<tr>';
                    html +='<td>'+response[0].FullName+'</td>';
                    html +='<td>'+response[0].blood_type_id+'</td>';
                    html +='<td>'+response[0].donation_date+'</td>';
                    html +='</tr>';

                    $('#idset').append(html);
                }
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

        $('#bDay-edit').change(function (e) { 
            e.preventDefault();
            var now = new Date();
            var bday = new Date(this.value)
            var d1 = bday.getYear()+1900;
            var d2 = now.getYear()+1900;
            $('#age-edit').val(d2-d1);
        });

        $('#modal-xnl').on('hide.bs.modal', function (e) {
            $('#user-name').html('');
            $('#idset').html('');
        });

        $('#modal-lg').on('hide.bs.modal', function (e) {
            $('#user-name').html('');
            $('#idset').html('');
            $('#EditDonors').attr('data-id','');
        })  

        $('#datetimepicker55').datetimepicker({
            icons: {
                time: "fas fa-clock",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            minDate:new Date(),
        });

      $(document).ready(function () {
        $('#donator').change(function (e) { 
            e.preventDefault();
            $('#requesters').val(0);
           var val = $(this).val();

            // var conceptName = $('#requesters').children("option:selected").val($(this).val());
            // $('$requesters option[value="40"]').addClass('tanga');
            var components = $("#requesters").children('option').attr("disabled", false).removeClass('disabled');
            var components = $("#requesters").children('[value="'+ val +'"]').attr("disabled", true).addClass('disabled');
        });
        
        $('#requesters').change(function (e) { 
            e.preventDefault();

            // var conceptName = $(this).children("option:selected").val($('#donator').val());
            //     conceptName.addClass('disabled');

            console.log($(this).val());

            if($('#donator').val() == $(this).val()){
                console.log('match');
            }else{
                console.log('not match!');
              
            }
        });
      });

  </script>

</html>