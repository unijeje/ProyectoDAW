<?php

include_once("../bbdd2.php");

$id=$_POST['datos'];


$sql="update personas set ACTIVO=0 where id=?";
$stmt = DB::run($sql, [$id]);
$n=$stmt->rowCount();

if($n > 0)
{
    try
    {
        $sql = "DELETE FROM personas_roles_juegos WHERE PERSONA = ? ";
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