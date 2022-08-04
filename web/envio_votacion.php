<?php
$codigo=$_GET['cod'];
//echo $codigo;

include("conexion2.php");

mysqli_query($datos_conexion, "UPDATE expediente SET estado_tratamiento = 2 WHERE id_expediente=$codigo");

header("location: presidente.php");
//header("location: mostrar_contenido.php");

?>
