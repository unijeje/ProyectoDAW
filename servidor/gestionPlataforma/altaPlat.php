<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$nombre=$oDatos->nombre;
$company=$oDatos->company;
$desc=$oDatos->desc;
$fecha=$oDatos->fecha;
$esp=$oDatos->esp;



try
{
    $miconexion=connectDB();

    $sql="select ID from company where NOMBRE=?";
    
    $select = $miconexion->prepare($sql);
    
    $select->execute(array($company));
    
    $fila = $select->fetch(PDO::FETCH_ASSOC);
    
    $companyId=$fila["ID"];
    
    if($companyId == null)
    {
        $exito[0] = false;
        $exito[1] = "No se ha podido encontrar la empresa.";
        echo json_encode($exito); 
        exit();
    }
    
    $sql="insert into plataforma(NOMBRE, DESCRIPCION, FECHA, COMPANY, ESPECIFICACIONES, ACTIVO) values(?, ?, ?, ?, ?, 1)";
    
    $insert = $miconexion->prepare($sql);
    
    $insert->execute(array($nombre, $desc, $fecha, $companyId, $esp));
    
    $n = $insert->rowCount();

    $last_id=$miconexion->lastInsertId();  
    
    $select = null;
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


?>