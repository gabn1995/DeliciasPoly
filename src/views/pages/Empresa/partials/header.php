<?php use \src\Config;?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Delícias da Polly | Dashboard</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo Config::BASE_DIR;?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo Config::BASE_DIR;?>/dist/css/adminlte.min.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo Config::BASE_DIR;?>/empresa/home" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo Config::BASE_DIR;?>/empresa/sair" class="nav-link">Sair</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- alerta -->
  <div class="alerta-js">
        <?php
        if(isset($_SESSION['empresa_aviso'])){ 
            echo"
                    <div class='alert alert-info alert-dismissible fade show w-100 text-center' role='alert'>
                    $_SESSION[empresa_aviso]
                        <button class='close' data-dismiss='alert'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
            ";
            unset($_SESSION['empresa_aviso']);
        }
        ?>

        <script>
            setTimeout(function (){
                document.querySelector('.alerta-js').innerHTML = "";
            },3000);
        </script>
    </div>
    <!-- /.alerta -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo Config::BASE_DIR;?>/empresa/home" class="brand-link">
      <img src="<?php echo Config::BASE_DIR;?>/assets/img/logo1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Delícias da Polly</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo Config::BASE_DIR;?>/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tabelas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo Config::BASE_DIR;?>/empresa/pedidos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pedidos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo Config::BASE_DIR;?>/empresa/pedidos/pendentes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pedidos Pendentes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo Config::BASE_DIR;?>/empresa/pedidos/pagos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pedidos Aprovados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo Config::BASE_DIR;?>/empresa/pedidos/finalizados" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pedidos Finalizados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo Config::BASE_DIR;?>/empresa/clientes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo Config::BASE_DIR;?>/empresa/produtos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Produtos</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </aside>
    
    <input class="base_dir-js" type="hidden" value="<?php echo Config::BASE_DIR; ?>">

