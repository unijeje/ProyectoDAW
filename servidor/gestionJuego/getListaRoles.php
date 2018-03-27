<?php

include_once("../bbdd.php");

$sql="SELECT id, rol from roles";

$miconexion=connectDB();
$stmt=$miconexion->prepare($sql);
$stmt->execute();
$res=$stmt->fetchAll();
echo json_encode($res);

?>