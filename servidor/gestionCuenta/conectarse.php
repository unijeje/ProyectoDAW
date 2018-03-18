<?php

include_once("../bbdd.php");

$oDatos=json_decode($_GET['datos']);
$usuario=$oDatos->nombre;
$pass=$oDatos->pass;

$sql="SELECT id, nombre, password, tipo from cuentas where NOMBRE='$usuario'";

$fila=consultaUnica($sql);


$tipo=$fila["tipo"];
$claveEncriptada=$fila["password"];
$nombre=$fila["nombre"];
$id=$fila["id"];

if(isset($tipo))
{

    if(crypt($pass, $claveEncriptada)==$claveEncriptada)
    {
        $exito=true;
        $mensaje=$tipo;
        include("../../utilities/manejadorSesiones.php");
    }
    else
    {
        $exito=false;
        $mensaje="Contraseña Incorrecta";
    }

}
else
{
    $exito = false;
    $mensaje="No se ha encontrado el usuario";
}


$respuesta=array($exito, $mensaje, $nombre, $id);

echo json_encode($respuesta); 

?>