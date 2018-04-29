<?php
include("utilities/utilities.php");
cabeceraIndex("VideoJuegos BBDD");
iniciarSesion();
navBarIndex();


if(isset($_COOKIE["nombre"]))
    echo "Value is: " . $_COOKIE["nombre"];
else
    echo "no cookie";

?>




<?php
//pie();
?>