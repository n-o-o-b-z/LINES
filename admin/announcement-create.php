<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
 <?php include('././includes/new-header.php'); ?>
<body>
<?php include('./includes/leftbar.php'); ?>\
<?php include('././includes/header.php'); ?>





<footer>
    <script src="./assets/adminlte/dist/css/adminlte.min.js"></script>
</footer>
</body>
</html>