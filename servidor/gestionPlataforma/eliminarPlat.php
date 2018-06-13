<?php

include_once("../bbdd2.php");

$id=$_POST['datos'];


$sql="update plataforma set ACTIVO=0 where id=?";
$stmt = DB::run($sql, [$id]);
$n=$stmt->rowCount();


if($n > 0)
{
    try
    {
        $sql = "DELETE FROM plataforma_juego WHERE ID_PLATAFORMA = ? ";
        $stmt = DB::run($sql, [$id]);

        $exito = true;
    }
    catch(PDOException $e)
    {
        $exito = false;
    }
}
else
    $exito = false;

echo json_encode($exito); 

?>