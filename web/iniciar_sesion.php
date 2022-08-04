<?PHP
include("conexion2.php");
// Modulo de inicio de Sesión, se verifica estado de sesion y se
//$codigo=$_GET['cod3'];
$resultados2 = mysqli_query($datos_conexion,"SELECT * FROM sistema_votacion WHERE id_sistema_votacion ='1' ");
while($consulta2 = mysqli_fetch_array($resultados2))
  {
  $estado2=$consulta2['estado_sistema'];// verifico si la sesion esta en curso "Funcion_sistema"=habilitar_sesion
  $registro2=$consulta2['registro_sistema'];
  }
  if ($estado2 == 0) {
    //actualiza el estado de sesion asignando valor 1 a "Funcion_sistema"=habilitar_sesion
    $tabla_db1 = "sistema_votacion";
    $id_sistema_votacion=1;
    $estado_sistema=1;
    $registro_sistema=1;
    $_UPDATE_SQL="UPDATE $tabla_db1 Set
    registro_sistema='$registro_sistema',
    estado_sistema='$estado_sistema'
    WHERE id_sistema_votacion ='$id_sistema_votacion'";
    mysqli_query($datos_conexion,$_UPDATE_SQL);
    //actulizo estado de "Funcion_sistema"=finalizar_sesion=0
    $id_sistema_votacion1=6;
    $estado_sistema1=0;
    $registro_sistema1=0;
    $_UPDATE_SQL1="UPDATE $tabla_db1 Set
    registro_sistema='$registro_sistema1',
    estado_sistema='$estado_sistema1'
    WHERE id_sistema_votacion ='$id_sistema_votacion1'";
    mysqli_query($datos_conexion,$_UPDATE_SQL1);




   // --- cargo numero de sesion en tabla Registro sesion ---

   $resultados = mysqli_query($datos_conexion,"SELECT * FROM registro_sesion WHERE id_registro_sesion=(SELECT max(id_registro_sesion) FROM registro_sesion) ");
   while($consulta = mysqli_fetch_array($resultados))
     {
     $n_sesion_anio=$consulta['n_sesion_anio'];
     $sesion_anio=$consulta['anio'];
     }
     $anio= date("Y");
     $dia = date("Y-m-d H:i:s");
     if ($sesion_anio == $anio) {
       $n_sesion_anio= $n_sesion_anio+1 ;
     }
     else {
       $n_sesion_anio= 1 ;
     }

    $_INSERT_SQL= "INSERT INTO `registro_sesion` (`id_registro_sesion`, `n_sesion_anio`, `anio`, `fecha`) VALUES (NULL, '$n_sesion_anio', '$anio', '$dia') ";
    mysqli_query($datos_conexion,$_INSERT_SQL);
    //mysqli_query($datos_conexion,"INSERT INTO `registro_sesion` (`id_registro_sesion`, `n_sesion_anio`, `anio`, `fecha`) VALUES (NULL, '$n_sesion_anio', '2020', '2020-11-21 20:41:00') ");

    //echo "Habilito sesion";
    }
    header("location: presidente.php");

    ?>
