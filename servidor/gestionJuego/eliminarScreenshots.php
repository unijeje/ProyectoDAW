<?php

$exito = false;

$rutaDirectorio = '../../img/screenshots/juego_'.$_POST["datos"]; 

$files = glob($rutaDirectorio.'/*.png'); // obtiene todos los png
foreach($files as $file){
  if(is_file($file)) // si se trata de un archivo
    unlink($file); // lo elimina
}

$exito=true;

echo json_encode($exito);

?>