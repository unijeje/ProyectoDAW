<?php

include_once("../bbdd.php");

$id_juego=$_GET["datos"];

$sql="SELECT id_plataforma from plataforma_juego where id_juego=$id_juego";

echo json_encode(ejecutaConsultaArray($sql));

?>