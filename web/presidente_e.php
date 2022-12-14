
<?php
//-----CARGO SESSION --------------------------------------------------------------
//header("Refresh: 10");
session_start();
$nombre = $_SESSION['nombre'] ;
$apellido= $_SESSION['apellido'] ;
$tipo_usuario = $_SESSION['tipo_usuario'] ;
$id_usuario = $_SESSION['id_usuario'] ;

if ($tipo_usuario != "presidente"){
  session_destroy();

  header ("Location: login.php");

}

include("conexion2.php");

$id_votacion ="";  // inicializa los variables
$estado ="";
$registro ="";

//include("update_panel.php");
include("infobox.php");
include("panel_sesion.php");
include("panel_votacion.php");
include("estado_sistema_votacion.php");


//-----Botonera SESION --------------------------------------------------------------

//-----Apetura de sesion --------------------------------------------------------------

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
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Panel de Control | Presidente</title>


  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="presidente.php" class="nav-link">Inicio</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="logout.php" class="nav-link">Salir</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <!--
      <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
      <button class="btn btn-navbar" type="submit">
      <i class="fas fa-search"></i>
    </button>
  </div>
</div>
</form> -->

<!-- Right navbar links -->



<ul class="navbar-nav ml-auto">
  <!-- Messages Dropdown Menu -->
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-comments"></i>
      <span class="badge badge-danger navbar-badge"><?php echo $suma_pedido_palabra;?></span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <a href="#" class="dropdown-item">
        <!-- Message Start -->
        <div class="media">
          <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
          <div class="media-body">
            <h3 class="dropdown-item-title">
              Vitalini Nicolas
              <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
            </h3>
            <p class="text-sm">Call me whenever you can...</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
          </div>
        </div>
        <!-- Message End -->
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
        <!-- Message Start -->
        <div class="media">
          <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
          <div class="media-body">
            <h3 class="dropdown-item-title">
              John Pierce
              <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
            </h3>
            <p class="text-sm">I got your message bro</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
          </div>
        </div>
        <!-- Message End -->
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
        <!-- Message Start -->
        <div class="media">
          <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
          <div class="media-body">
            <h3 class="dropdown-item-title">
              Nora Silvester
              <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
            </h3>
            <p class="text-sm">The subject goes here</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
          </div>
        </div>
        <!-- Message End -->
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
  </li>
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
    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
      class="fas fa-th-large"></i></a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="dist/img/logo113x113-2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">Panel de Control </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/<?php echo $apellido ?>-150x150.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $nombre ?> <?php echo $apellido ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Panel                <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="presidente.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Panel Principal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="presidente_p.php" class="nav-link">
                <i class="far fa-share-square nav-icon"></i>
                <!-- <i class="far fa-circle nav-icon"></i>-->
                <p>Publicar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="presidente_pedidopalabra.php" class="nav-link ">
                <!--<i class="far fa-circle nav-icon"></i>-->
                <i class="fas fa-microphone-alt nav-icon"></i>
                <p>Pedidos-Palabra</p>
              </a>
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link active">
                <i class="fas fa-book nav-icon "></i>
                <p>Expedientes</p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ver Exp.</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Editar Exp.</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="presidente_ea.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ingresar Exp.</p>
                  </a>
                </li>

              </ul>

            </li>




          </ul>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Salir
              <span class="right badge badge-danger">Exit</span>
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Panel Presidencia</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="presidente.php">Panel Principal</a></li>
            <li class="breadcrumb-item active">Presidente</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <h5 class="mb-2">Info Box</h5>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="<?php echo $estado_sesion_tag;?>"><i class="<?php echo $estado_sesion_logo;?>"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Estado de sesion</span >
                <!-- <span class="info-box-number"> <?php echo $estado_sesion;?> </span> -->
                <span class="info-box-number"> <?php echo $estado_sesion1;?> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="<?php echo $pedido_palabra_tag;?>"><i class="far fa-comment"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pedido de palabra</span>
                <!--<span class="info-box-number"><?php echo $suma_pedido_palabra;?> </span>-->
                <span class="info-box-number"  id="display_4"> Cargando</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="<?php echo $tag;?>"><i class="far fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Concejales Presentes</span>

                <!-- <span class="info-box-number"> <?php echo $sumapresentes;?> <?php echo $quorum;?>  </span>-->
                <!--<span class="info-box-number"> <?php echo $concejales_presentes;?> <?php echo $quorum;?>  </span>-->
                <span class="info-box-number" id="display_3"> Cargando</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <a class="<?php echo $resultado_votacion_tag;?>" href="publicar.php" ><i class="far fa-share-square"></i></a>

              <div class="info-box-content">
                <span class="info-box-text">Publicar Resultado</span>
                <span class="info-box-number"><?php echo $resultado_votacion;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>







        <div >


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Proyectos a votar  <span class="right badge badge-danger"><?php echo  $dia2 ?></span> </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <!--<table class="table table-striped projects">-->
                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th>
                          N?? Exp.
                        </th>
                        <th >
                          Fecha tratamiento
                        </th>
                        <th >
                          N Orden
                        </th>
                        <th  >
                        Tipo exp.
                        </th>
                        <th style="width: 25%" >
                          Descripcion
                        </th>
                        <th style="width: 10%" >
                          Estado
                        </th>
                        <th >
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $dia2 = date("Y-m-d");
                      $estado= 1;
                      //$sql="SELECT * from expediente WHERE (fecha_tratamiento='$dia2') AND (estado_tratamiento=$estado)  ORDER BY orden_expediente ASC";
                      //$sql="SELECT * from expediente WHERE (fecha_tratamiento='$dia2') ORDER BY ororden_expediente ASCden_expediente ASC";
                      //$sql="SELECT * from expediente ORDER BY fecha_tratamiento DESC, orden_expediente ASC"; funciona OK
                      $sql="SELECT * from expediente WHERE (fecha_tratamiento='$dia2') AND (estado_tratamiento='$estado') ORDER BY fecha_tratamiento DESC, orden_expediente ASC";
                      //$sql="SELECT * from expediente ORDER BY n_expediente DESC, orden_expediente ASC";
                      $result=mysqli_query($datos_conexion,$sql);
                      while($mostrar=mysqli_fetch_array($result)){

                        ?>
                      <tr>

                        <td>
                          <a>
                            <b><?php echo $mostrar['n_expediente'] ?></b>
                          </a>
                          <br>
                          <small>
                            A??o <?php echo $mostrar['anio_expediente'] ?>
                          </small>
                        </td>
                        <td>
                          <a>
                            <b ><?php echo $mostrar['fecha_tratamiento'] ?></b>
                          </a>

                        </td>
                        <td >
                          <a>
                            <b ><?php echo $mostrar['orden_expediente'] ?></b>
                          </a>
                        </td>
                        <td class="project-state">
                          <?php
                          switch ($mostrar['tipo_expediente']) {
                            case "Ordenanza":
                            $tipo="badge badge-success";
                            break;
                            case "Resoluci??n":
                            $tipo="badge badge-info";
                            break;
                            case "Minuta":
                            $tipo="badge badge-warning";
                            break;
                            case "Decreto":
                            $tipo="badge badge-secondary";

                          }

                          ?>
                          <span class="<?php echo $tipo ?>"><?php echo $mostrar['tipo_expediente'] ?></span>
                        </td>
                        <td >
                          <a>
                            <b ><?php echo $mostrar['descripcion_expediente'] ?></b>
                          </a>
                        </td>
                        <td >
                          <?php
                          switch ($mostrar['estado_tratamiento']) {
                            case "1":
                            $tipo1="Para ingresar";
                            break;
                            case "2":
                            $tipo1="En votacion";
                            break;
                            case "3":
                            $tipo1="votado";

                          }

                          ?>
                          <a>
                            <b ><?php echo $tipo1 ?></b>
                          </a>
                        </td>
                        <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="presidente_ev1.php?cod=<?php echo $mostrar['id_expediente']?>">
                            <i class="fas fa-folder">
                            </i>
                            Ver
                          </a>
                          <a class="btn btn-info btn-sm" href="presidente_ee.php?cod=<?php echo $mostrar['id_expediente']?>">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Editar
                          </a>

                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>


              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Todos los Proyectos</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                      </div>
                    </div>
                    <div class="card-body p-0">
                      <table class="table table-responsive">
                        <thead>
                          <tr>
                            <th>
                              N?? Exp.
                            </th>
                            <th >
                              Fecha tratamiento
                            </th>
                            <th >
                              N Orden
                            </th>
                            <th  >
                            Tipo exp.
                            </th>
                            <th style="width: 25%" >
                              Descripcion
                            </th>
                            <th style="width: 10%" >
                              Estado
                            </th>
                            <th >
                            </th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          $dia2 = date("Y-m-d");
                          $estado= 1;
                          //$sql="SELECT * from expediente WHERE (fecha_tratamiento='$dia2') AND (estado_tratamiento=$estado)  ORDER BY orden_expediente ASC";
                          //$sql="SELECT * from expediente WHERE (fecha_tratamiento='$dia2') ORDER BY ororden_expediente ASCden_expediente ASC";
                          $sql="SELECT * from expediente ORDER BY fecha_tratamiento DESC, orden_expediente ASC";
                          //$sql="SELECT * from expediente WHERE (estado_tratamiento='$estado') ORDER BY fecha_tratamiento DESC, orden_expediente ASC";
                          //$sql="SELECT * from expediente ORDER BY n_expediente DESC, orden_expediente ASC";
                          $result=mysqli_query($datos_conexion,$sql);
                          while($mostrar=mysqli_fetch_array($result)){

                            ?>
                          <tr>

                            <td>
                              <a>
                                <b><?php echo $mostrar['n_expediente'] ?></b>
                              </a>
                              <br>
                              <small>
                                A??o <?php echo $mostrar['anio_expediente'] ?>
                              </small>
                            </td>
                            <td>
                              <a>
                                <b ><?php echo $mostrar['fecha_tratamiento'] ?></b>
                              </a>

                            </td>
                            <td >
                              <a>
                                <b ><?php echo $mostrar['orden_expediente'] ?></b>
                              </a>
                            </td>
                            <td class="project-state">
                              <?php
                              switch ($mostrar['tipo_expediente']) {
                                case "Ordenanza":
                                $tipo="badge badge-success";
                                break;
                                case "Resoluci??n":
                                $tipo="badge badge-info";
                                break;
                                case "Minuta":
                                $tipo="badge badge-warning";
                                break;
                                case "Decreto":
                                $tipo="badge badge-secondary";

                              }

                              ?>
                              <span class="<?php echo $tipo ?>"><?php echo $mostrar['tipo_expediente'] ?></span>
                            </td>
                            <td >
                              <a>
                                <b ><?php echo $mostrar['descripcion_expediente'] ?></b>
                              </a>
                            </td>
                            <td >
                              <?php
                              switch ($mostrar['estado_tratamiento']) {
                                case "1":
                                $tipo1="Para ingresar";
                                break;
                                case "2":
                                $tipo1="En votacion";
                                break;
                                case "3":
                                $tipo1="votado";

                              }

                              ?>
                              <a>
                                <b ><?php echo $tipo1 ?></b>
                              </a>
                            </td>
                            <td class="project-actions text-right">
                              <a class="btn btn-primary btn-sm" href="presidente_ev1.php?cod=<?php echo $mostrar['id_expediente']?>">
                                <i class="fas fa-folder">
                                </i>
                                Ver
                              </a>
                              <a class="btn btn-info btn-sm" href="presidente_ee.php?cod=<?php echo $mostrar['id_expediente']?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Editar
                              </a>

                            </td>
                          </tr>
                          <?php
                        }
                        ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>










              <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
          OF. Informatica HCD BB
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2021 <a href="http://concejobahia.gob.ar/">VotoHCD</a>.</strong> All rights reserved.
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- jQuery Knob -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- page script -->
    <script type="text/javascript">

    /* ********  Carga inicial informacion dashboard ************ */

    let estadoinicialquorum = " "; // defino varable estado inicial quorum
    $(document).ready(function(){
            //var aleatorio = Math.round(Math.random()*10);
            var idUsuario = <?php echo $id_usuario ?>;
            $.ajax(
              {
                //url:'seccion2.php',
                //url:'seccion1.php',
                url:'seccion1.php',
                method:"POST",
                data:{
                    numero:idUsuario,
                }
              }).done(function(res){
                var datos=JSON.parse(res);
                var idato1 = datos.n_sesion_anio;
                var idato2 = datos.estado_quorum;
                var idato3 = datos.concejales_presentes;
                var idato4 = datos.pedido_palabra;
                var idato5 = datos.registro_votacion;
                var idato6 = datos.votacion_positiva;
                var idato7 = datos.votacion_negativa;
                var idato8 = datos.votacion_abstencion;
                var idato9 = datos.votacion_resultado;
                var idato10 = datos.usuario;

                estadoinicialquorum = datos.estado_quorum; //cargo estado inicial de quorum
                //var estadoinicialquorum = datos.sesion_anio;
                console.log('idato2:',datos.estado_quorum);
                update_panel(idato1, idato2, idato3, idato4, idato5, idato6, idato7, idato9, idato10);


              });

    	});

    function update_panel(dato1, dato2, dato3, dato4, dato5, dato6, dato7, dato9, dato10){
      $("#display_1").html(dato1);
      $("#display_2").html(dato2);
      $("#display_3").html(dato3);
      $("#display_4").html(dato4);
      $("#display_5").html(dato5);
      $("#display_6").html(dato6);
      $("#display_7").html(dato7);
      $("#display_9").html(dato9);
      $("#display_10").html(dato10);

    }

    </script>




    <script type="text/javascript">
      /* ********  Actualizacion dashboard cada 4 segundos, autoupdate ante cambios de estado (Reload para carga CSS ) ************ */
    //var estadoinicialquorum = "inicial";
    var cambioestado = 0;
      $(document).ready(function(){
    		setInterval(
    				function(){
            var idUsuario = <?php echo $id_usuario ?>;
            $.ajax(
              {
                //url:'seccion2.php',
                url:'seccion1.php',
                method:"POST",
                data:{
                    numero:idUsuario,
                }
              }).done(function(res){
                var datos=JSON.parse(res);
                var idato1 = datos.n_sesion_anio;
                var idato2 = datos.estado_quorum;
                var idato3 = datos.concejales_presentes;
                var idato4 = datos.pedido_palabra;
                var idato5 = datos.registro_votacion;
                var idato6 = datos.votacion_positiva;
                var idato7 = datos.votacion_negativa;
                var idato8 = datos.votacion_abstencion;
                var idato9 = datos.votacion_resultado;
                var idato10 = datos.usario;
                //var estadoinicialquorum = datos.estado_quorum;
                console.log('idato4:',datos.pedido_palabra);
                update_panel(idato1, idato2, idato3, idato4, idato5, idato6, idato7, idato9,idato10);
                //console.log('Quorum: cambio ', cambioestado );
                //console.log('Quorum: estado incial ', estadoinicialquorum );
                // comparo estado inicial quorum con actual, si cambia reinicio pagina paa carag de CSS
                if (idato2 == estadoinicialquorum) {
            			//console.log('cambio de estado: no ');
                  //ampm = 'PM';
            		} else {
            			//console.log('cambio de estado: si ');
                  location.reload();
            		}
                //alert(datos)
                //alert(res);


              });
    				},4000
    			);
    	});
    </script>




    <script>
      $(function () {
        /* jQueryKnob */

        $('.knob').knob({
          /*change : function (value) {
            //console.log("change : " + value);
          },
          release : function (value) {
            console.log("release : " + value);
          },
          cancel : function () {
            console.log("cancel : " + this.value);
          },*/
          draw: function () {

            // "tron" case
            if (this.$.data('skin') == 'tron') {

              var a   = this.angle(this.cv)  // Angle
              ,
              sa  = this.startAngle          // Previous start angle
              ,
              sat = this.startAngle         // Start angle
              ,
              ea                            // Previous end angle
              ,
              eat = sat + a                 // End angle
              ,
              r   = true

              this.g.lineWidth = this.lineWidth

              this.o.cursor
              && (sat = eat - 0.3)
              && (eat = eat + 0.3)

              if (this.o.displayPrevious) {
                ea = this.startAngle + this.angle(this.value)
                this.o.cursor
                && (sa = ea - 0.3)
                && (ea = ea + 0.3)
                this.g.beginPath()
                this.g.strokeStyle = this.previousColor
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                this.g.stroke()
              }

              this.g.beginPath()
              this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
              this.g.stroke()

              this.g.lineWidth = 2
              this.g.beginPath()
              this.g.strokeStyle = this.o.fgColor
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
              this.g.stroke()

              return false
            }
          }
        })
        /* END JQUERY KNOB */

        //INITIALIZE SPARKLINE CHARTS
        $('.sparkline').each(function () {
          var $this = $(this)
          $this.sparkline('html', $this.data())
        })

        /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
        drawDocSparklines()
        drawMouseSpeedDemo()

      })

      function drawDocSparklines() {

        // Bar + line composite charts
        $('#compositebar').sparkline('html', {
          type    : 'bar',
          barColor: '#aaf'
        })
        $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {
          composite: true,
          fillColor: false,
          lineColor: 'red'
        })


        // Line charts taking their values from the tag
        $('.sparkline-1').sparkline()

        // Larger line charts for the docs
        $('.largeline').sparkline('html',
        {
          type  : 'line',
          height: '2.5em',
          width : '4em'
        })

        // Customized line chart
        $('#linecustom').sparkline('html',
        {
          height      : '1.5em',
          width       : '8em',
          lineColor   : '#f00',
          fillColor   : '#ffa',
          minSpotColor: false,
          maxSpotColor: false,
          spotColor   : '#77f',
          spotRadius  : 3
        })

        // Bar charts using inline values
        $('.sparkbar').sparkline('html', { type: 'bar' })

        $('.barformat').sparkline([1, 3, 5, 3, 8], {
          type               : 'bar',
          tooltipFormat      : '{{value:levels}} - {{value}}',
          tooltipValueLookups: {
            levels: $.range_map({
              ':2' : 'Low',
              '3:6': 'Medium',
              '7:' : 'High'
            })
          }
        })

        // Tri-state charts using inline values
        $('.sparktristate').sparkline('html', { type: 'tristate' })
        $('.sparktristatecols').sparkline('html',
        {
          type    : 'tristate',
          colorMap: {
            '-2': '#fa7',
            '2' : '#44f'
          }
        })

        // Composite line charts, the second using values supplied via javascript
        $('#compositeline').sparkline('html', {
          fillColor     : false,
          changeRangeMin: 0,
          chartRangeMax : 10
        })
        $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {
          composite     : true,
          fillColor     : false,
          lineColor     : 'red',
          changeRangeMin: 0,
          chartRangeMax : 10
        })

        // Line charts with normal range marker
        $('#normalline').sparkline('html',
        {
          fillColor     : false,
          normalRangeMin: -1,
          normalRangeMax: 8
        })
        $('#normalExample').sparkline('html',
        {
          fillColor       : false,
          normalRangeMin  : 80,
          normalRangeMax  : 95,
          normalRangeColor: '#4f4'
        })

        // Discrete charts
        $('.discrete1').sparkline('html',
        {
          type     : 'discrete',
          lineColor: 'blue',
          xwidth   : 18
        })
        $('#discrete2').sparkline('html',
        {
          type          : 'discrete',
          lineColor     : 'blue',
          thresholdColor: 'red',
          thresholdValue: 4
        })

        // Bullet charts
        $('.sparkbullet').sparkline('html', { type: 'bullet' })

        // Pie charts
        $('.sparkpie').sparkline('html', {
          type  : 'pie',
          height: '1.0em'
        })

        // Box plots
        $('.sparkboxplot').sparkline('html', { type: 'box' })
        $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
        {
          type        : 'box',
          raw         : true,
          showOutliers: true,
          target      : 6
        })

        // Box plot with specific field order
        $('.boxfieldorder').sparkline('html', {
          type                     : 'box',
          tooltipFormatFieldlist   : ['med', 'lq', 'uq'],
          tooltipFormatFieldlistKey: 'field'
        })

        // click event demo sparkline
        $('.clickdemo').sparkline()
        $('.clickdemo').bind('sparklineClick', function (ev) {
          var sparkline = ev.sparklines[0],
          region    = sparkline.getCurrentRegionFields()
          value         = region.y
          alert('Clicked on x=' + region.x + ' y=' + region.y)
        })

        // mouseover event demo sparkline
        $('.mouseoverdemo').sparkline()
        $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
          var sparkline = ev.sparklines[0],
          region    = sparkline.getCurrentRegionFields()
          value         = region.y
          $('.mouseoverregion').text('x=' + region.x + ' y=' + region.y)
        }).bind('mouseleave', function () {
          $('.mouseoverregion').text('')
        })
      }

      /**
      ** Draw the little mouse speed animated graph
      ** This just attaches a handler to the mousemove event to see
      ** (roughly) how far the mouse has moved
      ** and then updates the display a couple of times a second via
      ** setTimeout()
      **/
      function drawMouseSpeedDemo() {
        var mrefreshinterval = 500 // update display every 500ms
        var lastmousex       = -1
        var lastmousey       = -1
        var lastmousetime
        var mousetravel      = 0
        var mpoints          = []
        var mpoints_max      = 30
        $('html').mousemove(function (e) {
          var mousex = e.pageX
          var mousey = e.pageY
          if (lastmousex > -1) {
            mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey))
          }
          lastmousex = mousex
          lastmousey = mousey
        })
        var mdraw = function () {
          var md      = new Date()
          var timenow = md.getTime()
          if (lastmousetime && lastmousetime != timenow) {
            var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000)
            mpoints.push(pps)
            if (mpoints.length > mpoints_max) {
              mpoints.splice(0, 1)
            }
            mousetravel = 0
            $('#mousespeed').sparkline(mpoints, {
              width        : mpoints.length * 2,
              tooltipSuffix: ' pixels per second'
            })
          }
          lastmousetime = timenow
          setTimeout(mdraw, mrefreshinterval)
        }
        // We could use setInterval instead, but I prefer to do it this way
        setTimeout(mdraw, mrefreshinterval);
      }
    </script>
  </body>
  </html>
