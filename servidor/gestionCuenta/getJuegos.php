<?php

include_once("../bbdd.php");

$sql="SELECT j.id, j.titulo, v.nota, v.fecha, j.cover from juego j inner join votos v on j.id=v.juego where v.cuenta=? order by v.fecha";

//$res=ejecutaConsultaArray($sql);
$miconexion=connectDB();
$res = $miconexion->prepare($sql);
$res->execute(array($_GET["datos"]));
$lista=$res->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($lista);

?>