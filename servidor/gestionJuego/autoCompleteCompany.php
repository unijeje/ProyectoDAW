<?php

include_once("../bbdd.php");

$sql="SELECT nombre, pais, fecha from company where ACTIVO=1";

$res=ejecutaConsultaArray($sql);

echo json_encode($res);

?>