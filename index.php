
<?php
include("utilities/utilities.php");
iniciarSesion();
cabeceraIndex("VideoJuegos BBDD");
navBarIndex();
if(isset($_COOKIE["nombre"]))
    echo "Value is: " . $_COOKIE["nombre"];
else
    echo "no cookie";

?>




<?php
pie();
?>