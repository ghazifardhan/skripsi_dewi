<!DOCTYPE html>
<?php
error_reporting(0);?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
        <link href="css/responsive-calendar.css" rel="stylesheet">
        <link href="jquery-ui-1.8.22.custom.css" rel="stylesheet">        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>LT</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="dist/img/dewi.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">
                                        <?php echo ucwords($_SESSION['username']) ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="dist/img/dewi.png" class="img-circle" alt="User Image">
                                        <p>
                                               <?php echo ucwords($_SESSION['username']) ?>
                                            <small><?php echo ucwords($_SESSION['level']) ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="dist/img/dewi.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo ucwords($_SESSION['level']) ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="hidden" name="q" class="form-control" placeholder="Search...">
                            
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="active treeview">
         
        <?php 
        
        if($_SESSION['level'] == 'Admin'){ ?>
             <a href="#">
            <i class="fa fa-dashboard"></i> <span>customer</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="customer.php"><i class="fa fa-circle-o"></i> Input Customer</a></li>
            <li><a href="tampilan_customer.php"><i class="fa fa-circle-o"></i>Tampil Customer</a></li>
            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Kontrak</span>
            <span class="label label-primary pull-right"></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="kontrak.php"><i class="fa fa-circle-o"></i>Input Kontrak</a></li>
            <li><a href="tampilan_kontrak.php"><i class="fa fa-circle-o"></i>Tampil Kontraktor</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Users</span>
            <span class="label label-primary pull-right"></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="input_users.php"><i class="fa fa-circle-o"></i>Input User</a></li>
            <li><a href="tampilan_user.php"><i class="fa fa-circle-o"></i>Tampil User</a></li>
          </ul>
        </li>
        
        
       
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Proses</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="Proses.php"><i class="fa fa-circle-o"></i> Pengajuan_Tagihan</a></li>
            <li><a href="tampilan_proses.php"><i class="fa fa-circle-o"></i> Tampilan_Pengajuan_Tagihan</a></li>
           
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Transaksi</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            
            <li><a href="trx.php"><i class="fa fa-circle-o"></i>Input Transaksi</a></li>
            <li><a href="tampilan_trx.php"><i class="fa fa-circle-o"></i>Hasil Transaksi</a></li>
         
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Report Tagihan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="report_tagihan.php"><i class="fa fa-circle-o"></i>report_tagihan</a></li>
            <li><a href="tampil_approve.php"><i class="fa fa-circle-o"></i>Approve </a></li>
            <li><a href="grafik.php"><i class="fa fa-circle-o"></i>Report Progres  </a></li>
         
          </ul>
        </li>
         </ul>
    <?php }elseif($_SESSION['level'] =='Director') {?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Transaksi</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="tampilan_trx.php"><i class="fa fa-circle-o"></i>Hasil Transaksi</a></li>
         
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Report Tagihan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="report_tagihan.php"><i class="fa fa-circle-o"></i>report_tagihan</a></li>
         
          </ul>
        </li>
         </ul>
    
    
    <?php }elseif($_SESSION['Konsultan']) { ?>
    
    <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Proses</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="Proses.php"><i class="fa fa-circle-o"></i> Pengajuan_Tagihan</a></li>
            <li><a href="tampilan_proses.php"><i class="fa fa-circle-o"></i> Tampilan_Pengajuan_Tagihan</a></li>
           
          </ul>
        </li>
    
    
    
    <?php }else{ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Transaksi</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <li><a href="Proses.php"><i class="fa fa-circle-o"></i> Pengajuan_Tagihan</a></li>
            <li><a href="tampilan_proses.php"><i class="fa fa-circle-o"></i> Tampilan_Pengajuan_Tagihan</a></li>
            <li><a href="tampilan_trx.php"><i class="fa fa-circle-o"></i>Hasil Transaksi</a></li>
         
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Report Tagihan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="report_tagihan.php"><i class="fa fa-circle-o"></i>report_tagihan</a></li>
         <li><a href="grafik.php"><i class="fa fa-circle-o"></i>Report Progres  </a></li>
          </ul>
        </li>
        
        
    <?php } ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php
                if (isset($_SESSION['flash']) && $_SESSION['flash']['expired'] < time()) {
                    echo '<div class="alert alert-' . $_SESSION['flash']['status'] . '">' . $_SESSION['flash']['msg'] . '</div>';
                    unset($_SESSION['flash']);
                }
                ?> 