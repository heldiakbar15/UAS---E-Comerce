<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman <?= $data['judul']; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/plugins/fontawesome-free/css/all.min.css">
  
  <!-- summernote -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/plugins/summernote/summernote-bs4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/dist/css/adminlte.min.css">
  <style>
    .img-preview {
        position: relative;
        display: inline-block;
        margin: 5px;
    }
    .img-preview img {
        width: auto;
        height: 100px;
        display: block;
    }

    .remove-icon {
        position: absolute;
        top: 0;
        right: 0;
        background-color: red;
        color: white;
        font-weight: bold;
        cursor: pointer;
        padding: 2px 5px;
        border-radius: 50%;
    }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      <!-- Notifications Dropdown Menu -->
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true): ?>
              <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']): ?>  
                Hello <?= $_SESSION['username'] ?>
              <?php endif; ?>
          <?php endif; ?>
          <i class=" far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Action</span>
          <div class="dropdown-divider"></div>
          <a href="<?= BASEURL; ?>/Home" class="dropdown-item">
            <i class="fas fa-arrow-right mr-2"></i> Back to home
          </a>
            <a href="<?= BASEURL; ?>/auth/logout" onclick="submitForm()" class="dropdown-item">
              <i class="fas fa-arrow-right mr-2"></i> Logout
            </a>  
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content -->
  