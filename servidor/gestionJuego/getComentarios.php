<?php

include_once("../bbdd.php");

$id_juego=$_GET["datos"];

$miconexion=connectDB();

$sql="select c.id, p.nombre, p.id as id_user, c.texto, FROM_UNIXTIME(c.fecha, '%d/%m/%Y %h:%i') as fecha from comentarios c, cuentas p where p.id=c.usuario and c.juego=? order by c.id asc";
$select = $miconexion->prepare($sql);
$select->execute(array($id_juego));
$fila=$select->fetchAll(PDO::FETCH_ASSOC);
    

$select=null;
$miconexion=null;


echo json_encode($fila);

?>