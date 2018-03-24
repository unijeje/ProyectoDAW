<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$id=$oDatos->id;
$nombre=$oDatos->nombre;
$pais=$oDatos->pais;
$desc=$oDatos->desc;
$fecha=$oDatos->fecha;
$enlace=$oDatos->enlace;

$sql="update company set NOMBRE='$nombre', PAIS='$pais', Fecha='$fecha', DESCRIPCION='$desc', ENLACE='$enlace' where id='$id'";


$n=ejecutaConsultaAccion($sql);

if($n > 0)
    $exito = true;
else
    $exito = false;

echo json_encode($exito); 

?>