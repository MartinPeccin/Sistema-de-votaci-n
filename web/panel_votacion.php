<?php
//Manejo de botones seccion votacion (Habilitar Voto, Finalizar votacion, voto presidente)

include("conexion2.php"); // conecxion DB votoHCD
include ("estado_sistema_votacion.php"); // consultado estado sistema de votacion, tabla Sistema_votacion
include ("quorum.php");
//$sumapresentes=0; //inicializo suma de presentes para quorum

/*for ($i=1;$i<5;$i++){
$id = $i;
//Consulto si concejales estan presentes en base al registro de carga de votacion, recorriendo el listado por id (deberia ser de 1 a 25)
$resultados3 = mysqli_query($datos_conexion,"SELECT * FROM estado_votacion WHERE id_estado_votacion ='$id' ");
while($consulta3 = mysqli_fetch_array($resultados3))
  {
  $sumapresentes=$sumapresentes+$consulta3['presente'];
  }
}*/
$dia2 = date("Y-m-d");
$estado= 2;
$expedientes_a_votar=0; // inicializo variable suma expedientes enviados a votar
// verifico en DB si existen expedientes enviados a tratamiento (estado tratamiento=2) en el dia de hoy
$sql="SELECT * from expediente WHERE (fecha_tratamiento='$dia2') AND (estado_tratamiento=$estado)  ORDER BY orden_expediente ASC";
$result=mysqli_query($datos_conexion,$sql);
while($mostrar=mysqli_fetch_array($result)){
  $expedientes_a_votar=$expedientes_a_votar+1;
}
//Consulto en sistema_votacion estado de habilitada sesion, habilitar voto, cuarto intermedio con estado_sistema_votacion.php
//$estado_habilitar_sesion_db
//$estado_habilitar_voto_db
//$estado_cuarto_intermedio_db
//$estado_finalizar_votacion_db
//$estado_publicar_votacion_db
//$estado_finalizar_sesion_db



if ($estado_habilitar_sesion_db == 0){
    //etiquetas grises
    $estado_votacion="A la espera de inicio de sesión";
    $estado_habilitar_voto="Habilitar voto";
    $estado_habilitar_voto_tag="btn btn-secondary disabled";
    $estado_final_votacion="Final votacion";
    $final_votacion_tag="btn btn-secondary disabled";
    $estado_voto_presidente="Voto Presidente";
    $presidente_tag="btn btn-secondary disabled";



  }
    else {
          if ($estado_quorum == 'no'){
            $estado_votacion="NO hay Quorum";
            $estado_habilitar_voto="Habilitar voto";
            $estado_habilitar_voto_tag="btn btn-secondary disabled";
            $estado_final_votacion="Final votacion";
            $final_votacion_tag="btn btn-secondary disabled";
            $estado_voto_presidente="Voto Presidente";
            $presidente_tag="btn btn-secondary disabled";

          }// En caso de que haya quorum
          else {

                if ($estado_habilitar_voto_db == 1)
                {
                  $estado_votacion="Votación en curso";
                  $estado_habilitar_voto="Habilitar voto";
                  $estado_habilitar_voto_tag="btn btn-secondary disabled";
                  if ($estado_finalizar_votacion_db == 1){
                            $estado_votacion="Votación Finalizada - Publicar";
                            $estado_final_votacion="Final votacion";
                            $final_votacion_tag="btn btn-secondary disabled";
                            $estado_voto_presidente="Voto Presidente";
                            $presidente_tag="btn btn-secondary disabled";
                            }
                            else {
                              $estado_final_votacion="Final votacion";
                              $final_votacion_tag="btn btn-danger";
                              if ($estado_voto_presidente_db==1){
                                $estado_voto_presidente="Voto Presidente";
                                $presidente_tag="btn btn-secondary disabled";

                                }
                                else {$estado_voto_presidente="Voto Presidente";
                                $presidente_tag="btn btn-primary ";}
                              }


                }
                else {
                      if ($expedientes_a_votar == 0){
                        $estado_votacion="Seleccionar Expediente/s";
                        $estado_habilitar_voto="Habilitar voto";
                        $estado_habilitar_voto_tag="btn btn-secondary disabled";
                        $estado_final_votacion="Final votacion";
                        $final_votacion_tag="btn btn-secondary disabled";
                        $estado_voto_presidente="Voto Presidente";
                        $presidente_tag="btn btn-secondary disabled";
                      }

                      else {
                        if ($estado_cuarto_intermedio_db == 1 ){
                          $estado_votacion="En cuarto intermedio";
                          $estado_habilitar_voto="Habilitar voto";
                          $estado_habilitar_voto_tag="btn btn-secondary disabled";
                          $estado_final_votacion="Final votacion";
                          $final_votacion_tag="btn btn-secondary disabled";
                          $estado_voto_presidente="Voto Presidente";
                          $presidente_tag="btn btn-secondary disabled";
                        }
                        else {
                        $estado_votacion="A la espera de proxima votación";
                        $estado_habilitar_voto="Habilitar voto";
                        $estado_habilitar_voto_tag="btn btn-success";
                        $estado_final_votacion="Final votacion";
                        $final_votacion_tag="btn btn-secondary disabled";
                        $estado_voto_presidente="Voto Presidente";
                        $presidente_tag="btn btn-secondary disabled";
                      }


                      }



                }




          }
        }

/*
          // Si los presentes son > mitad+1 , hay expedientes para tratamiento pendiente y habilitar_voto=0
          if ($sumapresentes >= 3 & $expedientes_a_votar >= 1 & $estado_habilitar_voto_db == 0){
            //$tag="info-box-icon bg-success";
            //$quorum="Quorum OK";
            $estado_votacion="A la espera de proxima votación";
            //Boton Habilitar Voto
            $estado_habilitar_voto="Habilitar voto";
            $estado_habilitar_voto_tag="btn btn-success";//habilito boton "Habilitar voto"
            $tag2="btn btn-success";//habilito boton "Habilitar voto"
            $name="btn_habilitarvoto";
            //final votacion
            $estado_final_votacion="Final votacion";
            $final_votacion_tag="btn btn-secondary disabled";

            //Voto Presidente
            $estado_voto_presidente="Voto Presidente";
            $presidente_tag="btn btn-secondary disabled";

              // Si los presentes son > mitad+1 , hay expedientes pendientes de tratamiento pendiente y habilitar_voto=0
        } else {
                if ($sumapresentes >= 3 & $expedientes_a_votar == 0 & $estado_habilitar_voto_db == 0){
                //$tag="info-box-icon bg-danger";
                //$quorum="Sin Quorum";
                $estado_votacion="Seleccionar Expediente/s";
                $tag2="btn btn-secondary disabled";
                $estado_habilitar_voto_tag="btn btn-secondary disabled";
                $estado_final_votacion="Final votacion";
                $final_votacion_tag="btn btn-secondary disabled";

                //Voto Presidente
                $estado_voto_presidente="Voto Presidente";
                $presidente_tag="btn btn-secondary disabled";


                $name="";
              }
              else {
                  //code
              }

        }
}*/

//echo ':'.$expedientes_a_votar;


 ?>
