<?php

include_once("../bbdd2.php");

$oDatos=json_decode($_POST['datos']);
$usuario=$oDatos->nombre;
$email=$oDatos->correo;
$id=$oDatos->id;
$pass=$oDatos->pass;
$claveEncriptada=crypt($pass);

$sql="UPDATE cuentas set email=?, password=? where id=?";

$stmt = DB::run($sql, [$email, $claveEncriptada, $id]);
$n=$stmt->rowCount();
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