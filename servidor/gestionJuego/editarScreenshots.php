<?php

include_once("../bbdd.php");



/*Crea directorio si no existe*/

$rutaDirectorio = '../../img/screenshots/juego_'.$_POST["id_juego"]; 

if (!file_exists($rutaDirectorio)) {
    mkdir($rutaDirectorio, 0777, true);
}

$idJuego = $_POST["id_juego"];
$count = count($_FILES['image']['name']);

if($count>10)
{
    $exito[0]=false;
    $exito[1]="Numero de imágenes pérmitido superado.";
    echo json_encode($exito); 
    exit();
}

$tmnMax=5000000; //5mb
$valid_extensions = array('jpeg', 'jpg', 'png');

$exito[0]=true;
$exito[1] = "Imagen insertada con éxito";

foreach ($_FILES['image']['name'] as $key=>$value)
{

    $imgName = basename($_FILES["image"]["name"][$key]);

    $ext = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

    $insertName="screenshot".$key.".png";


    if(!in_array($ext, $valid_extensions))
    {
        $exito[0]=false;
        $exito[1]="Extensión no valida";
        
    }
    else if($_FILES["image"]["size"][$key]>$tmnMax)
    {
        $exito[0]=false;
        $exito[1]="Tamaño máximo superado";
    }
    else
    {
        
        if(!move_uploaded_file($_FILES["image"]["tmp_name"][$key], $rutaDirectorio."/".$insertName))
        {
            $exito[0]=false;
            $exito[1]="Not uploaded because of error #".$_FILES["image"]["error"][$i];

        }
        else
        {
            $exito[]=$insertName;
        }
        
    }

}

echo json_encode($exito); 

?>