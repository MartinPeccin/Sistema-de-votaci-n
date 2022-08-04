
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HCD Bahia Blanca | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>UNS-HCD</b>Bahía Blanca</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Logearse al sistema de votación</p>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="DNI" name="dni">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          <!--  <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recordar sesión
              </label>
            </div>-->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>

          <!-- /.col -->
        </div>

      </form>

      <?PHP
      session_start();
      require "conexion2.php";
      if($_POST){
              $dni = $_POST['dni'];
              $password = $_POST['password'];

              $sql = "SELECT id_usuario, dni_usuario, password_usuario, tipo_usuario, nombre_usuario, apellido_usuario, pagina FROM usuarios WHERE dni_usuario='$dni' ";
              $resultado = mysqli_query($datos_conexion, $sql);
              $num = $resultado->num_rows;
              if ($num>0){
                $row = $resultado->fetch_assoc();
                $password_db = $row['password_usuario'];
                $page =  $row['pagina'];
                $pagina= $page.".php";
                //echo $page;
                //echo <br>;
                //echo $pagina;

                  if ($password_db == $password){

                    $_SESSION['nombre'] = $row['nombre_usuario'];
                    $_SESSION['apellido'] = $row['apellido_usuario'];
                    $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
                    $_SESSION['id_usuario'] = $row['id_usuario'];

                    //header("Location: index.php");
                    header("Location: $pagina");
                  }else{
                    ?>
                    <div class="social-auth-links text-center">

                      <a href="#" class="btn btn-block btn-danger">
                        <i class="fab mr-2"></i>
                        Contraseña incorrecta
                      </a>
                    </div>
<?php
                    //echo "La contrasena no coincide";
                  }
              } else {
                ?>
                <div class="social-auth-links text-center">

                  <a href="#" class="btn btn-block btn-danger">
                    <i class="fab mr-2"></i>
                    El usuario no existe
                  </a>
                </div>
<?php
}

      }

      ?>


    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
