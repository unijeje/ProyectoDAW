<?php
error_reporting(0);
include_once("../bbdd2.php");

$oDatos=json_decode($_POST['datos']);
$usuario=$oDatos->nombre;
$pass=$oDatos->pass;
$correo=$oDatos->correo;
$claveEncriptada=crypt($pass);
$date = date('Y-m-d');

$sql="insert into cuentas(NOMBRE, PASSWORD, EMAIL, REGISTRO, TIPO, clave) values(?, ?, ?, ?, 2, ?)";

$clave = hash("sha384", $usuario);

$stmt = DB::run($sql, [$usuario, $claveEncriptada, $correo, $date, $clave]);
$n=$stmt->rowCount();

if($n > 0)
    $exito = true;
else
    $exito = false;

echo json_encode($exito); 

?>