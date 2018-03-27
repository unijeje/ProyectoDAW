<?php

include_once("../bbdd.php");
$oDatos=json_decode($_POST['datos']);
$id_juego=$oDatos->id_juego;
$id_usuario=$oDatos->id_usuario;
$nota=$oDatos->nota;

$miconexion=connectDB();

/*
Hacer select y comprobar si el usuario ya tiene una nota en este juego
Si tiene nota en este juego hacer update y mantener fecha antigua
Si no tiene nota crear con fecha de hoy un insert
*/

$sql="select fecha from votos where JUEGO=? and CUENTA=? ";
$select=$miconexion->prepare($sql);
$select->execute(array($id_juego, $id_usuario));
$fila=$select->fetch();

if($fila["fecha"]==null) //new Insert
{
    $sql="insert into votos(JUEGO, CUENTA, NOTA, FECHA) values (?,?,?,?)";
    $insert=$miconexion->prepare($sql);
    $date = date('Y-m-d');
    $insert->execute(array($id_juego, $id_usuario, $nota, $date));
    $res=true;
}
else if($nota=="revoke") //eliminar nota
{
    $sql="delete from votos where JUEGO=? and CUENTA=?";
    $update=$miconexion->prepare($sql);
    $update->execute(array($id_juego, $id_usuario));
    $res=true;
}
else //update
{
    $sql="update votos set nota=? where JUEGO=? and CUENTA=?";
    $update=$miconexion->prepare($sql);
    $update->execute(array($nota, $id_juego, $id_usuario));
    $res=true;
}

echo json_encode($res);

?>