<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$nombre=$oDatos->nombre;
$nacionalidad=$oDatos->nacionalidad;
$desc=$oDatos->desc;
$genero=$oDatos->genero;
$enlace=$oDatos->enlace;

$sql="insert into personas(NOMBRE, NACIONALIDAD, GENERO, DESCRIPCION, ENLACE) values('$nombre', '$nacionalidad', '$genero', '$desc', '$enlace')";

$n=ejecutaConsultaAccion($sql);

if($n > 0)
    $exito = true;
else
    $exito = false;

echo json_encode($exito); 

?>