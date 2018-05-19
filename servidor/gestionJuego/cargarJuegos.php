<?php

include_once("../bbdd.php");

$sql="SELECT ID, TITULO, FECHA, MEDIA from juego where ACTIVO=1";

//$res=ejecutaConsultaArray($sql);
$miconexion=connectDB();
$res = $miconexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($res);

?>