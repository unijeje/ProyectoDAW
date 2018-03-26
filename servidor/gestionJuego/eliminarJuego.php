<?php

include_once("../bbdd.php");

$id=$_POST['datos'];

$miconexion=connectDB();
$miconexion->beginTransaction(); 
try
{
    $sql="update juego set ACTIVO=0 where id=? ";
    $deletes = $miconexion->prepare($sql);
    $deletes->execute(array($id));

    $miconexion->commit();
    $exito=true;
}
catch(PDOException $e)
{
    $miconexion->rollback();
    $exito = false;
}

echo json_encode($exito); 

?>