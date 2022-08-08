<?php
//Este Modulo activa o desactiva el pedido de palabra del concejal, dejando registro del DATE(Y-m-d H:i:s) de la solicitud
//tomo variables de POST
// informacion IN : USER ( user base de datos), cod3 ( id_usuario)
///OUT informacion: no envia info al modulo de votacion
/// Cambios en BD: se actualiza el valor de la tabla estado_votacion los campos pedido_palabra y orden_palabra
$usuariodb2 = $_POST['user'];// db user
$id_usuario = $_POST['cod3'];// dp pass
//$codigo2 = $_POST['cod4']; // id usuario registrado

//include("conexion2.php");


$host = "localhost";    // sera el valor de nuestra BD
//$basededatos = "Propietario";    // sera el valor de nuestra BD
$basededatos = "votoHCD";    // sera el valor de nuestra BD
$usuariodb = "xxxxxx";
$clavedb = "xxxxxxx";

$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);


if ($conexion->connect_errno) {
	echo "Nuestro sitio experimenta fallos....";
	exit();
}

//verifico estado variable pedido de la palabra del usuario
$resultados2 = mysqli_query($conexion,"SELECT * FROM estado_votacion WHERE id_usuario ='$id_usuario' ");
while($consulta2 = mysqli_fetch_array($resultados2))
  {
  $pedido=$consulta2['pedido_palabra'];
  }

// si el usuario no registra pedido de palabra, se actualiza el valor en BD tabla estado_votacion campo pedido_palabra

  if ($pedido == 0) {

    $tabla_db1 = "estado_votacion";
    //$id_usuario=;
    $dia = date("Y-m-d H:i:s");
    $dia2 = date("Y-m-d");

    $pedido_palabra=1; // asigno valor uno a pedido de la palabra

    $_UPDATE_SQL="UPDATE $tabla_db1 Set
    pedido_palabra='$pedido_palabra',
    fecha_palabra='$dia2',
    orden_palabra='$dia'
    WHERE id_usuario ='$id_usuario'";
    mysqli_query($conexion,$_UPDATE_SQL);
    }
    // si el pedido de la palabra esta solicitado el sistema actualizo su estado desabilitando el pedido de palabra
    else {
      $tabla_db1 = "estado_votacion";
      //$id_usuario=;
      $pedido_palabra=0;
      //$registro_sistema=1;
      $_UPDATE_SQL="UPDATE $tabla_db1 Set
      pedido_palabra='$pedido_palabra'
      WHERE id_usuario ='$id_usuario'";
      mysqli_query($conexion,$_UPDATE_SQL);
    }

	echo "Var2";
	//elemento 1 http request - sin uso
	echo ",";
	echo "Var2"; //elemento 2 http request	- sin uso
	echo ",";
	echo "Var3"; //elemento 3 http request - sin uso
	echo ",";
	echo "Var4"; //elemento 4 http request - sin uso






?>
