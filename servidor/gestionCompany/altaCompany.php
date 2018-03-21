<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$nombre=$oDatos->nombre;
$pais=$oDatos->pais;
$desc=$oDatos->desc;
$fecha=$oDatos->fecha;
$enlace=$oDatos->enlace;

$sql="insert into company(NOMBRE, DESCRIPCION, FECHA, PAIS, ENLACE, ACTIVO) values('$nombre', '$desc', '$fecha', '$pais', '$enlace', 1)";

$n=ejecutaConsultaAccion($sql);

if($n > 0)
    $exito = true;
else
    $exito = false;

echo json_encode($exito); 

//echo json_encode($sql); 

?>