<?php
//tomo variables de POST para verifica tarjeta RFID, usuario
// informacion IN : USER ( user base de datos), PASS ( pw base de datos), TAG (UID tarjeta RFID)
///OUT informacion:  $apellido_db(apellido usuario registrado), $estado (si RFID existe en BD, toma valor 1, sino esta en BD toma valor 0)
/// Cambios en BD: si RFID existe se da presente al usuario en el regsitro de BD (table "estado_votacion")

$usuariodb = $_POST['user'];// db user
$clavedb = $_POST['pass'];// dp pass
$tag = $_POST['tag']; // tag tarjeta RFID

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

//error_reporting(0); //No me muestra errores

$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos); // conexion DB


if ($conexion->connect_errno) {
	echo "Nuestro sitio experimenta fallos....";
	exit();
}else {
	//echo "Ok conexion";
	$sql = "SELECT * FROM usuarios WHERE ip_dispositivo='$tag' "; //verifico si existe tarjeta RFID registrada con usuario
	$resultado = mysqli_query($conexion, $sql);
	$num = $resultado->num_rows;
	if ($num>0){	// si existe usuario
		$row = $resultado->fetch_assoc(); 				 //Asigno la peticion SQL a la variable arreglo $Resultado
		$apellido_db = $row['apellido_usuario'];  // asigno valor Apellido usuario
		$estado = 1;														 // Seteo valor de login al sistema de votacion (luego lo lee el dispositivo de votacion )
		$id_usuario=$row['id_usuario'];					// asigno id_usuario

		$tabla_db = "estado_votacion";

				// COnsignacion de Presencia o retiro de sesión, OBSERVACION: asignacion de bloque completo por presidente
		//Fabiola (id:5)=1, Jouglar (id:8)= 13, Ghigliani(id:9) = 8,  Barrionuevo(id:10)=2


		switch ($id_usuario) {
		  case "5":
		          $presente=1 ;
		          break;
		  case "8":
		          $presente=13 ;
		          break;
		  case "9":
		          $presente=8 ;
		          break;
		  case "10":
		          $presente=2 ;
		          break;
		        }

		//$presente=1;
		// Actualizo presente del concejal
		$_UPDATE_SQL="UPDATE $tabla_db Set
		presente='$presente'
		WHERE id_usuario ='$id_usuario'";
		mysqli_query($conexion,$_UPDATE_SQL);


	} else {
		$estado = 0;

	}



	//$variablep=1;
	//echo intval("$estadovoto"); // si esta habilitada la votacion
	//echo $estadovoto;//
	//echo $elemento1;
	echo $apellido_db; //elemento 1 http request
	echo ",";
	echo $estado; //elemento 2 http request
	//echo intval("$estado_voto_concejal"); // si voto el concejal
	//echo intval("$variablep"); //
	//echo $variablep;//
	//echo $estadovoto2;
	echo ",";
	echo $id_usuario; //elemento 3 http request
	//echo $estadovoto2;// nombre usuario
	echo ",";
	//echo $variablep2;// tipo usuario
	echo "Var4"; //elemento 4 http request



}




?>
