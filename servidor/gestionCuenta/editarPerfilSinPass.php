<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$usuario=$oDatos->nombre;
$email=$oDatos->correo;
$id=$oDatos->id;

$sql="UPDATE cuentas set email='$email' where id='$id'";

$n=ejecutaConsultaAccion($sql);

if($n>0)
{
    $exito=true;
}
else
{
    $exito = false;
}

echo json_encode($exito); 

?>