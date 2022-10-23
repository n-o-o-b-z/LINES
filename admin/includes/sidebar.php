<?php
ob_start();
session_start();
if(!isset($_POST['alogin'])){
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
            <!-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
            <div class="info">
                <a href="profile.php" class="d-block"><?=$_SESSION['full_name'];?> <span class="badge badge-primary"><?=$_SESSION['role'];?></span></a>
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
					<a href="manage-bloodgroup2.php" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
						<p>Blood Group</p>
					</a>
				</li>

                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Charts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" wfd-invisible="true">
                        <li class="nav-item">
                            <a href="pages/charts/chartjs.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ChartJS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/flot.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Flot</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/inline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inline</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/uplot.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>uPlot</p>
                            </a>
                        </li>
                    </ul>
                </li> -->

                <li class="nav-item">
                    <a href="manage-donors.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Donors List
                        </p>
                    </a>
                </li>

                    <!-- <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Manage Contact Us Query
                            </p>
                        </a>
                    </li> -->

                <!-- <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Manage Pages
                        </p>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a href="manage-announcement.php" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Manage Announcements
                        </p>
                    </a>
                </li>

                <?php if($_SESSION['role'] !== 'Hospital'){?>
                    <li class="nav-item">
                        <a href="manage-reports.php" class="nav-link">
                        <i class="nav-icon far fa-file-pdf"></i>
                            <p>
                                Generate Reports
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <!-- //! FOR ADMIN ONLY -->
                <?php if($_SESSION['role'] == 'Admin'){?>
                    <li class="nav-item">
                    <a href="manage-accounts.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Manage Accounts
                        </p>
                    </a>
                    </li>
                <?php } ?>
                
                <?php if($_SESSION['role'] !== 'Hospital'){?>
                    <li class="nav-item">
                    <a href="manage-appointments.php" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Manage Appointments
                        </p>
                    </a>
                    </li>
                <?php } ?>

                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>