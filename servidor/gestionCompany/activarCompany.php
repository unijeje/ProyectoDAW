<?php

include_once("../bbdd2.php");

$id=$_POST['datos'];


$sql="update company set ACTIVO=1 where id=?";
$stmt = DB::run($sql, [$id]);
$n=$stmt->rowCount();


if($n > 0)
{
    $exito = true;   
}
else
    $exito = false;

echo json_encode($exito); 

?>