<?php
// Estado de Tabla Sistema Votacion
//Consulto en sistema_votacion estado de habilitada sesion, habilitar voto, cuarto intermedio, Finalizar votacion, publicar votacion
include("conexion2.php"); // conecxion DB votoHCD
$estado_habilitar_sesion_db=0;
$estado_habilitar_voto_db=0;
$estado_cuarto_intermedio_db=0;
$estado_finalizar_votacion_db=0;
$estado_publicar_votacion_db=0;
$estado_finalizar_sesion_db=0;


$e=0;
for ($e=1;$e<7;$e++){
        $id1=$e;
        $resultados2 = mysqli_query($datos_conexion,"SELECT * FROM sistema_votacion WHERE id_sistema_votacion ='$id1' ");
        while($consulta2 = mysqli_fetch_array($resultados2))
          {
          $funcion_sistema=$consulta2['funcion_sistema'];
          $estado_sistema=$consulta2['estado_sistema'];

          switch ($funcion_sistema) {
            case "habilitar_sesion":
                $estado_habilitar_sesion_db=$estado_sistema;
                break;
            case "habilitar_voto":
                $estado_habilitar_voto_db=$estado_sistema;
                break;
            case "cuarto_intermedio":
                $estado_cuarto_intermedio_db=$estado_sistema;
                break;

            case "finalizar_votacion":
                    $estado_finalizar_votacion_db=$estado_sistema;
                    break;

            case "publicar_votacion":
                        $estado_publicar_votacion_db=$estado_sistema;
                        break;
            case "finalizar_sesion":
                          $estado_finalizar_sesion_db=$estado_sistema;
                            break;

              }
            }
          }

?>
