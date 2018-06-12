<?php

include_once("../bbdd.php");

$sql = $_GET["datos"];

//$res=ejecutaConsultaArray($sql);
$miconexion=connectDB();
$res = $miconexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($res);

?>