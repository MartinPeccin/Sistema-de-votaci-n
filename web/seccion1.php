<?php
include("conexion2.php");
$num=$_POST['numero'];

// Obtengo numero de sesion y año
$resultados = mysqli_query($datos_conexion,"SELECT * FROM registro_sesion WHERE id_registro_sesion=(SELECT max(id_registro_sesion) FROM registro_sesion) ");
while($consulta = mysqli_fetch_array($resultados))
{
  $n_sesion_anio=$consulta['n_sesion_anio'];
  $sesion_anio=$consulta['anio'];
}

// busco apellido usuario del parametro enviado por la peticion $num
$resultados2 = mysqli_query($datos_conexion,"SELECT * FROM usuarios WHERE id_usuario=$num ");
while($consulta2 = mysqli_fetch_array($resultados2))
{
  $usuario=$consulta2['apellido_usuario'];
}

// asigno valores a variables, RAMDOM 1 y 2, 3 usuario
$valor1=rand(1,800);
$valor2=rand(1,800);
$valor3=$usuario;


// calculo quorum

$concejales_presentes=0; // reseteo contador de concejales
$pedido_palabra=0; //// reseteo contador de pedido palabra
$concejales=24; // numero de concejales activos (Habria que tomarlo de la BD)
$quorum_necesario=($concejales/2)+1; // calculo quorum
$registro_votacion=0;// inicializo contador de votacion
$votacion_positiva=0;// inicializo contador de votacion votacion_positiva
$votacion_negativa=0;// inicializo contador de votacion votacion_negativa
$votacion_abstencion=0;// inicializo contador de votacion abstencion


for ($i=1;$i<($concejales+1);$i++){
$id = $i;
$resultado="";
//Consulto si votaron todos en base al registro de carga de votacion
$resultados3 = mysqli_query($datos_conexion,"SELECT * FROM estado_votacion WHERE id_estado_votacion ='$id' ");
while($consulta3 = mysqli_fetch_array($resultados3))
  {
    $concejales_presentes=$concejales_presentes+$consulta3['presente'];
    $pedido_palabra=$pedido_palabra+$consulta3['pedido_palabra'];
    $registro_votacion=$registro_votacion+$consulta3['registro_votacion'];
    $votacion_positiva=$votacion_positiva+$consulta3['votacion_positiva'];
    $votacion_negativa=$votacion_negativa+$consulta3['votacion_negativa'];
    $votacion_abstencion=$votacion_abstencion+$consulta3['votacion_abstencion'];

    /*if ($consulta3['id_usuario']==5){
      $estado_voto_presidente_db=$consulta3['registro_votacion'];
    }*/
  }
}

$diferencia = $votacion_positiva - $votacion_negativa;
if ($diferencia >= 1 ) {
  $resultado = "Positivo";
  //$etiqueta="success";
} else {
  $resultado ="Negativo";
  //$etiqueta="danger";
}

$estado_quorum=""; // reseteo estado quorum

// Defino quorum en funcion de los presentes
if ($concejales_presentes >= $quorum_necesario){
    $estado_quorum="si";

} else {
$estado_quorum="no";
}


// Armo el ARRAY de Salida para el JSON
$resultados3= array (
    "usuario"  => "$usuario", // valor ramdom
    "n_sesion_anio"  => "$valor1", // valor ramdom
    "estado_quorum" => "$estado_quorum", // estado Quorum
    "pedido_palabra" => "$pedido_palabra", // cantidad de concejales con pedido de Palabra
    "registro_votacion" => "$registro_votacion", // cantidad de Votos
    "votacion_positiva" => "$votacion_positiva", // cantidad de votos Positivos
    "votacion_negativa" => "$votacion_negativa", //
    "votacion_abstencion" => "$votacion_abstencion", // estado Quorum
    "votacion_resultado" => "$resultado", // resultado votacion
    "concejales_presentes"  => "$concejales_presentes" // concejales presentes

);
// imprimo el Json
echo json_encode($resultados3);
?>
