<?PHP
session_start();
$nombre = $_SESSION['nombre'] ;
$tipo_usuario = $_SESSION['tipo_usuario'] ;
$id_usuario = $_SESSION['id_usuario'] ;

//include("conexion2.php");
include("conexion2.php");

$fecha_ingreso = $_POST['fecha_ingreso'];
$numero_expediente = $_POST['numero_expediente'];
$anio_expediente = $_POST['anio_expediente'];
$fecha_tratamiento = $_POST['fecha_tratamiento'];
$orden_tratamiento  = $_POST['orden_tratamiento'];
$tipo_expediente = $_POST['tipo_expediente'];
$titulo_expediente = $_POST['titulo_expediente'];
$descripcion_expediente = $_POST['descripcion_expediente'];
$bloque_autor = $_POST['bloque_autor'];
$texto= $_POST['texto'];

//$originalDate = "2017-03-08";
//$newDate = date("d/m/Y", strtotime($originalDate));
$date = str_replace('/', '-', $fecha_ingreso);
$newDate1= date('Y-m-d', strtotime($date));
$date2 = str_replace('/', '-', $fecha_tratamiento);
$newDate2= date('Y-m-d', strtotime($date2));
//$newDate1 = date("Y-d-m", strtotime($fecha_ingreso));
//$newDate2 = date("Y-d-m", strtotime($fecha_tratamiento));

//$_INSERT_SQL2= "INSERT INTO `expediente` (`id_expediente`,`orden_expediente`,`n_expediente`,`anio_expediente`, `tipo_expediente`, `descripcion_expediente`,`fecha_inicio` ,`fecha_tratamiento`,`fecha_votacion`,`id_registro_votacion_g`,`resultado_votacion`) VALUES ((NULL,NULL,'$numero_expediente', '$anio_expediente', '$tipo_expediente','$descripcion_expediente','$newDate1','$newDate2', NULL,NULL,NULL,NULL) ";
//mysqli_query($datos_conexion,$_INSERT_SQL2);

$_INSERT_SQL3="INSERT INTO `expediente` (`id_expediente`, `orden_expediente`, `n_expediente`, `anio_expediente`, `tipo_expediente`, `descripcion_expediente`, `fecha_inicio`, `fecha_tratamiento`, `fecha_votacion`, `estado_tratamiento`, `id_registro_votacion_g`, `resultado_votacion`) VALUES (NULL, '$orden_tratamiento', '$numero_expediente', '$anio_expediente', '$tipo_expediente', '$descripcion_expediente', '$newDate1', '$newDate2', NULL, 1, NULL, NULL)";
//$_INSERT_SQL3="INSERT INTO `expediente` (`id_expediente`, `orden_expediente`, `n_expediente`, `anio_expediente`, `tipo_expediente`, `descripcion_expediente`, `fecha_inicio`, `fecha_tratamiento`, `fecha_votacion`, `estado_tratamiento`, `id_registro_votacion_g`, `resultado_votacion`) VALUES (NULL, NULL, '70', '2021', 'Resolucion', 'vfdvvdvdfvdf', '2021-04-20', '2021-06-13', NULL, NULL, NULL, NULL)";
mysqli_query($datos_conexion,$_INSERT_SQL3);


$resultados = mysqli_query($datos_conexion,"SELECT * FROM expediente WHERE id_expediente=(SELECT max(id_expediente) FROM expediente) ");
while($consulta = mysqli_fetch_array($resultados))
{
	$id_expediente=$consulta['id_expediente'];
}

$_INSERT_SQL4="INSERT INTO `expediente_detalle` (`id_expediente_detalle`, `id_expediente`, `titulo_expediente`, `autor_expediente`, `cuerpo_expediente`) VALUES (NULL,'$id_expediente', '$titulo_expediente', '$bloque_autor', '$texto')";
mysqli_query($datos_conexion,$_INSERT_SQL4);


/*echo "id_expediente: ";
echo $id_expediente;
echo "<br>";
echo "Fecha ingreso: ";
echo $newDate1;
echo "<br>";
echo "Numero Expediente: ";
echo $numero_expediente;
echo "<br>";
echo "Año Expediente: ";
echo $anio_expediente;
echo "<br>";
echo "Fecha tratamiento: ";
echo $fecha_tratamiento;
echo "<br>";
echo $newDate2;
echo "<br>";
echo "Tipo Expediente: ";
echo $tipo_expediente;
echo "<br>";
echo "Titulo Expediente: ";
echo $titulo_expediente;
echo "<br>";
echo "Descripcion Expediente: ";
echo $descripcion_expediente;
echo "<br>";
echo "Bloque Autor: ";
echo $bloque_autor;
echo "<br>";
echo "Texto: ";
echo $texto;
echo "<br>";*/
if ($tipo_usuario == "presidente"){
  $link="presidente_e.php";
}
else{
$link="concejal.php";

}

header('Location:' . $link);
//header("location: presidente.php");

?>
