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
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Manage Reports</h1>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="colonizer col-lg-12 ">
                            <div class="form-group col-lg-4 offset-md-4">
                                <label for="">Select Generate</label>
                                <select class="form-control form-control-md">
                                    <option>Small select</option>
                                </select>

                                <label for="">Date</label>
                                <input type="text" class="form-control" name="daterange"/>
                            </div>

                            <div class="form-group col-lg-4 offset-md-4">
                                <input type="submit" value="submit" class="form-control btn btn-info">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
    <?php include('includes/footer.php'); ?>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>
</html>