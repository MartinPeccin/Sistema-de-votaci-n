<?PHP
include("conexion2.php");
/*session_start();
$nombre = $_SESSION['nombre'] ;
$tipo_usuario = $_SESSION['tipo_usuario'] ;
$id_usuario = $_SESSION['id_usuario'] ;*/

//echo $id_usuario
$id_usuario = $_GET['cod3'];//usuario
$id_destino = $_GET['cod4'];




//verifico estado variable cuarto intermedio
$resultados2 = mysqli_query($datos_conexion,"SELECT * FROM estado_votacion WHERE id_usuario ='$id_usuario' ");
while($consulta2 = mysqli_fetch_array($resultados2))
  {
  $pedido=$consulta2['pedido_palabra'];
  //$registro2=$consulta2['registro_sistema'];
  }
  //echo $pedido;
  //echo "<br>";

  if ($pedido == 0) {

    $tabla_db1 = "estado_votacion";
    //$id_usuario=;
    $dia = date("Y-m-d H:i:s");
    $dia2 = date("Y-m-d");

    $pedido_palabra=1;
    //$registro_sistema=1;
    //echo $pedido;
    //echo "<br>";
    $_UPDATE_SQL="UPDATE $tabla_db1 Set
    pedido_palabra='$pedido_palabra',
    fecha_palabra='$dia2',
    orden_palabra='$dia'
    WHERE id_usuario ='$id_usuario'";
    mysqli_query($datos_conexion,$_UPDATE_SQL);
    }
    else {
      $tabla_db1 = "estado_votacion";
      //$id_usuario=;
      $pedido_palabra=0;
      //$registro_sistema=1;
      $_UPDATE_SQL="UPDATE $tabla_db1 Set
      pedido_palabra='$pedido_palabra'
      WHERE id_usuario ='$id_usuario'";
      mysqli_query($datos_conexion,$_UPDATE_SQL);
    }
    //echo $pedido_palabra;
/*
    if ($id_destino == 1){
      header("location: presidente_pedidopalabra.php");
    }
    else{
    header("location: concejal.php");

  }*/

    //header("location: concejal.php");

    ?>
