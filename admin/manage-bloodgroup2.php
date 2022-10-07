<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
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
            <h1 class="m-0">Manage Blood Groups</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Blood Groups</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Blood Groups</th>
                <!-- <th>Creation Date</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="test">
        
            <?php $sql = "SELECT * from  tblbloodgroup ";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
            foreach($results as $key => $result)
            {				?>	
            <tr>
          
            <td><?=++$key?></td>
            <td><?php echo htmlentities($result->BloodGroup);?></td>
            <!-- <td><?php echo htmlentities($result->PostingDate);?></td> -->
            <td>
              <a href="manage-bloodgroup.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-trash text-secondary"></i></a>
              <button type="button" class="btn btn-default" id="editBtn" data-toggle="modal" data-target="#modal-lg" data-id="<?=$result->id ?>">
                  edit
              </button>
            </td>
            
          </tr>
            <?php $cnt=$cnt+1; }} ?>
        
        </tbody>
       
    </table>
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Blood Group</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/action_page.php" class="was-validated">
                    <div class="form-group">
                        <label for="uname">Blood Type:</label>
                        <input type="text" class="form-control" id="names" placeholder="Enter username" name="uname" required />
                        <input type="hidden" name="id" id="bgId">
						<div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSubmit">Save changes</button>
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
		$('#example').on('click','#editBtn', function () {
     		var ids = ($(this).data('id'));
      		var url = 'xhr/edit-bloodgroups.php';
			$.ajax({
				type: "GET",
				url: url,
				data: {id: ids},
				dataType: "JSON",
				success: function (response) {
					$('#names').val(response[0].BloodGroup);
					$('#bgId').val(response[0].id);
				},
				
			});
			
    	});


		$('#btnSubmit').click(function (e) { 
			e.preventDefault();
			var ids = $('#bgId').val();
			var bg = $('#names').val();
      		var url = 'xhr/update-bloodgroups.php';
			$.ajax({
				type: "GET",
				url: url,
				data: {id: ids, BloodGroup:bg},
				dataType: "dataType",
				success: function (response) {
					// $('#names').val(response[0].BloodGroup);
				},
				
			});
		});
   });
  </script>
  <script>
    $(document).ready( function () {
      $('#example').DataTable();
    } );
  </script>

</html>