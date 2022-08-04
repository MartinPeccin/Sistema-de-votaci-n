<?php
//Manejo de botones seccion sesion (Iniciar sesion, cuarto intermedio, finalizar sesion)

include("conexion2.php");

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
    //consulto estado de  habilitar sesion
    $resultados1 = mysqli_query($datos_conexion,"SELECT * FROM sistema_votacion WHERE id_sistema_votacion ='1' ");
    while($consulta1 = mysqli_fetch_array($resultados1))
      {
      $estado1=$consulta1['estado_sistema'];
      $registro1=$consulta1['registro_sistema'];
      }
    //consulto estado cuarto intermedio
      $resultados3 = mysqli_query($datos_conexion,"SELECT * FROM sistema_votacion WHERE id_sistema_votacion ='3' ");
      while($consulta3 = mysqli_fetch_array($resultados3))
        {
        $estado3=$consulta3['estado_sistema'];
        $registro3=$consulta3['registro_sistema'];
        }

    //consulto estado finalizar sesion
      $resultados6 = mysqli_query($datos_conexion,"SELECT * FROM sistema_votacion WHERE id_sistema_votacion ='6' ");
      while($consulta6 = mysqli_fetch_array($resultados6))
            {
            $estado6=$consulta6['estado_sistema'];
            $registro6=$consulta6['registro_sistema'];
            }

    // si no hay sesion iniciada pongo infobox en gris
              if ($estado1 == 0 & $registro1 == 0){

                //Numero SESION
                //$numero_sesion=$n_sesion_anio.' - '.  $sesion_anio;
                $numero_sesion="";

                //Iniciar SESION
                  //<span class="info-box-icon bg-secondary"><i class="far fa-comment"></i></span>
                  $estado_iniciar_sesion="Iniciar Sesión";
                  $estado_iniciar_sesion_tag="btn btn-success float";

                //Cuarto intemedio
                  $estado_cuarto_intermedio="Cuarto Intermedio";
                  $estado_cuarto_intermedio_tag="btn btn-secondary float disabled";

                //Finalizar sesion

                $estado_finalizar_estado="Finalizar Sesión";
                $estado_finalizar_estado_tag="btn btn-secondary float disabled";



            //si la sesion esta iniciada
                } else {
                  //Numero SESION
                  $numero_sesion=$n_sesion_anio.' - '.  $sesion_anio;

                      if ($estado3 == 0) {
                        $estado_iniciar_sesion="Sesión en curso";
                        $estado_iniciar_sesion_tag="btn btn-secondary float disabled";

                        //Cuarto intemedio
                          $estado_cuarto_intermedio="Cuarto Intermedio";
                          $estado_cuarto_intermedio_tag="btn btn-warning float";

                          //Finalizar sesion

                          $estado_finalizar_estado="Finalizar Sesión";
                          $estado_finalizar_estado_tag="btn btn-danger float";

                      } else {
                        //Iniciar SESION
                          //<span class="info-box-icon bg-secondary"><i class="far fa-comment"></i></span>
                          $estado_iniciar_sesion="Sesión en curso";
                          $estado_iniciar_sesion_tag="btn btn-secondary float disabled";

                          //Cuarto intemedio
                            $estado_cuarto_intermedio="Fin Cuarto Intermedio";
                            $estado_cuarto_intermedio_tag="btn btn-warning float";

                            //Finalizar sesion

                            $estado_finalizar_estado="Finalizar Sesión";
                            $estado_finalizar_estado_tag="btn btn-secondary float disabled";
                      }







                        }



 ?>
