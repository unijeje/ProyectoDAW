<?php

include_once("bbdd.php");

$oDatos=json_decode($_POST['datos']);
$usuario=$oDatos->nombre;
$pass=$oDatos->pass;
$correo=$oDatos->correo;
$claveEncriptada=crypt($pass);

$sql="insert into cuentas(NOMBRE, PASSWORD, EMAIL, TIPO) values('$usuario', '$claveEncriptada', '$correo', 2)";

$n=ejecutaConsultaAccion($sql);

if($n > 0)
    $exito = true;
else
    $exito = false;

echo json_encode($exito); 

?>