
<?php
//-----CARGO SESSION --------------------------------------------------------------
//header("Refresh: 10");
session_start();
$nombre = $_SESSION['nombre'] ;
$tipo_usuario = $_SESSION['tipo_usuario'] ;
$id_usuario = $_SESSION['id_usuario'] ;

if ($tipo_usuario != "presidente"){
  session_destroy();

  header ("Location: login.php");

}

include("conexion2.php");
$codigo=$_GET['cod'];
//echo $codigo;

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
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">


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
        <img src="dist/img/Compagnoni-150x150.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Fernando Compagnoni</a>
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
              <a href="#" class="nav-link ">
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
                  <a href="presidente_e.php" class="nav-link">
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
                  <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ingresar Exp.</p>
                  </a>
                </li>

              </ul>

            </li>




          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Simple Link
              <span class="right badge badge-danger">New</span>
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
                <span class="info-box-number"><?php echo $suma_pedido_palabra;?> </span>
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
                <span class="info-box-number"> <?php echo $concejales_presentes;?> <?php echo $quorum;?>  </span>
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
            <!-- /.row -->

            <!-- Obtengo la info de expediente---->

            <?php

            $sql="SELECT * from expediente WHERE id_expediente=$codigo ";
            $result=mysqli_query($datos_conexion,$sql);
            while($mostrar=mysqli_fetch_array($result)){
            $n_expediente=$mostrar['n_expediente'];
            $fecha_ingreso=$mostrar['fecha_inicio'];

          }

            ?>


          <div class="row">
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">General</h3>


                </div>

                <div class="card-body">
                  <form action="#" >

                    <div class="form-group">
                      <label>Fecha Ingreso:</label>

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <!-- <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required name="fecha_ingreso">hhh-->
                        <text type="text" class="form-control" > <?php echo $fecha_ingreso;?></text>
                      </div>

                    </div>



                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Expediente</label>
                          <text type="text" class="form-control" ><?php echo $n_expediente; ?></text>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Año</label>
                          <input type="number" min="1950" max="2099" class="form-control" placeholder="XXXX..." name="anio_expediente" required>
                        </div>
                      </div>
                    </div>




                    <div class="form-group">
                      <label>Fecha tratamiento:</label>

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required name="fecha_tratamiento" >
                      </div>
                      <!-- /.input group -->
                    </div>





                    <div class="form-group">
                      <label>Tipo Expediente</label>
                      <select class="custom-select" name="tipo_expediente" required>
                        <option selected disabled>Seleccionar</option>
                        <option>Ordenanza</option>
                        <option>Resolución</option>
                        <option>Minuta</option>
                        <option>Decreto</option>

                      </select>
                    </div>

                    <div class="form-group">
                      <label for="inputName">Titulo Expediente</label>
                      <input type="text" id="inputName" class="form-control" name="titulo_expediente" required>
                    </div>
                    <div class="form-group">
                      <label for="inputName1">Descripcion breve</label>
                      <input type="text" id="inputName1" class="form-control" placeholder="50 caracteres ..." name="descripcion_expediente" required>
                    </div>

                    <div class="form-group">
                      <label>Bloque</label>
                      <select class="custom-select" name="bloque_autor" required>
                        <option selected disabled>Seleccionar</option>
                        <option>Juntos por el cambio</option>
                        <option>Frente de todos</option>
                        <option>UCR Illia</option>

                      </select>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <div class="col-md-6">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Testimonio</h3>


                  </div>
                  <div class="card-body">





                    <!-- /.card-header -->



                    <div class="form-group">
                      <textarea id="compose-textarea" class="form-control" style="height: 300px" name="texto" >
                        <h1><u>Titulo</u></h1>
                        <h4>Subtitulo</h4>
                        <p> <?php echo $texto_proyecto; ?></p>
                        <ul>
                          <li>Lista item uno</li>
                          <li>Lista item dos</li>
                          <li>Lista item tres</li>
                          <li>Lista item cuatro</li>
                        </ul>
                      </textarea>
                    </div>


                    <!-- /.card-body -->



                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>

              <div class="col-12">

                <div class="form-group">
                  <div class="float-right">
                    <!--<button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>-->
                    <button type="submit" class="btn btn-primary float-right"><i class="far fa-envelope"></i> Enviar</button>
                  </div>
                  <div class="float-left">
                    <button type="reset" class="btn btn-default float-left"><i class="fas fa-times"></i> Limpiar</button>
                  </div>
                </div>



                <!--<a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create new Porject" class="btn btn-success float-right">-->
              </div>
              <br>
              <br>
            </form>








        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
        </div>

  </div>

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

    <!-- Bootstrap 4 -->

    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>


    <script src="plugins/summernote/summernote-bs4.min.js"></script>

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
    <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });

      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });

    })
    </script>



    <script>
    $(function () {
      //Add text editor
      $('#compose-textarea').summernote({
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['view', ['fullscreen', 'codeview']],
        ]
      })
    })
  </script>


  </body>
  </html>
