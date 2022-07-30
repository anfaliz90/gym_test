<?php
include('conn.php');
if(!$conexion)
{
 // echo 'Error al conectarse';
}
else
{
    // echo 'Conectado';
}

//Leer documento

 echo $id = $_POST['usuario'];
 if(empty($id)){
     $id=$_GET['usuario'];
 }
 
echo $id;
echo "el anterior es el id";


$sql2 ="SELECT * from  controlPago WHERE ide='$id' and estado='activo'";
$result2=mysqli_query($conexion,$sql2); 

            while($salida =mysqli_fetch_array($result2))
            {
               echo  $fechaFinal=$salida['fechaFinal'];
                $diasFaltantes=$salida['diasFaltantes'];
            }

$sql3 ="SELECT * from  usuario WHERE user='$id'";
$result3=mysqli_query($conexion,$sql3); 

            while($salida =mysqli_fetch_array($result3))
            {
                $nombre=$salida['nombre'];
                
            }



 echo $fecha = date("d-m-Y"); 
 echo "<br>";
 $difdia = abs(strtotime($fechaFinal) - strtotime($fecha));
 
if($difdia<=0)
{
    ECHO "MENOR O IGUAL A 0";
    $sql_insertar_nuevo ="UPDATE `controlPago` SET   estado='inactivo', diasFaltantes='0' WHERE ide='$id' AND estado='activo'";
    $insertar=mysqli_query($conexion,$sql_insertar_nuevo);
    header("Location:admin.php?estado=inactivo");
}
else
{
    echo "<br>";
    echo $days=floor(($difdia  / (60 * 60 * 24)));
    Echo " a registrar";
    $sql_insertar_nuevo ="UPDATE `controlPago` SET    diasFaltantes='$days' WHERE ide='$id' AND estado='activo'";
    $insertar=mysqli_query($conexion,$sql_insertar_nuevo); 
    header("Location:asistencia2.php?usuario=$id");
}


?>