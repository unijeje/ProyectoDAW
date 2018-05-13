<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$nombre=$oDatos->nombre;
$nacionalidad=$oDatos->nacionalidad;
$desc=$oDatos->desc;
$genero=$oDatos->genero;
$enlace=$oDatos->enlace;


try
{
    $miconexion=connectDB();

    $sql="insert into personas(NOMBRE, NACIONALIDAD, GENERO, DESCRIPCION, ENLACE, ACTIVO) values(?, ?, ?, ?, ?, 1)";

    $insert = $miconexion->prepare($sql);
    $insert->execute(array($nombre, $nacionalidad, $genero, $desc, $enlace));

    $n = $insert->rowCount();

    $last_id=$miconexion->lastInsertId();  

    if($n > 0)
        {
            $exito[0] = true;
            $exito[1] =$last_id;
        }
    else
    {
        $exito[0] = false;
        $exito[1] = "Fallo inesperado al insertar.";
    }
}
catch(PDOEXCEPTION $e)
{
    $exito[0] = false;
    $exito[1] = "Fallo inesperado al insertar.";
}

echo json_encode($exito); 

?>