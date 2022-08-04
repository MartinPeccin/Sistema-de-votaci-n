<?PHP
//update_panel.php
// Actualizo estado de panel de sesión

include("conexion2.php");
include("estado_sistema_votacion.php");
//Consulto en sistema_votacion estado de habilitada sesion, habilitar voto, cuarto intermedio con estado_sistema_votacion.php
//$estado_habilitar_sesion_db
//$estado_habilitar_voto_db
//$estado_cuarto_intermedio_db
//$estado_finalizar_votacion_db
//$estado_publicar_votacion_db
//$estado_finalizar_sesion_db
include("quorum.php"); // obtengo estado de quorum Si/No y le doy css al icono de quorum
////Salida Concejales Presentes
//  $concejales_presentes
//echo 'Estado quorum: '.$estado_quorum;
// $estado_quorum="si"; $estado_quorum="no";

$estado_sesion1="";


//consulto numero de sesion del dia/año
$resultados = mysqli_query($datos_conexion,"SELECT * FROM registro_sesion WHERE id_registro_sesion=(SELECT max(id_registro_sesion) FROM registro_sesion) ");
while($consulta = mysqli_fetch_array($resultados))
{
  $n_sesion_anio=$consulta['n_sesion_anio'];
  $sesion_anio=$consulta['anio'];
}
// consulto numero de votacion del dia
$resultados2 = mysqli_query($datos_conexion,"SELECT * FROM registro_votacion_general WHERE id_registro_votacion_g=(SELECT max(id_registro_votacion_g) FROM registro_votacion_general) ");
while($consulta2 = mysqli_fetch_array($resultados2))
{
  $n_orden_diario_votacion=$consulta2['n_orden_diario_votacion'];
}
//consulto estado de  habilitar sesion include("estado_sistema_votacion.php");

//consulto estado cuarto intermedio include("estado_sistema_votacion.php");


// si no hay sesion iniciada pongo infobox en gris
// estado1=habilitar sesion
//if ($estado1 == 0 & $registro1 == 0){
if ($estado_habilitar_sesion_db == 0 ){

  //Estado de SESION
  //<span class="info-box-icon bg-secondary"><i class="far fa-comment"></i></span>
  $estado_sesion1="Espera de Inicio";
  $estado_sesion_tag="info-box-icon bg-secondary";
  $estado_sesion_logo="fas fa-stop";

  //Pedido palabra
  $pedido_palabra="";
  $pedido_palabra_tag="info-box-icon bg-secondary";
  $suma_pedido_palabra=0;
  //Concejales presentes
  $tag="info-box-icon bg-secondary";
  $quorum="Espera de Inicio";

  //Resultado votacion
  $resultado_votacion="Espera de Inicio";
  $resultado_votacion_tag="btn info-box-icon bg-secondary disabled";

  //si la sesion esta iniciada
} else {

  //verifico quorum sumando presentes en el recinto
  if ($estado_quorum == 'si'){
    $tag="info-box-icon bg-success";
    $quorum="- Quorum OK";
    //$tag2="btn btn-success";
    //$name="btn_habilitarvoto";

  } else {

    $tag="info-box-icon bg-danger";
    $quorum="- Sin Quorum";
    //$tag2="btn btn-success disabled";
    //$name="";
  }


  //verifico pedidos de la palabra
  $suma_pedido_palabra=0;
  for ($i=1;$i<5;$i++){
    $id = $i;
    //Consulto si votaron todos en base al registro de carga de votacion
    $resultados4 = mysqli_query($datos_conexion,"SELECT * FROM estado_votacion WHERE id_estado_votacion ='$id' ");
    while($consulta4 = mysqli_fetch_array($resultados4))
    {
      $suma_pedido_palabra=$suma_pedido_palabra+$consulta4['pedido_palabra'];
    }
  }


  //Estado de SESION $estado3=$estado_cuarto_intermedio_db
  //if ($estado3 == 0 & $registro3 == 0) {
  if ($estado_cuarto_intermedio_db == 0) {
    $estado_sesion1="En Curso";
    $estado_sesion_tag="info-box-icon bg-info";
    $estado_sesion_logo="fas fa-play";
  } else {
    $estado_sesion1="Cuarto Intermedio";
    $estado_sesion_tag="info-box-icon bg-warning";
    $estado_sesion_logo="fas fa-pause";
  }



  //Pedido palabra
  $pedido_palabra="";
  $pedido_palabra_tag="info-box-icon bg-warning";
  //Concejales presentes

  //Verifico si finalizo votación

  if ($estado_finalizar_votacion_db==0){
    //Resultado votacion
    $resultado_votacion="Espera de Votación";
    //$resultado_votacion_tag="btn info-box-icon bg-secondary disabled";
    $resultado_votacion_tag="btn info-box-icon bg-danger disabled";
  }
  else {
    //Resultado votacion
    $resultado_votacion="Publicar Votación";
    //$resultado_votacion_tag="btn info-box-icon bg-secondary disabled";
    $resultado_votacion_tag="btn info-box-icon bg-danger";


  }





}

// Estado SESION
//$estado_sesion1="Espera de Inicio"; "En Curso"; "Cuarto Intermedio";
//$estado_sesion_tag="info-box-icon bg-secondary"; "info-box-icon bg-info"; "info-box-icon bg-warning";
//$estado_sesion_logo="fas fa-stop"; "fas fa-play"; "fas fa-pause";

// Pedido PALABRA
//$pedido_palabra="";
//$pedido_palabra_tag="info-box-icon bg-secondary"; "info-box-icon bg-warning";
//$suma_pedido_palabra=0;

//Consejales PRESENTES
//$concejales_presentes
//$estado_quorum

//Publicar VOTACION
//$resultado_votacion="Publicar Votación";
//$resultado_votacion_tag="btn info-box-icon bg-danger";

$informacion= array (

  "estado_sesion"  => "$estado_sesion1",
  "estado_sesion_tag" => "$estado_sesion_tag",
  "estado_sesion_logo"  => "$estado_sesion_logo",
  "pedido_palabra"  => "$pedido_palabra",
  "pedido_palabra_tag" => "$pedido_palabra_tag",
  "suma_pedido_palabra"  => "$suma_pedido_palabra",
  "concejales_presentes" => "$concejales_presentes",
  "estado_quorum"  => "$estado_quorum",
  "resultado_votacion" => "$resultado_votacion",
  "resultado_votacion_tag"  => "$resultado_votacion_tag"

);



//echo json_encode($informacion);


?>
