<?php

include_once("../bbdd.php");

$nombre=$_GET['datos'];


$sql="select id, nombre from plataforma where nombre like '%".$nombre."%' and ACTIVO=1 order by nombre";

$datos=ejecutaConsultaArray($sql);

echo json_encode($datos); 

?>