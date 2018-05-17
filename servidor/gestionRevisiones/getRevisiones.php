<?php
include_once("../bbdd.php");

$datos=json_decode($_GET["datos"]);

$id = $datos->id;
$tipo = $datos->tipo;

$miconexion=connectDB();

$sql="SELECT r.ID, r.NUMERO, r.FECHA, r.DESCRIPCION, c.NOMBRE, c.id as PERFIL FROM revisiones r INNER JOIN cuentas c on r.usuario=c.id WHERE r.ID_MODELO = ? and r.TIPO = ? order by r.FECHA";
$select = $miconexion->prepare($sql);
$select->execute(array($id, $tipo));

$devolver=$select->fetchAll(PDO::FETCH_ASSOC);

$select=null;
$miconexion=null;

echo json_encode($devolver);

?>