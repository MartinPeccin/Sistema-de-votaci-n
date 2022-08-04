<?PHP
include("conexion2.php");
include("estado_sistema_votacion.php");

$actualizo="no";
//Si no se apreto boton finalizar votacion realizo :
if ($estado_finalizar_votacion_db == 0){
$positivos=0;
$negativos=0;
$abstencion=0;
$diferencia=0;
$resultado="";
$i1=1;
for ($i1=1;$i1<5;$i1++){
            $id = $i1;
            //Consulto votos de todos en base al registro de carga de votacion
            $resultados1 = mysqli_query($datos_conexion,"SELECT * FROM estado_votacion WHERE id_estado_votacion ='$id' ");
            while($consulta1 = mysqli_fetch_array($resultados1))
                  {
                    // sumo los votos positivos, negativos, abstenciones
                    $positivos=$positivos+$consulta1['votacion_positiva'];
                    $negativos=$negativos+$consulta1['votacion_negativa'];
                    $abstencion=$abstencion+$consulta1['votacion_abstencion'];
                  }
                }
            $diferencia = $positivos - $negativos;
            if ($diferencia >= 1 ) {
                    $resultado ="Positivo";
                  } else {
                    $resultado = "negativo";
                  }
$i2=1;
for ($i2=1;$i2<5;$i2++){
            $id1 = $i2;
            //Consulto votos de todos en base al registro de carga de votacion
            $resultados2 = mysqli_query($datos_conexion,"SELECT * FROM estado_votacion WHERE id_estado_votacion ='$id1' ");
            while($consulta2 = mysqli_fetch_array($resultados2))
                  {

                      $id_g=$consulta2['id_registro_votacion_g'];
                      $id_usuario=$consulta2['id_usuario'];
                      $fecha=date("Y-m-d H:i:s");
                      $voto_positivo=$consulta2['votacion_positiva'];
                      $voto_negativo=$consulta2['votacion_negativa'];
                      $voto_abstencion=$consulta2['votacion_abstencion'];
                    //los voy guardando en el registro de votacion individual uno a uno
                      $_INSERT_SQL2= "INSERT INTO `registro_votacion_individual` (`id_registro_votacion_i`,`id_registro_votacion_g`, `id_usuario`, `fecha`,`resultado_votacion` ,`votacion_positiva`,`votacion_negativa`,`votacion_abstencion`) VALUES (NULL, '$id_g', '$id_usuario', '$fecha','$resultado','$voto_positivo','$voto_negativo','$voto_abstencion') ";
                      mysqli_query($datos_conexion,$_INSERT_SQL2);
                      // sumo los votos positivos, negativos, abstenciones
                      //$positivos=$positivos+$consulta2['votacion_positiva'];
                      //$negativos=$negativos+$consulta2['votacion_negativa'];
                      //$abstencion=$abstencion+$consulta2['votacion_abstencion'];
                      //$negativo = 3- $negativos;
                    }
            }

// evaluo resultado de votacion
/*$diferencia = $positivos - $negativos;
if ($diferencia >= 1 ) {
          $resultado ="Positivo";
          } else {
          $resultado = "negativo";

        }*/

//cargo resultado en el registro de votacion general- OBSERVACION!! DEBERIA CARGAR EN EXPEDIENTE FECHA VOTACION Y CAMBIAR ESTADO TRATAMIENTO DE EXPEDIENTE
$tabla_db2="registro_votacion_general";

$_UPDATE_SQL2="UPDATE $tabla_db2 Set
        fecha_votacion='$fecha',
        votacion_positiva='$positivos',
        votacion_negativa='$negativos',
        votacion_abstencion='$abstencion',
        resultado_votacion='$resultado',
        estado='finalizado'
        WHERE id_registro_votacion_g ='$id_g'";
        mysqli_query($datos_conexion,$_UPDATE_SQL2);


//Actualizo sistema votacion finalizar_votacion=1
    $tabla_db1 = "sistema_votacion";
    $id_sistema_votacion=4;
    $estado_sistema=1;
    $registro_sistema=1;
    $_UPDATE_SQL="UPDATE $tabla_db1 Set
    registro_sistema='$registro_sistema',
    estado_sistema='$estado_sistema'
    WHERE id_sistema_votacion ='$id_sistema_votacion'";
    mysqli_query($datos_conexion,$_UPDATE_SQL);



    // Actualizo el estado de los expedientes votados
      //Entonces debo leer del registro general de votacion los expedientes tratados y con la funcion explode separarlos y UPDATE
      // Voy a usar las variable $fecha , $id_g(id votacion general), $resultado


        $resultados3 = mysqli_query($datos_conexion,"SELECT * FROM registro_votacion_general WHERE id_registro_votacion_g='$id_g' ");
        while($consulta3 = mysqli_fetch_array($resultados3))
          {
          $id_expediente=$consulta3['id_expediente'];
          $cantidad_expedientes=$consulta3['cantidad_expedientes'];
        }

        $expedientes = explode(",", $id_expediente);
        //echo "<br><br>El número de elementos en el array es: " . count($expediente);
        //echo "<br>";
        //$numero=6;
        $i3=0;
        $limit=$cantidad_expedientes+1;
        $tabla_db2="expediente";
        for ($i3=0;$i3<$limit;$i3++){
                      $codigo=$expedientes[$i3];
                      $_UPDATE_SQL2="UPDATE $tabla_db2 Set
                                  fecha_votacion='$fecha',
                                  id_registro_votacion_g =$id_g,
                                  estado_tratamiento = 3,
                                  resultado_votacion='$resultado'
                                  WHERE id_expediente ='$codigo'";
                                  mysqli_query($datos_conexion,$_UPDATE_SQL2);
                        }
      //The employee name
      /*$employee= "Mr vinay HS,engineer,Bangalore";
      $expedientes="2, 1, 3, 4, 5, 6,";

      //Breaks each portion of the employee's name up
      list($name, $job, $location) = explode(',',$employee);
      list($exp1, $exp2, $exp3, $exp4, $exp5, $exp6) = explode(',',$expedientes);

      //Outputs the employee's credentials
      echo "Name: $name; Job: $job; Location: $location";
      echo "<br>";
      echo "Exp1: $exp1; Exp2: $exp2; Exp3: $exp3; Exp4: $exp4; Exp5: $exp5; Exp6: $exp6;";*/
      //pruebas





}



/*

echo 'Positivos:'.$positivos;
echo 'Negativos:'.$negativos;
echo 'Abstencion:'.$abstencion;
echo 'Resultado:'.$resultado;
//echo $resultado;

*/



/*
$negativos=0;
$i=1;
for ($i=1;$i<5;$i++){
$id = $i;
//Consulto si votaron todos en base al registro de carga de votacion
$resultados = mysqli_query($datos_conexion,"SELECT * FROM estado_votacion WHERE id_estado_votacion ='$id' ");
while($consulta = mysqli_fetch_array($resultados))
  {
  $negativos=$negativos+$consulta['votacion_positiva'];
  $diferencia = 3- $negativos;
  if ($diferencia >= 2 ) {
    $resultado ="Negativo";
    $etiqueta="danger";
  } else {
    $resultado = "Positivo";
    $etiqueta="success";
  }

  }
}
*/



//echo 'actualizo: '.$actualizo;
header("location: presidente.php");
//header( "refresh:5;url=presidente.php" );
?>
