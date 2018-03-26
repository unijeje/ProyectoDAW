<?php

include_once("../bbdd.php");

$id=$_POST["datos"];
try
{
$miconexion=connectDB();
$sql="update juego set COVER=null where ID=? ";
$accion=$miconexion->prepare($sql);
$accion->execute(array($id));
$exito=true;
}
catch(PDOException $e)
{
    $exito = false;
}

$accion=null;
$miconexion=null;

echo json_encode($exito);

?>