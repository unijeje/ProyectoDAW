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
        $nombre = "<tr class='text-left'><th>Nombre: </th><td><a href='juego.php?id=".$revision["ID_MODELO"]."'>".$datosJuego["TITULO"]."</a></td></tr>";
        cabecera($datosJuego["TITULO"]." - Revisión ".$revision["NUMERO"]);
        break;
    case "C":
        $sql="SELECT NOMBRE, DESCRIPCION, FECHA, PAIS, ENLACE from company where ID = ?";
        $select= $miconexion->prepare($sql);
        $select->execute(array($revision["ID_MODELO"]));
        $datosCompany=$select->fetch(PDO::FETCH_ASSOC);
        $nombre = "<tr class='text-left'><th>Nombre: </th><td><a href='company.php?id=".$revision["ID_MODELO"]."'>".$datosCompany["NOMBRE"]."</a></td></tr>";
        cabecera($datosCompany["NOMBRE"]." - Revisión ".$revision["NUMERO"]);
        break;
    case "P":
        $sql="SELECT NOMBRE, COMPANY, FECHA, DESCRIPCION, ESPECIFICACIONES from plataforma where ID = ?";
        $select= $miconexion->prepare($sql);
        $select->execute(array($revision["ID_MODELO"]));
        $datosPlataforma=$select->fetch(PDO::FETCH_ASSOC);
        $nombre = "<tr class='text-left'><th>Nombre: </th><td><a href='plataforma.php?id=".$revision["ID_MODELO"]."'>".$datosPlataforma["NOMBRE"]."</a></td></tr>";
        cabecera($datosPlataforma["NOMBRE"]." - Revisión ".$revision["NUMERO"]);
        break;
    case "S":
        $sql="SELECT NOMBRE, NACIONALIDAD, GENERO, DESCRIPCION, ENLACE from personas where ID = ?";
        $select= $miconexion->prepare($sql);
        $select->execute(array($revision["ID_MODELO"]));
        $datosStaff=$select->fetch(PDO::FETCH_ASSOC);
        $nombre = "<tr class='text-left'><th>Nombre: </th><td><a href='staff.php?id=".$revision["ID_MODELO"]."'>".$datosStaff["NOMBRE"]."</a></td></tr>";
        cabecera($datosStaff["NOMBRE"]." - Revisión ".$revision["NUMERO"]);
        break;
}



$antes = json_decode($revision["ANTES"]);
$despues = json_decode($revision["DESPUES"]);
$antesArray = (array) $antes;
$despuesArray = (array) $despues;

navBar();

echo "<center>";
echo "<h2>Información: </h2>";
echo "<table class='table table-responsive'>";
echo "<tr class='text-left'><th>Revisión: </th><td>".$revision["TIPO"].$revision["ID_MODELO"].".".$revision["NUMERO"]."</td></tr>";
echo $nombre;
echo "<tr class='text-left'><th>Fecha: </th><td>".$revision["FECHA"]."</td></tr>";
echo "<tr class='text-left'><th>Usuario: </th><td><a href='perfil.php?id=".$revision["USUARIO"]."'>".$nombre_usuario."</a></td></tr>";
echo "<tr class='text-left'><th>Descripción: </th><td>".$revision["DESCRIPCION"]."</td></tr>";

echo "</table>";



echo "<h2>Información: </h2>";

