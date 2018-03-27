<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST["datos"]);
$id_juego=$oDatos->id;
$arrayNombre=$oDatos->nombres;
$arrayRoles=$oDatos->roles;
$arrayComment=$oDatos->coment;

$miconexion=connectDB();
$miconexion->beginTransaction(); 

try
{
    /*Borrar todos los roles de ese juego*/
    $sql="delete from personas_roles_juegos where juego=?";
    $deletes = $miconexion->prepare($sql);
    $deletes->execute(array($id_juego));

    /*coger los ids de las personas que se han pasado*/
    $sql="select id from personas where nombre=? ";
    $select=$miconexion->prepare($sql);
    foreach($arrayNombre as $value)
    {
        $select->execute(array($value));
        $fila=$select->fetch(PDO::FETCH_ASSOC);
        $arrayStaffID[]=$fila["id"];
    }
    
    $sql="insert into personas_roles_juegos (PERSONA, JUEGO, ROL, COMENTARIO) values (?, ?, ?, ?)";

    $insert = $miconexion->prepare($sql);
    for($i=0;$i<count($arrayRoles);$i++)
    {
        $insert->execute(array($arrayStaffID[$i], $id_juego, $arrayRoles[$i], $arrayComment[$i]));
    }  

    

    $miconexion->commit();
    $exito=true;
}
catch(PDOException $e)
{
    $miconexion->rollback();
    $exito = false;
}
$deletes=null;
$select=null;
$insert=null;
$miconexion=null;


echo json_encode($exito);

?>