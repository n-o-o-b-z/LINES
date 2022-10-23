<?php
session_start();
// error_reporting(0);
require_once('../assets/tcpdf/tcpdf.php');  
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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                                <form  method="POST">
                                        <label for="">Select Generate</label>
                                        <!-- <select class="form-control form-control-md" id="generate" name="generate">
                                            <option>SELECT..</option>
                                            <option value="1">DONORS LIST</option>
                                            <option value="3">BLOOD GROUP</option>
                                        </select> -->
                                        <select class="js-example-basic-multiple" multiple="multiple">
                                            <option value="AL">Alabama</option>
                                                ...
                                            <option value="WY">Wyoming</option>
                                        </select>
                                        <label for="">Date</label>
                                        <input type="text" class="form-control" name="daterange" id="date"/>
                                    </div>

                                    <div class="form-group col-lg-4 offset-md-4">
                                        <!-- <input type="submit" value="submit" class="form-control btn btn-info" id="btnSub"> -->
                                        <input type="submit" value="submit" class="form-control btn btn-info" id="btnSub" name="submit">


                                    </div>
                                </form>
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

        // $("#btnSub").click(function (e) { 
        //     e.preventDefault();
        //     var sel = $('#generate').val();
        //     var date = $('#date').val();
        //     $.ajax({
        //         type: "POST",
        //         url: 'xhr/print-report.php',
        //         data: {select:sel,date:date},
        //         dataType: "dataType",
        //         success: function (response) {
                    
        //         }
        //     });
        // });
    </script>

<?php
	if($_POST['submit']){
     
	function generateRow(){
		$contents = '';
		include_once('includes/config.php');
		

		if($_POST['select'] == 1){
            $sql1="SELECT * FROM tblblooddonars";
            $query1 = $dbh->prepare($sql1);
            $query1->execute();
            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
            
    
            foreach($results1 as $result1){
                $contents .= "
                    <tr>
                        <td>".$result1->id."</td>
                        <td>".$result1->FullName."</td>
                        <td>".$result1->status."</td>
                        <td>".$result1->status."</td>
                    </tr>
                    ";
            }
     
            return $contents;
        }elseif($_POST['select'] == 2){
            $sql1="SELECT * FROM tblbloodgroup";
            $query1 = $dbh->prepare($sql1);
            $query1->execute();
            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
            
    
            foreach($results1 as $result1){
                $content1 .= "
                    <tr>
                        <td>".$result1->BloodGroup."</td>
                    </tr>
                    ";
            }
            
            return $content1;
        }
	}
 

    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("Generated PDF using TCPDF");  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    if($_POST['select'] == 1){
        $content = '';  
        $content .= '
              <h2 align="center">Generated PDF using TCPDF</h2>
              <h4>Members Table</h4>
              <table border="1" cellspacing="0" cellpadding="3">  
               <tr>  
                    <th width="5%">ID</th>
                    <th width="20%">Firstname</th>
                    <th width="20%">Lastname</th>
                    <th width="55%">Address</th> 
               </tr>  
          ';  
        $content .= generateRow();  
        $content .= '</table>';  
        $pdf->writeHTML($content);  
        $pdf->Output('members.pdf', 'I');
    }elseif($_POST['select'] == 2){
        $content1 = '';  
        $content1 .= '
              <h2 align="center">Generated PDF using TCPDF</h2>
              <h4>Members Table</h4>
              <table border="1" cellspacing="0" cellpadding="3">  
               <tr>  
                    <th width="5%">ID</th>
                    <th width="20%">Firstname</th>
                    <th width="20%">Lastname</th>
                    <th width="55%">Address</th> 
               </tr>  
          ';  
        $content1 .= generateRow();  
        $content1 .= '</table>';  
        $pdf->writeHTML($content1);  
        $pdf->Output('members.pdf', 'I');
    }
 
 

        
        
    }
 
 
?>
<!-- <script src="../admin/js/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(".js-example-basic-multiple").select2();
</script>
</html>