if($revision!=null)
{
    switch($revision["TIPO"])
    {
        case "J":

            if(isset($antes) && !is_int($antes) && property_exists($antes, "nombre"))
            {                
                echo "<table class='table table-bordered'>";
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
                echo "<h2>Antes</h2>";
                echo "<ul class='list-group'>";
                foreach($antesArray["arrayCompany"] as $key=>$value)
                {
                    echo "<li class='list-group-item'>".$value."</li>";
                }
                echo "</ul>";
                echo "<h2>Después</h2>";
                echo "<ul class='list-group'>";
                foreach($despuesArray["arrayCompany"] as $key=>$value)
                {
                    echo "<li class='list-group-item'>".$value."</li>";
                }
                echo "</ul>";
            }
            else if(isset($antes) && !is_int($antes) && property_exists($antes, "roles"))
            {
                unset($antesArray["id"]);
                unset($despuesArray["id"]);
                echo "información staff juego<br>";
                // $sql = "SELECT select s.NOMBRE, s.ID, PRJ.comentario, r.ROL"
                echo "<table class='table table-bordered'>";
                echo "<tr><th></th><th>Nombres</th><th>Roles</th><th>Comentario</th></tr>";
                $count = max(count($antesArray["nombres"]), count($despuesArray["nombres"]));
                echo count($despuesArray);
                for ($i=0;$i<$count;$i++)
                {
                    
                    if(isset($antesArray["nombres"][$i]) && isset($despuesArray["nombres"][$i]) && $antesArray["nombres"][$i] == $despuesArray["nombres"][$i] && $antesArray["roles"][$i] == $despuesArray["roles_nomb"][$i] && $antesArray["coment"][$i] == $despuesArray["coment"][$i])
                    {
                        $difference = false;
                    }
                    else
                    {
                        $difference = true;
                    }
                    if($difference)
                    {
                        echo "<tr class='table-danger'>";
                    }
                    else
                    {
                        echo "<tr>";
                    }
                    
                    echo "<td>antes</td>";
                    if(!isset($antesArray["nombres"][$i]))
                    {
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                    }
                    else
                    {

                        echo "<td>".$antesArray["nombres"][$i]."</td>";
                        echo "<td>".$antesArray["roles"][$i]."</td>";
                        echo "<td>".$antesArray["coment"][$i]."</td>";
                    }
                    echo "</tr>";
                    if($difference)
                    {
                        echo "<tr class='table-danger'>";
                    }
                    else
                    {
                        echo "<tr>";
                    }
                    echo "<td>después</td>";
                    if(!isset($despuesArray["nombres"][$i]))
                    {
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                    }
                    else
                    {
                        echo "<td>".$despuesArray["nombres"][$i]."</td>";
                        echo "<td>".$despuesArray["roles_nomb"][$i]."</td>";
                        echo "<td>".$despuesArray["coment"][$i]."</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
                
            }
            else if(isset($antes) && !is_int($antes) && property_exists($antes, "plat"))
            {
                if(count($antesArray["plat"])<1)
                {
                    $despuesPlat = implode(", ", $despuesArray["plat"]);
                    $sql = "SELECT id, nombre from plataforma where id in (".$despuesPlat.")";
                    $select= $miconexion->prepare($sql);
                    $select->execute();
                    $plat=$select->fetchAll(PDO::FETCH_ASSOC);
                    echo "<h2>Nuevas Plataformas</h2>";
                    echo "<ul class='list-group'>";
                    foreach($plat as $key=>$value)
                    {
                        if(in_array($value["id"], $despuesArray["plat"]))
                        {
                            echo "<li class='list-group-item'>".$value["nombre"]."</li>";
                        }
                    }
                    echo "</ul>";
                }
                else
                {             
                    $antesPlat = implode(", ", $antesArray["plat"]);
                    $despuesPlat = implode(", ", $despuesArray["plat"]);
                    $sql = "SELECT id, nombre from plataforma where id in (".$antesPlat.", ".$despuesPlat.")";
                    $select= $miconexion->prepare($sql);
                    $select->execute();
                    $plat=$select->fetchAll(PDO::FETCH_ASSOC);

                    echo "<h2>Antes</h2>";
                    echo "<ul class='list-group'>";
                    foreach($plat as $key=>$value)
                    {
                        if(in_array($value["id"], $antesArray["plat"]))
                        {
                            
                            echo "<li class='list-group-item'>".$value["nombre"]."</li>";
                            
                        }
                    }
                    echo "</ul>";

                    echo "<h2>Después</h2>";
                    echo "<ul class='list-group'>";
                    foreach($plat as $key=>$value)
                    {
                        if(in_array($value["id"], $despuesArray["plat"]))
                        {
                            
                            echo "<li class='list-group-item'>".$value["nombre"]."</li>";
                            
                        }
                    }
                    echo "</ul>";
                }

            }
            else
            {
                echo "<table class='table table-bordered'>";
                echo "<tr><th>Propiedad</th><th>Despues</th></tr>";
                foreach($despuesArray as $key=>$value)
                {
                    if($key == "arrayCompany")
                    {
                        foreach($value as $key2=>$company)
                        {
                            echo "<tr>";
                            echo "<td>Compañía</td>";
                            echo "<td>".$company."</td>";
                            echo "</tr>";
                        }
                    }
                    else
                    {
                        echo "<tr>";
                        echo "<td>".$key."</td>";
                        echo "<td>".$despuesArray[$key]."</td>";
                        echo "</tr>";
                    }
                    
                }
                echo "</table>";
            }
            break;
        case "C":
            if(!isset($antesArray["id"]))
            {
                echo "<table class='table table-bordered'>";
                echo "<tr><th>Propiedad</th><th>Despues</th></tr>";
                foreach($despuesArray as $key=>$value)
                {
                    echo "<tr>";
                    echo "<td>".$key."</td>";
                    echo "<td>".$despuesArray[$key]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else
            {
                unset($antesArray["id"]);
                unset($despuesArray["id"]);

                echo "<table class='table table-bordered'>";
                echo "<tr><th>Propiedad</th><th>Antes</th><th>Despues</th></tr>";
                foreach($antesArray as $key=>$value)
                {
                    if($antesArray[$key] != $despuesArray[$key])
                    {
                        echo "<tr class='table-danger'>";
                    }
                    else
                    {
                        echo "<tr>";
                    }
                    echo "<td>".$key."</td>";
                    echo "<td>".$antesArray[$key]."</td>";
                    echo "<td>".$despuesArray[$key]."</td>";
                    echo "</tr>";
                }
            }

            
            echo "</table>";

            break;
        
        case "S":
            if(!isset($antesArray["id"]))
            {
                echo "<table class='table table-bordered'>";
                echo "<tr><th>Propiedad</th><th>Despues</th></tr>";
                foreach($despuesArray as $key=>$value)
                {
                    echo "<tr>";
                    echo "<td>".$key."</td>";
                    echo "<td>".$despuesArray[$key]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else
            {
                unset($antesArray["id"]);
                unset($despuesArray["id"]);

                echo "<table class='table table-bordered'>";
                echo "<tr><th>Propiedad</th><th>Antes</th><th>Despues</th></tr>";
                foreach($antesArray as $key=>$value)
                {
                    if($antesArray[$key] != $despuesArray[$key])
                    {
                        echo "<tr class='table-danger'>";
                    }
                    else
                    {
                        echo "<tr>";
                    }
                    echo "<td>".$key."</td>";
                    echo "<td>".$antesArray[$key]."</td>";
                    echo "<td>".$despuesArray[$key]."</td>";
                    echo "</tr>";
                }
            }

            
            echo "</table>";
            break;
        case "P":
            if(!isset($antesArray["id"]))
            {
                echo "<table class='table table-bordered'>";
                echo "<tr><th>Propiedad</th><th>Despues</th></tr>";
                foreach($despuesArray as $key=>$value)
                {
                    echo "<tr>";
                    echo "<td>".$key."</td>";
                    echo "<td>".$despuesArray[$key]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else
            {
                unset($antesArray["id"]);
                unset($despuesArray["id"]);

                echo "<table class='table table-bordered'>";
                echo "<tr><th>Propiedad</th><th>Antes</th><th>Despues</th></tr>";
                foreach($antesArray as $key=>$value)
                {
                    if($antesArray[$key] != $despuesArray[$key])
                    {
                        echo "<tr class='table-danger'>";
                    }
                    else
                    {
                        echo "<tr>";
                    }
                    echo "<td>".$key."</td>";
                    echo "<td>".$antesArray[$key]."</td>";
                    echo "<td>".$despuesArray[$key]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            break;

        default:
            echo "<h2>Error no controlado. No se ha encontrado el modelo de datos.</h2>";
            break;
    }
}


echo "</center>";

echo "<pre>";
print_r($antesArray);
echo "</pre>";

?>