<?php

include_once("../bbdd.php");

$sql="select nombre from personas where ACTIVO=1";

$miconexion=connectDB();
$res = $miconexion->prepare($sql);
$res->execute();
$lista=$res->fetchAll(PDO::FETCH_ASSOC);


$res=null;
$miconexion=null;
echo json_encode($lista);

?>