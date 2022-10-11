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
	$sql = "delete from announcement  WHERE id=:id";
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
            <h1 class="m-0">Manage Announcement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="index.php">Home</a></li> -->
              <li class="breadcrumb-item active">
                <!-- <span>Manage Blood Groups</span> -->
                <!-- <button type="button" class="btn btn-primary" id="addBtn" data-toggle="modal" data-target="#modal-lg2">ADD BLOOD GROUP</button> -->
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-sm">
					ADD ANNOUNCEMENT
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
							<th>Title</th>
							<th>Date</th>
							<th>Location</th>
							<th>Organizer</th>
							<th>Details</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="test">
					
                    <?php $sql = "SELECT * from  announcement ";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $key => $result) { ?>
                                <tr>
                                    <td><?=++$key?></td>
                                    <td><?php echo htmlentities($result->title); ?></td>
                                    <td><?php echo htmlentities($result->date); ?></td>
                                    <td><?php echo htmlentities($result->location); ?></td>
                                    <td><?php echo htmlentities($result->organizer); ?></td>
                                    <td><?php echo htmlentities($result->details); ?></td>
                                    <td><?=$result->is_hidden == 0 ? '<span class="badge badge-success">Success</span>':'<span class="badge badge-danger">hidden</span>'?></td>


                                    <td>
						                <a href="manage-announcement.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-trash text-secondary"></i></a>
                                        <button type="button" class="btn btn-primary" id="editBtn" data-id="<?php echo $result->id;?>" data-toggle="modal" data-target="#modal-lg">edit</button>
                                        <!-- <button type="button" class="btn btn-primary" id="editBtn" data-id="<?php echo $result->id;?>" data-toggle="modal" data-target="#modal-lg">s</button> -->
                                    
                                        <?php
                                            if($result->is_hidden == 0){
                                                echo '<button type="button" class="btn btn-default" data-id="'.$result->id.'">
                                                        make hidden
                                                </button>';
                                            }else {
                                                echo '<button type="button" class="btn btn-default" data-id="'.$result->id.'">
                                                        make hidden
                                                </button>';
                                            }
                                        ?>
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
					<h4 class="modal-title">ADD ANNOUNCEMENT</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#">
						<div class="form-group">
							<label for="bGroup">Title</label>
							<input type="text" class="form-control" id="announcement-title" name="title" required />

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputState">Date</label>
                                    <input type="text" class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" autocomplete="off">   
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputState">Location</label>
                                    <input type="text" class="form-control" id="inputLoc" name="location">
                                </div>
                            </div>

                            <label for="bGroup">Organizer</label>
							<input type="text" class="form-control" id="organizer" name="organizer" required />
						</div>

                        <div class="form-group">
                            <label for="bGroup">Details</label>
                            <textarea class="form-control" name="details" id="details"></textarea>
                        </div>
					</form>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="AddAnnouncement">Save</button>
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
		$('#AddAnnouncement').click(function (e) { 
            e.preventDefault();
            var title = $('#announcement-title').val();
            var date  = $('#datetimepicker5').val();
            var location = $('#inputLoc').val();
            var organizer = $('#organizer').val();
            var details = $('#details').val();

            var url = 'xhr/add-announcement.php';
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    title:title,
                    date:date,
                    location:location,
                    organizer:organizer,
                    details:details
                },
                dataType: "JSON",
                success: function (response) {
                    window.location.reload(true);
                }
            });
            
        });


		// $('#editBtn').click(function (e) { 
        $('#example').on('click','#editBtn', function () {
            var ids = $(this).data('id')
            // var bg = $('#names').val();
            var url = 'xhr/edit-announcement.php';
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

    

  </script>

</html>