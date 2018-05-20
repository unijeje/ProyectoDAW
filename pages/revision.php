<?php
include("../utilities/utilities.php");
iniciarSesion();
include_once("../servidor/bbdd.php");

$id=$_GET["id"];

$miconexion=connectDB();

$sql="SELECT ID_MODELO, TIPO, NUMERO, FECHA, DESCRIPCION, USUARIO, ANTES, DESPUES from revisiones where ID = ?";
$select= $miconexion->prepare($sql);
$select->execute(array($id));
$revision=$select->fetch(PDO::FETCH_ASSOC);


$sql="SELECT NOMBRE from cuentas where ID = ?";
$select= $miconexion->prepare($sql);
$select->execute(array($revision["USUARIO"]));
$cuenta=$select->fetch(PDO::FETCH_ASSOC);

$nombre_usuario=$cuenta["NOMBRE"];

switch($revision["TIPO"])
{
    case "J":
        $sql="SELECT TITULO, SINOPSIS, FECHA, ENLACE, DURACION from juego where ID = ?";
        $select= $miconexion->prepare($sql);
        $select->execute(array($revision["ID_MODELO"]));
        $datosJuego=$select->fetch(PDO::FETCH_ASSOC);
        $nombre = $datosJuego["TITULO"];
        break;
}



$antes = json_decode($revision["ANTES"]);
$despues = json_decode($revision["DESPUES"]);
$antesArray = (array) $antes;
$despuesArray = (array) $despues;


cabecera($datosJuego["TITULO"]." - Revisión ".$revision["NUMERO"]);
navBar();


echo "<center>";
echo "<h2>Información: </h2>";
echo "<table class='table table-responsive'>";
echo "<tr class='text-left'><th>Revisión: </th><td>".$revision["TIPO"].$revision["ID_MODELO"].".".$revision["NUMERO"]."</td></tr>";
if($revision["TIPO"] == "J")
    echo "<tr class='text-left'><th>Nombre: </th><td><a href='juego.php?id=".$revision["ID_MODELO"]."'>".$nombre."</a></td></tr>";
else
{
    
}
echo "<tr class='text-left'><th>Fecha: </th><td>".$revision["FECHA"]."</td></tr>";
echo "<tr class='text-left'><th>Usuario: </th><td><a href='perfil.php?id=".$revision["USUARIO"]."'>".$nombre_usuario."</a></td></tr>";
echo "<tr class='text-left'><th>Descripción: </th><td>".$revision["DESCRIPCION"]."</td></tr>";

echo "</table>";



echo "<h2>Cambios: </h2>";

