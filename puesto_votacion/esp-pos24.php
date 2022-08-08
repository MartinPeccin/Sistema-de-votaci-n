<?php
// COnsulto a Base de datos para saber si la votacion esta habilitada y si el usuario ya voto
//tomo variables de POST
// informacion IN : USER ( user base de datos), PASS ( pw base de datos), id_user (ID usuario)
///OUT informacion:  $habilitar_voto(verifico si la votacion esta habilitada), $registro_voto (verifico si el usaurio realizao votacion)


$usuariodb = $_POST['user'];// db user
$clavedb = $_POST['pass'];// dp pass
$id_usuario = $_POST['id_user']; // id usuario registrado

//include("abrir_conexion.php");

$host = "localhost";    // server
//$basededatos = "Propietario";    // sera el valor de nuestra BD
$basededatos = "votoHCD";    // sera el valor de nuestra BD
//$usuariodb = "root";    // sera el valor de nuestra BD
//$clavedb = "raspy2019";    // sera el valor de nuestra BD
//$usuariodb = "c1";
//$clavedb = "c1hcd";
//Lista de Tablas
$tabla_db1 = "sistema_votacion"; 	   // tabla de sistema
$table_db3 = "estado_votacion"; // table de concejales
$tabla_db2 = "usuarios"; // tabla usuarios
$estado = 0;
$habilitar_voto = 0;
$registro_voto  = 0;

//error_reporting(0); //No me muestra errores

$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);


if ($conexion->connect_errno) {
	echo "Nuestro sitio experimenta fallos....";
	exit();
	}
	else {
									//echo "Ok conexion";
									$id_estado=2;
									$sql = "SELECT * FROM sistema_votacion WHERE id_sistema_votacion='$id_estado' "; //verifico esta habilitado la votacion
									$resultado = mysqli_query($conexion, $sql);
									$num = $resultado->num_rows;
																if ($num>0){	// existe busqueda
																	$row = $resultado->fetch_assoc(); 				 //Asigno la peticion SQL a la variable arreglo $Resultado
																	$habilitar_voto = $row['estado_sistema'];  // asigno valor estado de sistema correspondiente a Funcion de sistema=habilitar voto

																} else {
																	//$estado = 0;

																}
																// verifico si el usuario realizo la votacion
																$resultados2 = mysqli_query($conexion,"SELECT * FROM estado_votacion WHERE id_usuario ='$id_usuario' ");
																while($consulta2 = mysqli_fetch_array($resultados2))
																  {
																  $registro_voto=$consulta2['registro_votacion'];
																  }






									echo $habilitar_voto; //elemento 1 http request - verifico si la votacion esta habilitada
									echo ",";
									echo $registro_voto; //elemento 2 http request - verifico si el usaurio realizao votacion

									echo ",";
									echo "Var3"; //elemento 3 http request - variable sin uso

									echo ",";

									echo "Var4"; //elemento 4 http request - variable sin uso


					}



?>
