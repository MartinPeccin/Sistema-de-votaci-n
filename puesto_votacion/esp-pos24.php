<?php
//tomo variables de POST
$usuariodb = $_POST['user'];// db user
$clavedb = $_POST['pass'];// dp pass
$id_usuario = $_POST['id_user']; // id usuario registrado

//include("abrir_conexion.php");

$host = "localhost";    // sera el valor de nuestra BD
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
									$sql = "SELECT * FROM sistema_votacion WHERE id_sistema_votacion='$id_estado' "; //verifico si existe tarjeta RFID registrada con usuario
									$resultado = mysqli_query($conexion, $sql);
									$num = $resultado->num_rows;
																if ($num>0){	// si existe usuario
																	$row = $resultado->fetch_assoc(); 				 //Asigno la peticion SQL a la variable arreglo $Resultado
																	$habilitar_voto = $row['estado_sistema'];  // asigno valor Apellido usuario
																	//$estado = 1;														 // Seteo valor de login al sistema de votacion (luego lo lee el dispositivo de votacion )
																	//$id_usuario=$row['id_usuario'];					// asigno id_usuario

																	/*$tabla_db = "estado_votacion";
																	$presente=1;
																	$_UPDATE_SQL="UPDATE $tabla_db Set
																	presente='$presente'
																	WHERE id_usuario ='$id_usuario'";
																	mysqli_query($conexion,$_UPDATE_SQL);*/


																} else {
																	//$estado = 0;

																}

																$resultados2 = mysqli_query($conexion,"SELECT * FROM estado_votacion WHERE id_usuario ='$id_usuario' ");
																while($consulta2 = mysqli_fetch_array($resultados2))
																  {
																  $registro_voto=$consulta2['registro_votacion'];
																  //$registro2=$consulta2['registro_sistema'];
																  }





									//$variablep=1;
									//echo intval("$estadovoto"); // si esta habilitada la votacion
									//echo $estadovoto;//
									//echo $elemento1;
									echo $habilitar_voto; //elemento 1 http request
									echo ",";
									echo $registro_voto; //elemento 2 http request
									//echo intval("$estado_voto_concejal"); // si voto el concejal
									//echo intval("$variablep"); //
									//echo $variablep;//
									//echo $estadovoto2;
									echo ",";
									echo "Var3"; //elemento 3 http request
									//echo $estadovoto2;// nombre usuario
									echo ",";
									//echo $variablep2;// tipo usuario
									echo "Var4"; //elemento 4 http request


					}



?>
