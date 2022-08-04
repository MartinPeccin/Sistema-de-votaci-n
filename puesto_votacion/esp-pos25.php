<?php
//tomo variables de POST
$usuariodb2 = $_POST['user'];// db user
$id_usuario = $_POST['cod3'];// dp pass
$codigo2 = $_POST['cod4']; // id usuario registrado

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
//$habilitar_voto = 0;

//error_reporting(0); //No me muestra errores
$votacion_positiva=0;
$votacion_negativa=0;
$votacion_abstencion=0;
//$usuario

//$usuariodb = "root";
//$clavedb = "raspy2019";
$usuariodb = "martin";
$clavedb = "mar301378";


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
	$_UPDATE_SQL="UPDATE $tabla_db Set
	registro_votacion='$registro_votacion',
	votacion_positiva='$votacion_positiva',
	votacion_negativa='$votacion_negativa',
	votacion_abstencion='$votacion_abstencion'
	WHERE id_usuario ='$id_usuario'";
	mysqli_query($conexion,$_UPDATE_SQL);




	}


	//$variablep=1;
	//echo intval("$estadovoto"); // si esta habilitada la votacion
	//echo $estadovoto;//
	echo "Var2";
	//echo $habilitar_voto; //elemento 1 http request
	echo ",";
	echo "Var2"; //elemento 2 http request
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






?>
