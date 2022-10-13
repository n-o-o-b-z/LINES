<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['user_login']) == 0) {
	header('location:index.php');
}
?>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
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
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- <span class="dropdown-item dropdown-header"></span> -->
          <?php
              $myid = $_SESSION['id'];
              $status = 0;
              $getdonate = "SELECT a.*,b.FullName FROM donate_request AS a LEFT JOIN tblblooddonars AS b ON a.user_id = b.id WHERE request_to =:myid AND a.status=:status";
              $donate_query = $dbh->prepare($getdonate); 
              $donate_query->bindParam(':myid', $myid, PDO::PARAM_STR);
              $donate_query->bindParam(':status', $status, PDO::PARAM_STR);
              $donate_query->execute(); 
              $getResults = $donate_query->fetchAll(PDO::FETCH_OBJ);
              
            if(sizeof($getResults) >= 0){ 
              foreach($getResults as $getResult){ ?>
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item" id="msg" data-toggle="modal" data-target="#modalMsg" data-id="<?=$getResult->id; ?>">
                    <i class="fas fa-envelope mr-2"></i> <?=$getResult->FullName;?> requesting for blood!
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
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <input type="hidden" name="message_id">
              <span id="testing"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="deny" data-id="0">Denied</button>
        <button type="button" class="btn btn-primary" id="accept" data-id="0">Accept</button>
      </div>
    </div>
  </div>accept
</div>

  <script src="../assets/adminlte/plugins/jquery/jquery.min.js"></script>

  <script>
    function logout(){
      window.location.href = "././logout.php";
    }
  </script>

  <script>
    $(document).ready(function () {
      $(document).on('click','#msg', function () {
        var msgid = $(this).data('id');
          $('#message_id').val(msgid);
          $('#testing').html(msgid);

          // $('#accept').data('id', msgid);
          // $('#accept').val(msgid);
          $('#accept').attr("data-id", msgid);
          $('#deny').attr("data-id", msgid);
      });

      $('#accept').click(function (e) { 
        e.preventDefault();
          var myIds = $(this).data('id');
          var link = './xhr/accept_request.php';
          requested(myIds,link);
      });

      $('#deny').click(function (e) { 
        e.preventDefault();
        alert('I was denied');
      });


      function requested(data,url){
        var d = data;
        $.ajax({
          type: "POST",
          url: url,
          data: {id:d},
          dataType: "dataType",
          success: function (response) {
            console.log(response);
          }
        });
      }

    });
  </script>
  <!-- /.navbar -->