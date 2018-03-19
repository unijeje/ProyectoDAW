<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$id=$oDatos->id;
$nombre=$oDatos->nombre;
$nacionalidad=$oDatos->nacionalidad;
$desc=$oDatos->desc;
$genero=$oDatos->genero;
$enlace=$oDatos->enlace;

$sql="update personas set NOMBRE='$nombre', NACIONALIDAD='$nacionalidad', GENERO='$genero', DESCRIPCION='$desc', ENLACE='$enlace' where id='$id'";


$n=ejecutaConsultaAccion($sql);

if($n > 0)
    $exito = true;
else
    $exito = false;

echo json_encode($exito); 

?>