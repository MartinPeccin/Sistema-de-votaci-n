<?php
//Este modulo guarda en BD el resultado de votacion en curso correspondiente al usuario
//tomo variables de POST para verifica tarjeta RFID, usuario
// informacion IN : USER ( user base de datos), cod3 ( id_usuario),  cod4(votacion positiva o negativa)
///OUT informacion: no envia info al modulo de votacion
/// Cambios en BD: se actualiza el valor de la tabla estado_votacion los campos 	registro_votacion='$registro_votacion',
//	votacion_positiva='$votacion_positiva',
//	votacion_negativa='$votacion_negativa',
//	votacion_abstencion='$votacion_abstencion'
//Correspondientes al id_usuario

$usuariodb2 = $_POST['user'];// db user DB (a futuro permitira fijar restricciones acceso tablas)
$id_usuario = $_POST['cod3'];// id_usuario
$codigo2 = $_POST['cod4']; // valor votacion

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
//$habilitar_voto = 0;

//error_reporting(0); //No me muestra errores
$votacion_positiva=0;
$votacion_negativa=0;
$votacion_abstencion=0;
//$usuario

//$usuariodb = "root";
//$clavedb = "raspy2019";
$usuariodb = "xxxxxx";
$clavedb = "xxxxx";


// COnsignacion Voto, OBSERVACION: asignacion de bloque completo por presidente
//Fabiola (id:5)=1, Jouglar (id:8)= 13, Ghigliani(id:9) = 8,  Barrionuevo(id:10)=2

$votacion=0;
switch ($id_usuario) {
  case "5":
          $votacion=1 ;
          break;
  case "8":
          $votacion=14 ;
          break;
  case "9":
          $votacion=8 ;
          break;
  case "10":
          $votacion=2 ;
          break;
        }


$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);


if ($conexion->connect_errno) {
	echo "Nuestro sitio experimenta fallos....";
	exit();
}else {
// asigno valor a la votacion en funcion de la eleccion del usuario
	if ($codigo2==1){

	           $votacion_positiva=$votacion ;

	}
	else {
	  if ($codigo2==2){
	            $votacion_negativa=$votacion ;
	}


	}
	//$votacion_positiva=1 ;
	//$registro_votacion=1;
	$registro_votacion=$votacion;
	$tabla_db = "estado_votacion";
	//$presente=1;
  // envio el valor de votacion a la Base de datos
	$_UPDATE_SQL="UPDATE $tabla_db Set
	registro_votacion='$registro_votacion',
	votacion_positiva='$votacion_positiva',
	votacion_negativa='$votacion_negativa',
	votacion_abstencion='$votacion_abstencion'
	WHERE id_usuario ='$id_usuario'";
	mysqli_query($conexion,$_UPDATE_SQL);




	}
// por ahora envio informacion de devolucion sin uso
	echo "Var2"; //sin uso
	 //elemento 1 http request
	echo ",";
	echo "Var2"; //elemento 2 http request sin uso

	echo ",";
	echo "Var3"; //elemento 3 http request sin uso
	//echo $estadovoto2;// nombre usuario
	echo ",";

	echo "Var4"; //elemento 4 http request sin uso






?>
