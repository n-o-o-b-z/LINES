<?php 
session_start();
?>
    <!-- <nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
            <a class="navbar-brand" href="index.php">LIFELINE</a>
            <div class="collapse navbar-collapse" id="navbarExample">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="page.php?type=announcement">Announcement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="become-donor.php">Become a Donor</a>
                    </li>
                 
                     <li class="nav-item">
                        <a class="nav-link" href="search-donor.php">Search Donor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="page.php?type=aboutus">About</a>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact us</a>
                    </li>
                 
                 
                </ul>
            </div>
        </div>
    </nav> -->

<nav class="navbar navbar-expand-lg fixed-top bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-end mr-5" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
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
                    <a class="nav-link" href="search-donor.php">Search Donor</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="page.php?type=aboutus">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact us</a>
                </li>

                <?php if(!$_SESSION['user_login']):?>
                    <li class="nav-item">
                        <a class="nav-link" href="./users/">Login</a>
                    </li>
                <?php endif; ?>
                
                    
                <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
            </ul>

        </div>
        <?php if($_SESSION['user_login']):?>
            <a href="./users/profile.php" rel="noopener noreferrer">
                <img src="./images/uploads/375457demon-slayer-nezuko-pfp-2.jpg" height="40" size="40" alt="" style="border-radius: 50%; vertical-align:middle">
            </a>
        <?php endif; ?>
    </div>
</nav>

