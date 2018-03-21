<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$id=$oDatos->id;
$nombre=$oDatos->nombre;
$company=$oDatos->company;
$desc=$oDatos->desc;
$fecha=$oDatos->fecha;
$esp=$oDatos->esp;

$sql="select ID from company where NOMBRE='".$company."'";
$fila=consultaUnica($sql);
$company=$fila["ID"];


$sql="update plataforma set NOMBRE='$nombre', COMPANY='$company', Fecha='$fecha', DESCRIPCION='$desc', ESPECIFICACIONES='$esp' where id='$id'";


$n=ejecutaConsultaAccion($sql);

if($n > 0)
    $exito = true;
else
    $exito = false;

echo json_encode($exito); 

?>