<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$id_juego=$oDatos->id;
$company=$oDatos->arrayCompany;


$miconexion=connectDB();
$miconexion->beginTransaction(); 
try
{
    
    $sql="delete from company_juegos where id_juego=?";
    $deletes = $miconexion->prepare($sql);
    $deletes->execute(array($id_juego));
    
    $insert = $miconexion->prepare("INSERT INTO company_juegos (ID_JUEGO, ID_COMPANY) VALUES(?,?)");
    $select = $miconexion->prepare("select ID from company where NOMBRE=?"); 
    foreach($company as $value)
    {
        $select->execute(array($value));
        $fila=$select->fetch();
        $insert->execute(array($id_juego, $fila["ID"]));
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