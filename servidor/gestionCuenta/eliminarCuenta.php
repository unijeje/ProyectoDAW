<?php

include_once("../bbdd2.php");
$id=$_POST["datos"];
$sql="UPDATE cuentas set ACTIVO=0 WHERE ID = ? ";
$stmt = DB::run($sql, [$id]);
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