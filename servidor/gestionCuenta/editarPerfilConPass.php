<?php
error_reporting(0);
include_once("../bbdd2.php");

$oDatos=json_decode($_POST['datos']);
$usuario=$oDatos->nombre;
$email=$oDatos->correo;
$id=$oDatos->id;
$pass=$oDatos->pass;
$antigua = $oDatos->passAnt;

$res=[];

if($antigua != "")
{
    $sql = "SELECT password from cuentas where id=?";
    
    $stmt=DB::run($sql, [$id]);
    $usuario = $stmt->fetch();

    $claveEncriptada=$usuario["password"];
    
    if(crypt($antigua, $claveEncriptada)==$claveEncriptada)
    {
        $claveEncriptada=crypt($pass);

        $sql="UPDATE cuentas set email=?, password=? where id=?";

        $stmt = DB::run($sql, [$email, $claveEncriptada, $id]);
        $n=$stmt->rowCount();
        if($n>0)
        {
            $res[0]=true;
            $res[1] = "Datos actualizados correctamente.";
        }
        else
        {
            $res[0] = false;
            $res[1] = "Error inesperado al actualizar datos.";
        }
    }
    else
    {
        $res[0] = false;
        $res[1] = "La contraseña que ha introducido no es correcta.";
    }
}

echo json_encode($res); 


?>