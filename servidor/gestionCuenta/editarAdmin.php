<?php

include_once("../bbdd2.php");

$oDatos=json_decode($_POST['datos']);
$activo=$oDatos->activo;
$tipo=$oDatos->tipo;
$id=$oDatos->id;


$sql="UPDATE cuentas set ACTIVO=?, TIPO=? where id=? ";

$res=[];
try
{
    $stmt = DB::run($sql, [$activo, $tipo, $id]);
    $n=$stmt->rowCount();
    
    if($n>0)
    {
        $res[0]=true;
        $res[1] = "Datos actualizados correctamente.";
    }
    else
    {
        $res[0] = false;
        $res[1] = "No se han actualizado los datos.";
    }
}
catch(PDOException $e)
{
    $res[0] = false;
    $res[1] = "Error inesperado actualizando datos. ".$e->getMessage();
}


echo json_encode($res); 

?>