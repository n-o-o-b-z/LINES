<?php
ob_start();
session_start();
if(!isset($_POST['user_login'])){
    HEADER('Location: index.php');
}

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <!-- <img src="dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">LIFELINE: BLOOD DONATION</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <img src="../../assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
                <?php
                    $sql1 = "SELECT image from tblblooddonars ";
                    $query1 = $dbh->prepare($sql1);;
                    $query1->execute();
                    $results1 = $query1->fetch(PDO::FETCH_OBJ);

                    if($results->image == NULL){ 
                ?>
                        <img src="./../images/default.jpg" class="img-circle elevation-2" alt="User Image">
                <?php }else{ ?>
                        <img src="<?=$results1->image?>" class="img-circle elevation-2" alt="User Image">
                <?php } ?>
            </div>
            <div class="info">
                <a href="profile.php" class="d-block"><?=$_SESSION['name'];?> <span class="badge badge-primary"></span></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard2.php" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Dashboard
                            <!-- <span class="badge badge-info right">2</span> -->
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../page.php" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            See Announcements
                            <!-- <span class="badge badge-info right">2</span> -->
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="request_blood.php" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Request for Blood
                            <!-- <span class="badge badge-info right">2</span> -->
                        </p>
                    </a>
                </li>

               


                <!-- <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Update Contact Info
                        </p>
                    </a>
                </li> -->
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>