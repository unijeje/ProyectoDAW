<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$nombre=$oDatos->nombre;
$company=$oDatos->company;
$desc=$oDatos->desc;
$fecha=$oDatos->fecha;
$esp=$oDatos->esp;

$sql="select ID from company where NOMBRE='".$company."'";
$fila=consultaUnica($sql);
$company=$fila["ID"];


$sql="insert into plataforma(NOMBRE, DESCRIPCION, FECHA, COMPANY, ESPECIFICACIONES, ACTIVO) values('$nombre', '$desc', '$fecha', '$company', '$esp', 1)";

$n=ejecutaConsultaAccion($sql);

if($n > 0)
    $exito = true;
else
    $exito = false;

echo json_encode($exito); 

//echo json_encode($sql); 

?>