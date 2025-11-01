<?php
session_start();
if(empty($_SESSION['active'])){
  header('Location: ./');
}
    
  $idprofesor=$_SESSION['profesor_id'];

  $sql="SELECT * FROM profesor_area as pa INNER JOIN grados as g ON pa.grado_id=g.grado_id INNER JOIN aulas as a ON pa.aula_id=a.aula_id INNER JOIN profesor as p ON pa.profesor_id=p.profesor_id INNER JOIN areas as ar ON pa.area_id=ar.area_id  WHERE pa.estadopa!=0 AND pa.profesor_id='$idprofesor'";
  $query=$pdo->prepare($sql,[PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
  $query->execute();
  $row=$query->rowCount();
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=APP_NAME;?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=APP_URL;?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=APP_URL;?>/dist/css/adminlte.min.css">
  <!-- iconos de Bootstrap -->
  <Link rel="stylesheet" href="<?=APP_URL;?>/bootstrap-icons-1.11.3/font/bootstrap-icons.css">
  <!--Data table-->
  <Link rel="stylesheet" href="<?=APP_URL;?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <Link rel="stylesheet" href="<?=APP_URL;?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <Link rel="stylesheet" href="<?=APP_URL;?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Sweetalert css-->
  <link rel="stylesheet" href="<?=APP_URL;?>/css/sweetalert/sweetalert2.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=APP_URL;?>/profesor/" class="nav-link"><?=APP_NAME; ?></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=APP_URL;?>/profesor/" class="brand-link">
      <img src="<?=APP_URL?>/administrador/images/icono_cole.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GESTION ESCOLAR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=APP_URL?>/profesor/images/icono_usuario.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$_SESSION['profesor_nombre'].'-'.$_SESSION['nombre-rol']?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link active">
            <i class="bi bi-list"></i>
              <p>
                Areas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php
             if($row>0){
                  while($data=$query->fetch()){
              ?>
                <li><a class="treeview-item" href="actividades.php?profesor_area=<?=$data['pa_id'];?>"><i class="icon bi bi-circle-fill"></i><?=$data['nombre_area'];?>-<?=$data['nombre_grado'];?>-<?=$data['nombre_aula'];?> </a></li>
              <?php
                  }
                }
              
              ?>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
            <i class="bi bi-list"></i>
              <p>
                Calificaciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php
                $query->execute();
                //$query->fetch(PDO::FETCH_ORI_FIRST);
              if($row>0){
                  while($data=$query->fetch()){
              ?>
                <li><a class="treeview-item" href="calificaciones.php?profesor_area=<?=$data['pa_id'];?>"><i class="icon bi bi-circle-fill"></i><?=$data['nombre_area'];?>-<?=$data['nombre_grado'];?>-<?=$data['nombre_aula'];?> </a></li>
              <?php
                  }
                }
              ?>
              
            </ul>
          </li>
          
          <!-- Close ----->
          <li class="nav-item">
            <a href="../logout.php" class="nav-link" style="background-color:#D41521;">
            <i class="bi bi-door-closed"></i>
              <p>
                Cerrar sesion
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
