<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$id_juego=$oDatos->id;
$oPlataformas=$oDatos->plat;


$miconexion=connectDB();
$miconexion->beginTransaction(); 
try
{
    
    $sql="delete from plataforma_juego where id_juego=?";
    $deletes = $miconexion->prepare($sql);
    $deletes->execute(array($id_juego));
    
    $insert = $miconexion->prepare("INSERT INTO plataforma_juego (ID_JUEGO, ID_PLATAFORMA) VALUES(?,?)");
    //$select = $miconexion->prepare("select ID from plataforma where NOMBRE=?"); 
    foreach($oPlataformas as $value)
    {
        //$select->execute(array($value));
        //$fila=$select->fetch();
        $insert->execute(array($id_juego, $value));
    }  

    

    $miconexion->commit();
    $exito=true;
}
catch(PDOException $e)
{
    $miconexion->rollback();
    $exito = false;
}
$insert=null;
$select=null;
$deletes=null;
$miconexion=null;

echo json_encode($exito); 

//echo json_encode($sql); 

?>