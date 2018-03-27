<?php

include_once("../bbdd.php");

$id_juego=$_POST["datos"];

$miconexion=connectDB();

$sql="select c.id, p.nombre, c.texto, c.fecha  from comentarios c, personas p where p.id=c.usuario and c.juego=?";
$select = $miconexion->prepare($sql);
$select->execute(array($id_juego));
$fila=$select->fetchAll(PDO::FETCH_ASSOC);
    

$select=null;
$miconexion=null;


echo json_encode($fila);

?>