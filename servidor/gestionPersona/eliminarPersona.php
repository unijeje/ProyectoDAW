<?php

include_once("../bbdd.php");

$id=$_POST['datos'];


$sql="update personas set ACTIVO=0 where id='$id'";


$n=ejecutaConsultaAccion($sql);

if($n > 0)
    $exito = true;
else
    $exito = false;

echo json_encode($exito); 

?>