if($revision!=null)
{
    switch($revision["TIPO"])
    {
        case "J":

            if(isset($antes) && !is_int($antes) && property_exists($antes, "nombre"))
            {
                
                echo "<table class='table table-responsive'>";
                echo "<tr><th>Propiedad</th><th>Antes</th><th>Despues</th></tr>";

                if($antesArray["nombre"] == $despuesArray["nombre"])
                {
                    echo "<tr>";
                    echo "<td>Título</td>";
                    echo "<td>".$antesArray["nombre"]."</td>";
                    echo "<td>".$despuesArray["nombre"]."</td>";
                }
                else
                {
                    echo "<tr class='table-danger'>";
                    echo "<td>Título</td>";
                    echo "<td>".$antesArray["nombre"]."</td>";
                    echo "<td>".$despuesArray["nombre"]."</td>";
                }
                echo "</tr>";

                if($antesArray["sinopsis"] == $despuesArray["sinopsis"])
                {
                    echo "<tr>";
                    echo "<td>Sinopsis</td>";
                    echo "<td>".$antesArray["sinopsis"]."</td>";
                    echo "<td>".$despuesArray["sinopsis"]."</td>";
                }
                else
                {
                    echo "<tr class='table-danger'>";
                    echo "<td>Sinopsis</td>";
                    echo "<td>".$antesArray["sinopsis"]."</td>";
                    echo "<td>".$despuesArray["sinopsis"]."</td>";
                }
                echo "</tr>";

                if($antesArray["enlace"] == $despuesArray["enlace"])
                {
                    echo "<tr>";
                    echo "<td>Enlace</td>";
                    echo "<td>".$antesArray["enlace"]."</td>";
                    echo "<td>".$despuesArray["enlace"]."</td>";
                }
                else
                {
                    echo "<tr class='table-danger'>";
                    echo "<td>Enlace</td>";
                    echo "<td>".$antesArray["enlace"]."</td>";
                    echo "<td>".$despuesArray["enlace"]."</td>";
                }
                echo "</tr>";

                if($antesArray["fecha"] == $despuesArray["fecha"])
                {
                    echo "<tr>";
                    echo "<td>Fecha de salida</td>";
                    echo "<td>".$antesArray["fecha"]."</td>";
                    echo "<td>".$despuesArray["fecha"]."</td>";
                }
                else
                {
                    echo "<tr class='table-danger'>";
                    echo "<td>Fecha de salida</td>";
                    echo "<td>".$antesArray["fecha"]."</td>";
                    echo "<td>".$despuesArray["fecha"]."</td>";
                }
                echo "</tr>";

                if($antesArray["duracion"]>= 0 || $despuesArray["duracion"] >= 0)
                {
                    $sql = "SELECT ID, DURACION FROM duracion";
                    $duracion= $miconexion->prepare($sql);
                    $duracion->execute();
                    $listaDuracion=$duracion->fetchAll(PDO::FETCH_ASSOC);
                    foreach($listaDuracion as $key => $value)
                    {
                        if($listaDuracion[$key]["ID"] == $antesArray["duracion"])
                        {
                            $antesArray["duracion"] = $listaDuracion[$key]["DURACION"];
                        }
                        if($listaDuracion[$key]["ID"] == $despuesArray["duracion"])
                        {
                            $despuesArray["duracion"] = $listaDuracion[$key]["DURACION"];
                        }
                    }
                } 

                if($antesArray["duracion"] == $despuesArray["duracion"])
                {
                    echo "<tr>";
                    echo "<td>Duración</td>";
                    echo "<td>".$antesArray["duracion"]."</td>";
                    echo "<td>".$despuesArray["duracion"]."</td>";
                }
                else
                {
                    echo "<tr class='table-danger'>";
                    echo "<td>Duración</td>";
                    echo "<td>".$antesArray["duracion"]."</td>";
                    echo "<td>".$despuesArray["duracion"]."</td>";
                }
                echo "</tr>";

                $sql = "SELECT ID, GENERO FROM generos";
                $duracion= $miconexion->prepare($sql);
                $duracion->execute();
                $listaGeneros=$duracion->fetchAll(PDO::FETCH_ASSOC);

                $generosAntes = count($antesArray["generos"]);
                $generosDesp = count($despuesArray["generos"]);

                $count = max($generosAntes, $generosDesp);

                foreach($antesArray["generos"] as $key=>$value)
                {
                    $antesArray["generos"][$key] = $listaGeneros[$value-1]["GENERO"];
                }
                foreach($despuesArray["generos"] as $key=>$value)
                {
                    $despuesArray["generos"][$key] = $listaGeneros[$value-1]["GENERO"];
                }

                for($i=0;$i<$count;$i++)
                {
                    $genAnt = isset($antesArray["generos"][$i]) ? $antesArray["generos"][$i] : "";
                    $genDesp = isset($despuesArray["generos"][$i]) ? $despuesArray["generos"][$i] : "";
                    
                    if($genAnt == $genDesp && $genAnt != "")
                    {
                        echo "<tr>";
                        echo "<td>Género ".($i+1)."</td>";
                        echo "<td>".$genAnt."</td>";
                        echo "<td>".$genDesp."</td>";

                        echo "</tr>";
                    }
                    //if($genAnt != $genDesp && $genAnt != "")
                    else
                    {
                        echo "<tr class='table-danger'>";
                        echo "<td>Género ".($i+1)."</td>";
                        echo "<td>".$genAnt."</td>";
                        echo "<td>".$genDesp."</td>";

                        echo "</tr>";
                    }
                }

                
                echo "</table>";

            }
            else if(isset($antes) && !is_int($antes) && property_exists($antes, "arrayCompany"))
            {
                echo "información compañias juego";
            }
            else if(isset($antes) && !is_int($antes) && property_exists($antes, "roles"))
            {
                echo "información staff juego";
            }
            else if(isset($antes) && !is_int($antes) && property_exists($antes, "plat"))
            {
                echo "información plataformas juego";
            }
            break;
        case "C":

            break;
        
        case "S":

            break;

        case "P":

            break;

        default:

            break;
    }
}


echo "</center>";


?>