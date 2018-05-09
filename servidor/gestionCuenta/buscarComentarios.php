<?php

include_once("../bbdd.php");

$id_user=$_GET["datos"];


$sql="SELECT c.juego, j.titulo, c.texto, FROM_UNIXTIME(c.fecha, '%d/%m/%Y %h:%i') as fecha from comentarios c inner join juego j on c.juego=j.id where c.usuario=? order by c.fecha desc";

//echo json_encode($sql);

$miconexion=connectDB();
$res = $miconexion->prepare($sql);
$res->execute(array($id_user));
$lista=$res->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($lista);

?>