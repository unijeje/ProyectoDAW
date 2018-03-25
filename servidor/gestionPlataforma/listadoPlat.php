<?php

include_once("../bbdd.php");


$sql="SELECT id, nombre from plataforma where ACTIVO=1 order by nombre desc";
echo json_encode(ejecutaConsultaArray($sql));
?>