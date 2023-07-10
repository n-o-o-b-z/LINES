<?php 
session_start();
?>


<nav class="navbar navbar-expand-lg bg-light border-bottom">
  <div class="container-fluid">
      <a class="navbar-brand" href="">
        <img src="./android-chrome-192x192.png" width="35" height="35" alt="">
      </a>
    <!-- <a class="navbar-brand" href="#">LIFELINE</a> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item hov">
          <a class="nav-link <?=$page == 'Home' ? 'actived' : '' ?>" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item hov">
          <a class="nav-link <?=$page == 'announcement' ? 'actived' : '' ?>" href="page.php?type=announcement">Announcement</a>
        </li>
       

        <?php if(!isset($_SESSION['user_login'])){ ?>
        <li class="nav-item hov">
          <a class="nav-link <?=$page == 'donor' ? 'actived' : '' ?>" href="become-donor.php">Become a Donor</a>
        </li>
        <?php }else{}?>

        <li class="nav-item hov">
          <a class="nav-link <?=$page == 'about' ? 'actived' : '' ?>" href="aboutus.php">About</a>
        </li>

        <li class="nav-item hov">
          <a class="nav-link <?=$page == 'contact' ? 'actived' : '' ?>" href="contact.php">Contact us</a>
        </li>

      

        <?php if(!$_SESSION['user_login']):?>
            <!-- <li class="nav-item">
                <a class="nav-link" href="./users/">Login</a>
            </li> -->
        <?php endif; ?>
       <li>
       <?php if(isset($_SESSION['user_login'])):?>
            <a href="./users/profile.php" rel="noopener noreferrer" style="text-decoration:none;vertical-align:middle;color:white;background-color:gray;padding:1px 10px; border-radius:10px;">
                <?php
                    $ids = $_SESSION['id'];
                    $sql1 = "SELECT image from tblblooddonars WHERE id=:ids ";
                    $query1 = $dbh->prepare($sql1);
                    $query1->bindParam(':ids',$ids, PDO::PARAM_STR);
                    $query1->execute();
                    $results1 = $query1->fetch(PDO::FETCH_OBJ);
                    if($results1->image !== NULL){
                ?>
                  <img src="<?=str_replace('./../', '', $results1->image)?>" height="40" size="40" alt="" style="border-radius: 50%; vertical-align:middle">
                <?php }else{ ?>
                  <img src="./images/default-image.png" height="40" size="40" alt="" style="border-radius: 50%; vertical-align:middle">
                <?php } ?>
                <span><?=$_SESSION['name'];?></span>
            </a>
          <?php else: ?>
                <a class="nav-link" href="./users/">Login</a>
        <?php endif; ?>
       </li>
      </ul>
     
    </div>
        
       
  </div>
</nav>