  <?PHP
  include("conexion2.php");

$codigo=$_GET['cod3'];//usuario
$codigo2=$_GET['cod4'];//tipo de voto 1 positivo, 2 negativo, 3 abstencion

$tabla_db1 = "estado_votacion";
$id_usuario=$codigo;
//$registro_votacion=1;
$votacion_positiva=0;
$votacion_negativa=0;
$votacion_abstencion=0;
// votos Jouglar = 14, Ghigliani = 8,  Barrionuevo=2
if ($codigo2==1){

  switch ($codigo) {
    case "5":
            $votacion_positiva=1 ;
            break;
    case "8":
            $votacion_positiva=14 ;
            break;
    case "9":
            $votacion_positiva=8 ;
            break;
    case "10":
            $votacion_positiva=2 ;
            break;
          }
}
else {
  if ($codigo2==2){


  switch ($codigo) {
    case "5":
            $votacion_negativa=1 ;
            break;
    case "8":
            $votacion_negativa=14 ;
            break;
    case "9":
            $votacion_negativa=8 ;
            break;
    case "10":
            $votacion_negativa=2 ;
            break;
}
}

else{
  switch ($codigo) {
    case "5":
            $votacion_abstencion=1 ;
            break;
    case "8":
            $votacion_abstencion=14 ;
            break;
    case "9":
            $votacion_abstencion=8 ;
            break;
    case "10":
            $votacion_abstencion=2 ;
            break;
}
}
}

// codigo 1 voto por concejal
/*switch ($codigo2) {
  case "1":
  if ($id_usuario ==5 ) {
    $votacion_positiva=2 ;
  }
  else {
    $votacion_positiva=1;
  }

    break;
  case "2":
    $votacion_negativa=1;
    break;
  case "3":
    $votacion_abstencion=1;
    break;
}*/

switch ($codigo) {
  case "5":
          $registro_votacion=1 ;
          break;
  case "8":
          $registro_votacion=14 ;
          break;
  case "9":
          $registro_votacion=8 ;
          break;
  case "10":
        $registro_votacion=2 ;
          break;
}






//$votacion_positiva=1;
$_UPDATE_SQL="UPDATE $tabla_db1 Set
registro_votacion='$registro_votacion',
votacion_positiva='$votacion_positiva',
votacion_negativa='$votacion_negativa',
votacion_abstencion='$votacion_abstencion'
WHERE id_usuario ='$id_usuario'";
mysqli_query($datos_conexion,$_UPDATE_SQL);


echo $codigo;
echo $codigo2;
echo $votacion_positiva;
echo $votacion_negativa;
echo $votacion_abstencion;

if ($id_usuario ==5 ) {
  header("location: presidente.php");
}
else {
  header("location: concejal.php");
}

//header("location: concejal.php");

?>
