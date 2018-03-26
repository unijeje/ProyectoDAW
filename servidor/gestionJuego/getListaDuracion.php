<?php

include_once("../bbdd.php");

$sql="select id, duracion from duracion";

echo json_encode(ejecutaConsultaArray($sql));
?>