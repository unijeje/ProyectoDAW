<?php

include_once("../bbdd.php");

$sql="SELECT ID, TITULO, FECHA from juego where ACTIVO=1";

//$res=ejecutaConsultaArray($sql);
$miconexion=connectDB();
$res = $miconexion->query("SELECT ID, TITULO, FECHA from juego where ACTIVO=1")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($res);

?>