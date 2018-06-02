<?php

include_once("../bbdd.php");



$oDatos=json_decode($_POST['datos']);

$nombre=$oDatos->nombre;
$pais=$oDatos->pais;
$desc=$oDatos->desc;
$fecha=$oDatos->fecha;
$enlace=$oDatos->enlace;


try
{
    $miconexion=connectDB();

    $sql="insert into company(NOMBRE, DESCRIPCION, FECHA, PAIS, ENLACE, ACTIVO) values(?, ?, ?, ?, ?, 1)";

    $insert = $miconexion->prepare($sql);
    
    $insert->execute(array($nombre, $desc, $fecha, $pais, $enlace));
    
    $n = $insert->rowCount();

    $last_id=$miconexion->lastInsertId();  
    
    $insert = null;
    $miconexion = null;

    if($n > 0)
    {
        $exito[0] = true;
        $exito[1] = $last_id;
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

//echo json_encode($sql); 

?>