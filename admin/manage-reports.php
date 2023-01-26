<?php

session_start();
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
}

    function getStatus($status){
        if($status == 0){
            return "Active";
        }elseif($status== 2){
            return "Banned";
        }elseif($status == 1){
            return "Inactive";
        }
    }


	function generateRow(){
		$contents = '';
		include_once('includes/config.php');

        // $arr = [1,2,3,55,51,52,54,31,32,34];
        $arr = $_POST['donors'];
        $placeholders = str_repeat('?,', count($arr) - 1) . '?';

        if($_POST['donors'][0] == 'all'){
            $sql1="SELECT * FROM tblblooddonars";
        }else {
		    $sql1="SELECT * FROM tblblooddonars WHERE id IN ($placeholders)";
        }

		$query1 = $dbh->prepare($sql1);
        // $query1->bindParam(':arr',$arr, PDO::PARAM_STR);
		$query1->execute($arr);
		$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
		

		foreach($results1 as $key => $result1){
			$contents .= "
				<tr>
					<td>".++$key."</td>
					<td>".$result1->FullName."</td>
					<td>".$result1->Purok.' '.$result1->Barangay."</td>
					<td>".$result1->BloodGroup."</td>
					<td>".getStatus($result1->status)."</td>

				</tr>
				";
		}
		return $contents;
	}


    // function generateBloodGroup(){
	// 	$contents = '';
	// 	include_once('includes/config.php');

       

    //     $pieces = explode(" - ", $_POST['daterange']);

    //     $date1=date_create($pieces[0].'00:00:00');
    //     $date_true1 =  date_format($date1,"Y-m-d H:i:s");

    //     $date2=date_create($pieces[1].'00:00:00');
    //     $date_true2 =  date_format($date2,"Y-m-d H:i:s");
    //     $from =  '2022-09-01 00:00:00';
    //     $to   =  '2022-10-31 00:00:00';


    //     if($_POST['blood'][0] == 'all'){
    //         $sql="SELECT * FROM tblblooddonars";
    //     }else {
    //         $arr1 = $_POST['blood'];
    //         $placeholders1 = str_repeat('?,', count($arr1) - 1) . '?';
	// 	    $sql="SELECT * FROM tblblooddonars WHERE PostingDate BETWEEN ? AND ? AND BloodGroup IN ($placeholders1)";
    //     }

	// 	$query = $dbh->prepare($sql);

	// 	if($_POST['blood'][0] !== 'all'){
    //         $query->execute($arr1);
    //     }
	// 	$results = $query->fetchAll(PDO::FETCH_OBJ);
		

	// 	foreach($results as $key => $result){
	// 		$contents .= "
	// 			<tr>
	// 				<td>".++$key."</td>
	// 				<td>".$result->FullName."</td>
	// 				<td>".$result->Purok.' '.$result->Barangay."</td>
	// 				<td>".$result->BloodGroup."</td>
	// 				<td>".getStatus($result->status)."</td>

	// 			</tr>
	// 			";
	// 	}
	// 	return $contents;
	// }

    // function generateBloodGroup(){
	// 	$contents = '';
	// 	include_once('includes/config.php');

        
    //     $pieces = explode(" - ", $_POST['daterange']);

    //     $date1=date_create($pieces[0].'00:00:00');
    //     $date_true1 =  date_format($date1,"Y-m-d H:i:s");

    //     $date2=date_create($pieces[1].'00:00:00');
    //     $date_true2 =  date_format($date2,"Y-m-d H:i:s");
    //     $from =  $date_true1;
    //     $to   =  $date_true2;


    //     $arr = $_POST['blood'];
    //     $placeholders = str_repeat('?,', count($arr) - 1) . '?';

    //     if($_POST['blood'][0] == 'all'){
    //         $sql1="SELECT * FROM tblblooddonars WHERE PostingDate BETWEEN :froms AND :tos";
    //     }else {
	// 	    // $sql1="SELECT * FROM tblblooddonars WHERE PostingDate BETWEEN :fromsa AND :tosa AND BloodGroup IN ($placeholders)";
	// 	    $sql1="SELECT * FROM tblblooddonars WHERE PostingDate BETWEEN :fromsa AND :tosa AND BloodGroup IN ($placeholders)";
    //     }

	// 	$query1 = $dbh->prepare($sql1);
        
	// 	if($_POST['blood'][0] == 'all'){
    //         // $query1->bindParam(':fromsa',$from, PDO::PARAM_STR);
    //         // $query1->bindParam(':tosa',$to, PDO::PARAM_STR);
    //         $query1->execute();
    //     }else{
    //         // $query1->bindParam(':froms',$from, PDO::PARAM_STR);
    //         // $query1->bindParam(':tos',$to, PDO::PARAM_STR);
    //         $query1->execute($arr);

    //     }
	// 	$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
		

	// 	foreach($results1 as $key => $result1){
	// 		$contents .= "
	// 			<tr>
	// 				<td>".++$key."</td>
	// 				<td>".$result1->FullName."</td>
	// 				<td>".$result1->Purok.' '.$result1->Barangay."</td>
	// 				<td>".$result1->BloodGroup."</td>
	// 				<td>".getStatus($result1->status)."</td>

	// 			</tr>
	// 			";
	// 	}
	// 	return $contents;
	// }


    function getBLoodgroup(){
        $contents = '';
        include_once('includes/config.php');

        // $arr = [1,2,3,55,51,52,54,31,32,34];
        $arr = $_POST['blood'];
        $placeholders = str_repeat('?,', count($arr) - 1) . '?';

        if($_POST['blood'][0] == 'all'){
            $sql1="SELECT * FROM tblbloodgroup";
        }else {
            $sql1="SELECT * FROM tblbloodgroup WHERE id IN ($placeholders)";
        }

        $query1 = $dbh->prepare($sql1);
        // $query1->bindParam(':arr',$arr, PDO::PARAM_STR);
        $query1->execute($arr);
        $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
        

        foreach($results1 as $key => $result1){
            $contents .= "
                <tr>
                    <td>".++$key."</td>
                    <td>".$result1->BloodGroup."</td>
                    <td>".$result1->PostingDate."</td>
                </tr>
                ";
        }
        return $contents;
    }

    
 
	require_once('../assets/tcpdf/tcpdf.php');  

    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("LIFELINE GENERATING PFD");  
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
    // $pdf->AddPage();  // return this if portrait mode 
    $pdf->AddPage("L");

    if(isset($_POST['submit'])){
        if(isset($_POST['donors'])){
            $content = '';  
            $content .= '
                <h2 align="center">LIFELINE RECORDS</h2>
                <h4>Members Table</h4>
                <table border="1" cellspacing="0" cellpadding="3">  
                    <tr>  
                        <th width="10%">#</th>
                        <th width="30%">Firstname</th>
                        <th width="30%">Address</th> 
                        <th width="20%">Blood Type</th> 
                        <th width="10%">Status</th>

                    </tr>  
            ';  
            $content .= generateRow();  
            $content .= '</table>';  
            $pdf->writeHTML($content);  
            $pdf->Output('members.pdf', 'I');
        }else {
            $content = '';  
            $content .= '
                <h2 align="center">TCPDF</h2>
                <h4>Members Table</h4>
                <table border="1" cellspacing="0" cellpadding="3">  
                    <tr>  
                        <th width="10%">#</th>
                        <th width="30%">Bloodgroup</th>
                        <th width="30%">Date Created</th> 
                    </tr>  
            ';  
            $content .= getBLoodgroup();  
            $content .= '</table>';  
            $pdf->writeHTML($content);  
            $pdf->Output('members.pdf', 'I');
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('includes/new-header.php'); ?>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <style>
            .hide {
                display: none;
            }
        </style>
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
                                        <div class="form-group">
                                            <label for="">Select Generate</label>
                                            <select class="form-control form-control-md" id="generate" name="generate">
                                                <option selected disabled>SELECT..</option>
                                                <option value="1">DONORS LIST</option>
                                                <option value="2">BLOOD GROUP</option>
                                            </select>
                                        </div>

                                       <div class="form-group" id="do">
                                        <label for="">Select Donors</label> 
                                            <select class="js-example-basic-multiple form-control resetter" name="donors[]" id="donorsid" multiple="multiple">
                                                <option value="all">All</option>
                                                <?php
                                                    $donors="SELECT * FROM tblblooddonars";
                                                    $donors_query = $dbh->prepare($donors);
                                                    $donors_query->execute();
                                                    $result_donors = $donors_query->fetchAll(PDO::FETCH_OBJ);
                                                    foreach($result_donors as $donor){
                                                ?>
                                                <option value="<?=$donor->id;?>" class="dns"><?=$donor->FullName;?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                       </div>

                                       <div class="form-group" id="bg">
                                        <label for="">Blood Group</label>
                                            <select class="js-example-basic-multiple form-control resetter" name="blood[]" id="bgid" multiple="multiple">
                                                <option value="all">All</option>
                                                <?php
                                                    $bloodgroup="SELECT * FROM tblbloodgroup";
                                                    $bloodgroup_query = $dbh->prepare($bloodgroup);
                                                    $bloodgroup_query->execute();
                                                    $result_bgs = $bloodgroup_query->fetchAll(PDO::FETCH_OBJ);
                                                    foreach($result_bgs as $bloodgroup){
                                                ?>
                                                <option value="<?=$bloodgroup->BloodGroup;?>" class="dns"><?=$bloodgroup->BloodGroup;?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                       </div>
                                        
                                    <div class="form-group">
                                        <label for="">Date Range</label>
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

<!-- <script src="../admin/js/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();



    $('#do').hide();
    $('#bg').hide();
    $('#generate').change(function (e) { 
        e.preventDefault();
        $(".js-example-basic-multiple").select2('val', 'All');
        if(this.value == 1) { 
            $('#do').show();
            $('#bg').hide();
        }else if(this.value == 2){
            $('#do').hide();
            $('#bg').show();
        }
    });

    $('.resetter').change(function (e) { 
        e.preventDefault();
        if(this.value == 'all'){
            $('select.resetter').each(function(){
                $('.dns').each(function() {
                    if(!this.selected) {
                        $(this).attr('disabled', true);
                    }
                });
            });
        }else{
            $('select.resetter').each(function(){
                $('.dns').each(function() {
                    if(!this.selected) {
                        $(this).attr('disabled', false);
                    }
                });
            });
        }
        
    });
       



});



</script>

</html>
