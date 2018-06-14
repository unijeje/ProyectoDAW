<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$id=$oDatos->id;
$nombre=$oDatos->nombre;
$sinopsis=$oDatos->sinopsis;
$enlace=$oDatos->enlace;
$fecha=$oDatos->fecha;
$duracion=$oDatos->duracion;
$oGeneros=$oDatos->generos;

if($duracion == -1)
{
    $duracion = NULL;
}

$miconexion=connectDB();
$miconexion->beginTransaction(); 

try
{
    $sql="update juego set TITULO=?, SINOPSIS=?, FECHA=?, DURACION=?, ENLACE=? where id=? ";
    $update= $miconexion->prepare($sql);
    $update->execute(array($nombre, $sinopsis, $fecha, $duracion, $enlace, $id));

    $sql="delete from generos_juego where ID_JUEGO=? ";
    $deletes = $miconexion->prepare($sql);
    $deletes->execute(array($id));

    $insert = $miconexion->prepare("INSERT INTO generos_juego (ID_JUEGO, ID_GENERO) VALUES(?,?)");
    foreach($oGeneros as $value)
    {
        $insert->execute(array($id, $value));
    }

    $miconexion->commit();
    $exito=true;
}
catch(PDOException $e)
{
    $miconexion->rollback();
    $exito = false;
}
$inseupdatert=null;
$insert=null;
$deletes=null;
$miconexion=null;

echo json_encode($exito); 

?>