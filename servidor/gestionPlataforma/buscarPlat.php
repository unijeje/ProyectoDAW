<?php

include_once("../bbdd.php");

$nombre=$_GET['datos'];


$sql="select id, nombre from plataforma where nombre like CONCAT(?,'%') and ACTIVO=1 order by nombre";

$miconexion=connectDB();
$select = $miconexion->prepare($sql);
$select->execute(array($nombre));
$fila=$select->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($fila); 
?>