<?php
  session_start();
error_reporting(0);
include('includes/config.php');
if (!isset($_SESSION['alogin'])) {
  header('HTTP/1.0 403 Forbidden'); 
  die('You are not allowed to access this file.'); 
}
?>
  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <?php
              // $myid = $_SESSION['id'];
              $status = NULL;
              $openornot = 1;
              $table = "SELECT count(*) FROM tblcontactusquery WHERE is_opened = :openornot";
              $result_table = $dbh->prepare($table); 
              $result_table->bindParam(':openornot', $openornot , PDO::PARAM_STR);
              $result_table->execute(); 
              $number_of_rows = $result_table->fetchColumn(); 
              echo $number_of_rows;
              // var_dump($number_of_rows);
             ?>
          
        </a>
        <?php
              // $myid = $_SESSION['id'];
              // $status = '';
              $getContactus = "SELECT * FROM tblcontactusquery";
              $getContact_query = $dbh->prepare($getContactus); 
              // $getContact_query->bindParam(':myid', $myid, PDO::PARAM_STR);
              // $getContact_query->bindParam(':status', $status, PDO::PARAM_STR);
              $getContact_query->execute(); 
              $getResults = $getContact_query->fetchAll(PDO::FETCH_OBJ);
            ?>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right classa" id="txt-msg" data-id="<?= $getResults[0]->id; ?>" data-toggle="modal" data-target="#message_modal">
       <?php
            if(sizeof($getResults) >= 0){ 
              foreach($getResults as $getResult){ ?>
                <a href="#" class="dropdown-item">
                  <div class="media">
                    <img src="../assets/adminlte/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                      <h3 class="dropdown-item-title">
                        <?=$getResult->name;?>
                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                      </h3>
                      <p class="text-sm"><?=$getResult->Message;?></p>
                      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <?php }}else{} ?>



          
          <!-- <a href="#" class="dropdown-item">
            <div class="media">
              <img src="../assets/adminlte/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="../assets/adminlte/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a> -->



        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <?php
              $status = 1;
              $getCount = "SELECT COUNT(id) AS counter  FROM donate_request WHERE status=:status";
              $count_query = $dbh->prepare($getCount); 
              $count_query->bindParam(':status', $status, PDO::PARAM_STR);
              $count_query->execute(); 
              $getCounted = $count_query->fetch(PDO::FETCH_OBJ);
              ?>
        <a class="nav-link <?=$getCounted->counter == 0 ? 'disabled':''?>" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">
           <?php
              echo $getCounted->counter;
            ?>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right classb" >
          <?php
              $status = 1;
              $getdonate = "SELECT a.*,b.FullName,c.FullName as names FROM donate_request AS a LEFT JOIN tblblooddonars AS b ON a.user_id = b.id LEFT JOIN tblblooddonars AS c ON a.request_to = c.id WHERE  a.status=:status";
              $donate_query = $dbh->prepare($getdonate); 
              $donate_query->bindParam(':status', $status, PDO::PARAM_STR);
              $donate_query->execute(); 
              $getResults = $donate_query->fetchAll(PDO::FETCH_OBJ);
              
            if(sizeof($getResults) >= 0){ 
              foreach($getResults as $getResult){ ?>
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item" id="msg" style="cursor:pointer" data-toggle="modal" data-target="#modalMsg" data-id="<?=$getResult->request_to; ?>" data-eg="<?=$getResult->user_id; ?>">
                    <i class="fas fa-envelope mr-2" style="cursor:pointer"></i><?=$getResult->names;?> accepted <?=$getResult->FullName?> request for blood!
                  </a>
            <?php }
            }else{ ?>
              <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-id="<?=$getResult->id; ?>">
                  <i class="mr-2"></i> NO DATA TO SHOW  
                  <span class="float-right text-muted text-sm"></span>
                </a>
          <?php } ?>
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <form action="" method="post"> -->
        <li class="nav-item" onclick="logout();">
          <a class="nav-link" data-widget="control-sidebar" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>

        
      <!-- </form> -->
    </ul>
  </nav>

  <!-- Modal -->
<div class="modal fade" id="modalMsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SET APPOINTMENT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <label for="date">Date: </label>
              <input type="text" name="date" class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" autocomplete="off">   
              <label for="loc">Location: </label>
              <input type="text" name="location" id="loc"  class="form-control">
              <input type="hidden" name="requester" id="requester">
              <input type="hidden" name="accepter" id="accepter">
              <!-- <textarea name="" class="form-control" id="" cols="30" rows="10"></textarea> -->
              <!-- <input type="hidden" name="message_id"> -->
              <!-- <span id="testing"></span> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="deny" data-id="0">Close</button>
        <button type="button" class="btn btn-primary" id="accept" data-id="0">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="message_modal" tabindex="-1" role="dialog" aria-labelledby="message_modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="message_modalLabel"><span id="name_content"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="message_content"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="../assets/adminlte/plugins/jquery/jquery.min.js"></script>

  <script>
    function logout(){
      window.location.href = "././logout.php";
    }

    $(document).ready(function () {
      
      $('#datetimepicker5').datetimepicker({
            icons: {
                time: "fas fa-clock",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
      });


      $(document).on('click','#msg', function () {
        //request to
         console.log($(this).data('id'));
         //userid
         console.log($(this).data('eg'));
          
          $('#requester').val($(this).data('id'));
          $('#accepter').val($(this).data('eg'));

      });

      $('#accept').click(function (e) { 
        e.preventDefault();
        // console.log('aceept');
        var urls = 'xhr/add-appointment.php';
        var date = $('#datetimepicker5').val();
        var loc = $('#loc').val();
        var requester = $('#requester').val();
        var accepter  = $('#accepter').val();

        $.ajax({
          type: "POST",
          url: urls,
          data: {date:date,loc:loc,requester:requester,accepter:accepter},
          dataType: "json",
          success: function (response) {
            console.log(response)
              if(response===0){
                alert("Appointment Set!")
                location.reload();
              }else{
                alert("Failed")
              }
          }
        });
      });

      $(document).on('click','#txt-msg', function () {
        var id = $(this).data('id');
        $.ajax({
          type: "POST",
          url: "xhr/show-message.php",
          data: {id:id},
          dataType: "JSON",
          success: function (response) {
            console.log(response[0].name);
            
            $('#name_content').html(response[0].name);
            $('#message_content').html(response[0].Message);
          }
        });
      });

      $('#message_modal').on('hide.bs.modal', function (e) {
        $('#name_content').html('');
        $('#message_content').html('');
      });

    });
  </script>


  <!-- /.navbar -->