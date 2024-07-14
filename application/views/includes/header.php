
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageTitle; ?></title>
  <link rel="icon" href="<?= base_url() ?>assets/images/travler.png" type="image/x-icon">
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.4 -->
  <link href="<?= base_url() ?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="<?= base_url() ?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons 2.0.0 -->
  <link href="<?= base_url() ?>assets/admin/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="<?= base_url() ?>assets/admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
  <link href="<?= base_url() ?>assets/admin/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

  <style>
    .error {
      color: red;
      font-weight: normal;
    }
  </style>
  <script src="<?= base_url() ?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
    const isAdmin = "<?php echo $_SESSION['role']; ?>"
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/fileUpload/fileUpload.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url(); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b><?= strtoupper(substr(WEB_NAME, 0, 1)); ?></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?= WEB_NAME ?></b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown tasks-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-history"></i>
              </a>
              <ul class="dropdown-menu">
                <li class="header"> Last Login : <i class="fa fa-clock-o"></i> <?= empty($last_login) ? "First Time Login" : $last_login; ?></li>
              </ul>
            </li>
            <li class="dropdown tasks-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-bell"><sup style="background-color: green; border-radius: 50%; padding: 3px;"><?= (!empty($notifications)) ? count($notifications) : ''; ?></sup></i>
              </a>
              <ul class="dropdown-menu" style="max-height: 50vh;overflow-y: scroll; padding:20px 5px;" >
                <?php if (!empty($notifications)) {

                  foreach ($notifications as $notification) {

                ?>
                    <li  class="header">
                      <i class="fa fa-envelope text-muted "><a style="font-size: 12px;" href="<?= base_url('booking/view-more?serId=') . $notification->booking_id . "&nid=" . $notification->id ?>" class="<?= ($notification->read_status == 1) ? 'disabled' : '' ?>">
                          <?= substr($notification->message, 0, 31); ?>...
                          <br>
                           &nbsp; &nbsp; &nbsp; &nbsp; <small class="my-3" style="font-size: 8px;"><?= $notification->createdDtm; ?></small></a></i>
                    </li>
                  <?php } } else { ?>
                  <li class="header">
                    <center>no records found... </center>
                  </li>
                <?php }  ?>
              </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url() ?>assets/admin/dist/img/avatar.png" class="user-image" alt="User Image" />
                <span class="hidden-xs"><?php echo $name; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">

                  <img src="<?= base_url() ?>assets/admin/dist/img/avatar.png" class="img-circle" alt="User Image" />
                  <p>
                    <?php echo $name; ?>
                    <small><?php echo $role_text; ?></small>
                  </p>

                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url('profile'); ?>" class="btn btn-warning btn-flat"><i class="fa fa-user-circle"></i> Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url('logout'); ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
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

      <?php

      $prefix = "";
      if ($is_admin == SYSTEM_ADMIN) {
        $prefix = "admin";
      } else if ($is_admin == AGENT_USER) {
        $prefix = "agent";
      } else if ($is_admin == REGULAR_USER) {
        $prefix = "users";
      }
      ?>

      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header text-center">
            <h2><?php echo strtoupper($role_text); ?> PANEL </h2>
          </li>
          <li>
            <a href="<?php echo base_url() . $prefix; ?>/dashboard">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
            </a>
          </li>

          <?php if (check_permission("Users", 'list') == 1) { ?>
            <li>
              <a href="<?php echo base_url('userListing'); ?>">
                <i class="fa fa-users"></i>
                <span>Users</span>
              </a>
            </li>
          <?php }
          if (check_permission("Roles", 'list') == 1) { ?>
            <li>
              <a href="<?php echo base_url('roles/roleListing'); ?>">
                <i class="fa fa-user-circle-o " aria-hidden="true"></i>
                <span>Roles</span>
              </a>
            </li>
          <?php }
          if (check_permission("Prices", 'list') == 1) { ?>
            <li>
              <a href="<?php echo base_url('prices'); ?>">
                <i class="fa fa-dollar " aria-hidden="true"></i>
                <span>Prices</span>
              </a>
            </li>
            <?php } if (check_permission("Tax", 'list') == 1) { ?>
            <li>
              <a href="<?php echo base_url('tax'); ?>">
                <i class="fa fa-dollar " aria-hidden="true"></i>
                <span>Tax Management</span>
              </a>
            </li>
          <?php }
          if (check_permission("Categories", 'list') == 1) { ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-anchor"></i> <span>Categories</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('category'); ?>"><i class="fa fa-circle-o"></i> Main Category</a></li>
              </ul>
            </li>
          <?php } ?>
          <!-- Services li start -->
          <?php {

            if ($services_info) {

              foreach ($services_info as $service) {
                $cLabel = $service->categoryLabel;
                $cid = $service->categoryId;
                $subStr = substr($service->categoryName, 0, 20);
                $strLower = strtolower($service->categoryName);
                $cr =  array(' ', '&', '#', '%', '$', '@', '!', '^', '*', ';', '"', "'", ',', '.', '?', '/');
                $strRCategory = str_replace($cr, '_', $subStr);
                $str_id = trim($service->categoryId);
                $url = base_url('package-type/list?txt=' . $strRCategory . "&id=" . $str_id);

                $txt = "";
                if ($cLabel == ATTRACTION) {
                  $txt =  "attractions";
                } else if ($cLabel == TRANSPORT) {
                  $txt =  "transportation";
                }
                if (check_permission($service->categoryName, 'list') == 1) { ?>

                  <li class="treeview">
                    <a href="#"><i class="fa fa-share"></i><?= ucwords($subStr); ?>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="<?= base_url('packages/listing?txt=' . $txt . '&id=' . $cid); ?>"><i class="fa fa-circle-o"></i>
                          <?php if ($cLabel == ATTRACTION) {
                            echo "Attractions";
                          } else if ($cLabel == TRANSPORT) {
                            echo "Transportation";
                          }
                          ?>
                        </a></li>
                      <li><a href="<?= $url; ?>"><i class="fa fa-circle-o"></i>
                          <?php if ($cLabel == ATTRACTION) {
                            echo "Attraction Packages";
                          } else if ($cLabel == TRANSPORT) {
                            echo "Transfer Types";
                          }
                          ?>
                        </a></li>
                    </ul>
                  </li>
          <?php } } } } ?>
          <!-- Booking li start -->
          <?php if (check_permission('Booking', 'list') == 1) { ?>
            <li>
              <a href="<?php echo base_url('booking'); ?>">
                <i class="fa fa-anchor"></i>
                <span>Booking</span>
              </a>
            </li>
          <?php }
          if (check_permission('Suppliers', 'list') == 1) { ?>
            <li>
              <a href="<?php echo base_url('suppliers'); ?>">
                <i class="fa fa-users"></i>
                <span>Suppliers</span>
              </a>
            </li>
          <?php } ?>
          <!-- General -->
          <li class="header ">
            <h5 style="margin-top: 5px; margin-bottom: 0px; font-size: 18px; " > General Settings  </h5>
          </li>
        

          <?php if (check_permission('Settings', 'list') == 1) { ?>
            <li>
              <a href="<?php echo base_url('web-settings'); ?>">
                <i class="fa fa-tasks"></i>
                <span>Web Settings</span>
              </a>
            </li>
          <?php } ?>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>