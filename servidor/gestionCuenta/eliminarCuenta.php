<?php

include_once("../bbdd.php");
$id=$_POST["datos"];
$sql="DELETE FROM cuentas WHERE ID = ".$id;
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