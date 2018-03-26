<?php

include_once("../bbdd.php");

$sql="select id, genero from generos";

echo json_encode(ejecutaConsultaArray($sql));
?>