<?php
// Calculo de Quorum ,mitad +1
include("conexion2.php");
$concejales_presentes=0;
//$concejales=4;
$concejales=24;
$quorum_necesario=($concejales/2)+1;

for ($i=1;$i<($concejales+1);$i++){
$id = $i;
//Consulto si votaron todos en base al registro de carga de votacion
$resultados3 = mysqli_query($datos_conexion,"SELECT * FROM estado_votacion WHERE id_estado_votacion ='$id' ");
while($consulta3 = mysqli_fetch_array($resultados3))
  {
    $concejales_presentes=$concejales_presentes+$consulta3['presente'];
    if ($consulta3['id_usuario']==5){
      $estado_voto_presidente_db=$consulta3['registro_votacion'];
    }
  }
}

//echo '$concejales_presentes:'.$concejales_presentes;
//echo '<br>';
//echo '$quorum_necesario:'.$quorum_necesario;*/

$estado_quorum="";


if ($concejales_presentes >= $quorum_necesario){
    $estado_quorum="si";

} else {
$estado_quorum="no";
}

//echo 'Estado quorum: '.$estado_quorum;

?>
