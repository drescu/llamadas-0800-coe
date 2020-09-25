<?php
if(strlen(session_id()) < 1)
  session_start();
?>  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro Llamadas Coe</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">
    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">    
    <!-- Bootstrap-Select -->
    <link rel="stylesheet" href="../public/css/bootstrap-select.min.css">
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>COE</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>COE</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs"><?=$_SESSION['nombre']." ".$_SESSION['apellido'];?></span>
                </a>
                <ul class="dropdown-menu">
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar Sesión</a>
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
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <li>
              <a href="inicio.php">
                <i class="fa fa-home"></i> <span>Inicio</span>
              </a>
            </li>            
            
            <?php
            if($_SESSION['salud'] == 1) { 
              echo '
                <li class="treeview">
                  <a href="listado_salud.php">
                    <i class="fa fa-user-md"></i>
                    <span>Salud</span>
                    <i class="fa"></i>
                  </a>
                </li>
              ';
            } 

            if($_SESSION['asistencia'] == 1) { 
              echo '
                <li class="treeview">
                  <a href="listado_asistencia.php">
                    <i class="fa fa-ambulance"></i>
                    <span>Asistencia</span>
                    <i class="fa fa"></i>
                  </a>
                </li>
              '; 
            } 

            if($_SESSION['asesoramiento'] == 1) { 
              echo '
                <li class="treeview">
                  <a href="listado_asesoramiento.php">
                    <i class="fa fa-balance-scale"></i>
                    <span>Asesoramiento Legal</span>
                    <i class="fa"></i>
                  </a>
                </li>
              '; 
            } 

            if($_SESSION['transporte'] == 1) { 
              echo '
                <li class="treeview">
                  <a href="listado_transporte.php">
                    <i class="fa fa-truck"></i>
                    <span>Transporte</span>
                    <i class="fa"></i>
                  </a>
                </li>
              ';
            } 

            if($_SESSION['informacion'] == 1) { 
              echo '
                <li class="treeview">
                  <a href="listado_informacion.php">
                    <i class="fa fa-info"></i>
                    <span>Información General</span>
                    <i class="fa"></i>
                  </a>
                </li> 
              '; 
            } 

            if($_SESSION['acceso'] == 1) { 
              echo '
                <li class="treeview">
                  <a href="listado_usuario.php" class="activarRequired">
                    <i class="fa fa-user"></i>
                    <span>Usuarios</span>
                    <i class="fa"></i>
                  </a>
                </li> 
              ';    
            } 
            ?>                   
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>