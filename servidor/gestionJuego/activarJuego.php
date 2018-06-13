<?php

include_once("../bbdd.php");

$id=$_POST['datos'];

$miconexion=connectDB();
try
{
    $sql="update juego set ACTIVO=1 where id=? ";
    $deletes = $miconexion->prepare($sql);
    $deletes->execute(array($id));

    $exito=true;
}
catch(PDOException $e)
{
    $exito = false;
}

echo json_encode($exito); 

?>