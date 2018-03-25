<?php

include_once("../bbdd.php");

$id_juego=$_GET["datos"];

$sql="SELECT nombre from company c inner join company_juegos j on c.id=j.id_company and j.id_juego=$id_juego";

echo json_encode(ejecutaConsultaArray($sql));

?>