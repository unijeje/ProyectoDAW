<?php

include_once("../bbdd.php");

$sql="SELECT ID, TITULO, FECHA from juego where ACTIVO=1";

$res=ejecutaConsultaArray($sql);

echo json_encode($res);

?>