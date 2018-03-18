<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$usuario=$oDatos->nombre;
$pass=$oDatos->pass;
$correo=$oDatos->correo;
$claveEncriptada=crypt($pass);
$date = date('Y-m-d');
$sql="insert into cuentas(NOMBRE, PASSWORD, EMAIL, REGISTRO, TIPO) values('$usuario', '$claveEncriptada', '$correo', '$date', 2)";

$n=ejecutaConsultaAccion($sql);

if($n > 0)
    $exito = true;
else
    $exito = false;

echo json_encode($exito); 

?>