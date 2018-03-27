<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST["datos"]);
$id_juego=$oDatos->juego;
$id_usuario=$oDatos->usuario;
$comment=$oDatos->comment;

$miconexion=connectDB();
$miconexion->beginTransaction(); 

try
{
    /*Conseguir el ultimo id_comment para ese juego*/
    $sql="select max(id) as ultima from comentarios where juego=?";
    $select = $miconexion->prepare($sql);
    $select->execute(array($id_juego));
    $fila=$select->fetch();
    $ultima_id=$fila["ultima"]+1;
    
    /*Insert comment*/
    $unixTimeStamp=time();
    $sql="insert into comentarios (ID, JUEGO, USUARIO, TEXTO, FECHA) values (?,?,?,?,'$unixTimeStamp') ";
    $insert = $miconexion->prepare($sql);
    $insert->execute(array($ultima_id, $id_juego, $id_usuario, $comment));

    $miconexion->commit();
    $exito=true;
}
catch(PDOException $e)
{
    $miconexion->rollback();
    echo $e;
    $exito=false;
}
$select=null;
$insert=null;
$miconexion=null;


echo json_encode($exito);

?>