<?php 
session_start();
?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">LIFELINE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="page.php?type=announcement">Announcement</a>
        </li>
       

        <?php if(!isset($_SESSION['user_login'])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="become-donor.php">Become a Donor</a>
        </li>
        <?php }else{}?>

        <li class="nav-item">
          <a class="nav-link" href="aboutus.php">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact us</a>
        </li>

      

        <?php if(!$_SESSION['user_login']):?>
            <li class="nav-item">
                <a class="nav-link" href="./users/">Login</a>
            </li>
        <?php endif; ?>
       
      </ul>
     
    </div>
        <?php if($_SESSION['user_login']):?>
            <a href="./users/profile.php" rel="noopener noreferrer" style="text-decoration:none;vertical-align:middle;color:white;background-color:gray;padding:1px 10px; border-radius:10px;">
                <img src="./images/uploads/375457demon-slayer-nezuko-pfp-2.jpg" height="40" size="40" alt="" style="border-radius: 50%; vertical-align:middle">
                <span><?=$_SESSION['name'];?></span>
            </a>
        <?php endif; ?>
  </div>
</nav>