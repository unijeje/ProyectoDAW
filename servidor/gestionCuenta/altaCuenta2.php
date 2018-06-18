<?php
error_reporting(0);
include_once("../bbdd2.php");

$oDatos=json_decode($_POST['datos']);
$usuario=$oDatos->nombre;
$pass=$oDatos->pass;
$correo=$oDatos->correo;
$claveEncriptada=crypt($pass);
$date = date('Y-m-d');

$sql="insert into cuentas(NOMBRE, PASSWORD, EMAIL, REGISTRO, TIPO, clave, activo) values(?, ?, ?, ?, 2, ?, 1)";

$clave = hash("sha384", $usuario);

$stmt = DB::run($sql, [$usuario, $claveEncriptada, $correo, $date, $clave]);
$n=$stmt->rowCount();

if($n > 0)
{
    $exito = true;
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    
    $message = "<html><head></head><body>";
    $message .= "Buenas ".$usuario;
    $message .= "<br><br>";
    $message .= "Su registro en VJDB se ha realizado con exito. Puede conectarse con sus credenciales cuando lo desee.";
    $message .= "<br>";
    $message .= "Si no ha sido usted el que se ha registrado ignore este correo.";
    $message .= "</body></html>";

    mail($correo, "Bienvenido a VJDB", $message, implode("\r\n", $headers));
}
    
else
    $exito = false;

echo json_encode($exito); 

?>