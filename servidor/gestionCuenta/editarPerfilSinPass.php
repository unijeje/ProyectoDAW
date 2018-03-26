<?php

include_once("../bbdd2.php");

$oDatos=json_decode($_POST['datos']);
$usuario=$oDatos->nombre;
$email=$oDatos->correo;
$id=$oDatos->id;

$sql="UPDATE cuentas set email=? where id=? ";

$stmt = DB::run($sql, [$email, $id]);
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