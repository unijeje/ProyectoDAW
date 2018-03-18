<?php

include_once("bbdd.php");

$oDatos=json_decode($_POST['datos']);
$usuario=$oDatos->nombre;
$email=$oDatos->correo;
$id=$oDatos->id;
$pass=$oDatos->pass;
$claveEncriptada=crypt($pass);

$sql="UPDATE cuentas set email='$email', password='$claveEncriptada' where id='$id'";

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