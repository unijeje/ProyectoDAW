<?php

include_once("../bbdd.php");

$tmnMax=5000000; //5mb
$valid_extensions = array('jpeg', 'jpg', 'png');

$imgName = basename($_FILES["image"]["name"]);
$target="../../img/covers/";

$ext = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

$insertName=$_POST["id_juego"].".png";


if(!in_array($ext, $valid_extensions))
{
    $exito="Extensión no valida";
}
else if($_FILES["image"]["size"]>$tmnMax)
{
    $exito="Tamaño máximo superado";
}
else
{
    
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target.$insertName))
    {
        $exito=true;
        $miconexion=connectDB();
        $sql="update juego set COVER=1 where ID=? ";
        $accion=$miconexion->prepare($sql);
        $accion->execute(array($_POST["id_juego"]));
        $accion=null;
        $miconexion=null;
    }
    else
    {
        $exito="Not uploaded because of error #".$_FILES["image"]["error"];
    }
    
}

echo json_encode($exito); 

?>