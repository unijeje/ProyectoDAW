<?php

include_once("../bbdd2.php");
$id=$_POST["datos"];
$sql="DELETE FROM cuentas WHERE ID = ? ";
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