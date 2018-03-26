<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");
$id_juego=$_GET["id"];

$miconexion=connectDB();
$sql="select titulo, sinopsis, fecha, enlace, cover, duracion from juego where id=?";

$rsJuego=$miconexion->prepare($sql);
$rsJuego->execute(array($id_juego));
$filaJuego=$rsJuego->fetch(PDO::FETCH_ASSOC);
if($filaJuego["duracion"]!=null)
{
    $duracionJuego=$filaJuego["duracion"];
}
else
    $duracionJuego=-1;

$sql="select c.nombre, c.id from company c inner join company_juegos j on c.id=j.id_company and j.id_juego=?";
$rsCompany=$miconexion->prepare($sql);
$rsCompany->execute(array($id_juego));
$filaCompany=$rsCompany->fetchAll();

/*
echo "<pre>";
print_r($filaCompany);
echo "</pre>";
*/

//fetch comentarios

//fetch generos
$sql="SELECT g.id, g.genero from generos g inner join generos_juego j on g.id=j.id_genero and j.id_juego=?";
$rsGenero=$miconexion->prepare($sql);
$rsGenero->execute(array($id_juego));
$filaGeneros=$rsGenero->fetchAll();
if($filaGeneros!=null)
{
    foreach($filaGeneros as $value)
        $idsGenero[]=$value["id"];
    
    $idsGenero=json_encode($idsGenero);
}
else
    $idsGenero=json_encode(array(-1));

//fetch plataformas
$sql="SELECT id_plataforma, p.nombre from plataforma_juego j inner join plataforma p on j.id_plataforma=p.id and id_juego=?";
$rsPlataforma=$miconexion->prepare($sql);
$rsPlataforma->execute(array($id_juego));
$filaPlataforma=$rsPlataforma->fetchAll();
if($filaPlataforma!=null)
{
    foreach($filaPlataforma as $value)
        $idsPlataforma[]=$value["id_plataforma"];
    
    $idsPlataforma=json_encode($idsPlataforma);
}
else
    $idsPlataforma=json_encode(array(-1));

//fetch staff

if($filaJuego["duracion"]!=null)
{
    $sql="select duracion from duracion where id=?";
    $rsDuracion=$miconexion->prepare($sql);
    $rsDuracion->execute(array($filaJuego['duracion']));
    $filaDuracion=$rsDuracion->fetch(PDO::FETCH_ASSOC);
    $rsDuracion=null;
}

//fetch votos
if(isset($_SESSION["tipo"]))
{
    $sql="select nota from votos where JUEGO=? and CUENTA=? ";
    $rsVoto=$miconexion->prepare($sql);
    $rsVoto->execute(array($id_juego, $_SESSION["id"]));
    $filaVoto=$rsVoto->fetch();
    if($filaVoto["nota"]!=null)
    {
        $votoJuego=$filaVoto["nota"];
    }
}

cabecera($filaJuego["titulo"]);
navBar();
if($filaJuego!=null)
{
?>

<div id="tabs" style="background: none repeat scroll 0% 0% #dce2df;">
    <ul>
        <li><a href="#mainJuego"><?php echo $filaJuego["titulo"];?></a></li>
        <?php
        if(isset($_SESSION["tipo"]))
        { 
        echo '<li><a id="editarJuegoBtn" href="#editingJuego">Editar</a></li>';
        }?>
        <li><a href="#comentariosJuego">Comentarios</a></li>
        <li><a href="#revisionesJuego">Revisiones</a></li>
    </ul>
<div id="mainJuego">
    <div class="row">
        <div id="coverJuego" class="offset-1 col-2">
            <?php
            if($filaJuego["cover"]!=null)
            {
                echo "<img id='imgCover' class='mt-4' src='../img/covers/".$id_juego.".png'>";
            }
            ?>
        </div>
        <div id="informacionJuego" class="row col-6 offset-1">
            <table class ="table table-responsive borderless">
            <tr><td>Fecha</td><td><?php echo $filaJuego["fecha"];?></td></tr>

            
            <?php
            if($filaJuego["duracion"])
            {
                echo '<tr><td>Duración</td><td>'. $filaDuracion["duracion"].' horas</td></tr>';
                
            }
            if($filaCompany!=null)
            {
                
                echo "<tr>";
                    echo '<td rowspan="'.count($filaCompany).'">Compañía</td>';
                    $i=0;
                    foreach($filaCompany as $value)
                    {
                        if($i!=0)
                        {
                            echo "<tr>";
                            echo "<td><a class='text-primary' href='company.php?id=".$value['id']."'>".$value['nombre']."</a></td>";
                            echo "</tr>";
                        }
                        else
                        echo "<td><a class='text-primary' href='company.php?id=".$value['id']."'>".$value['nombre']."</a></td>";
                        $i++;
                    }
                    
                echo "</tr>";
            }
            if($filaGeneros!=null)
            {
                echo "<tr>";
                echo "<td>Generos</td>";
                echo "<td>";
                $generosHtml="";
                foreach($filaGeneros as $value)
                {
                    $generosHtml.=$value['genero'].", ";
                }
                $generosHtml=substr($generosHtml, 0, -2);
                echo $generosHtml;
                echo "</td>";
                echo "</tr>";
            }

            if($filaPlataforma!=null)
            {
                
                echo "<tr>";
                    echo '<td rowspan="'.count($filaPlataforma).'">Plataformas</td>';
                    $i=0;
                    foreach($filaPlataforma as $value)
                    {
                        if($i!=0)
                        {
                            echo "<tr>";
                            echo "<td><a class='text-primary' href='plataforma.php?id=".$value['id_plataforma']."'>".$value['nombre']."</a></td>";
                            echo "</tr>";
                        }
                        else
                        echo "<td><a class='text-primary' href='plataforma.php?id=".$value['id_plataforma']."'>".$value['nombre']."</a></td>";
                        $i++;
                    }
                    
                echo "</tr>";
            }
            if(isset($_SESSION["tipo"]))
            {
                echo '<div class="form-group">';
                echo "<tr>";
                echo "<td>Su Voto</td>";
                echo "<td>";
                echo '<select class="form-control col-12" size="1" id="nota" name="nota">';
                    if($filaVoto["nota"]==null)
                        echo "<option value='nada'>No ha votado</option>";
                    else
                        echo "<option value='revoke'>Eliminar Nota</option>";
                    for($i=1;$i<=10;$i++)
                    {
                        if($filaVoto["nota"]!=null && $i==$filaVoto["nota"])
                            echo "<option selected value='".$i."'>".$i."</option>";
                        else
                            echo "<option value='".$i."'>".$i."</option>";
                    }
                echo "</select>";
                echo "</td>";
                echo "</tr>";
                echo "</div>";
            }
            ?>
            <tr><td>Enlace</td><td><a class='text-primary' target="_blank" href="<?php echo $filaJuego["enlace"];?>"><?php echo $filaJuego["enlace"];?></a></td></tr>

            </table>
            
        </div>
        <p class="col-10 offset-1 mt-3"><?php echo $filaJuego["sinopsis"];?></p>
        <p  class="col-10 offset-1 mt-5">Fotos</p>
    </div>

    <h2 class="mt-5">Staff</h2>
    <div id="creditosJuego" class="my-2">
        <p>Creditos</p>

    </div>
</div>
<?php
if(isset($_SESSION["tipo"]))
{?>
<div id="editingJuego">
    

    <h1>Editar <?php echo $filaJuego["titulo"];?> </h1>
    <!-- Nav tabs -->
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#info">Información</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#comp">Compañías</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#plat">Plataformas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#staff">Staff</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#images">Imágenes</a>
        </li>
        <?php
            if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="1")//si es administrador
            {
                echo '<li class="nav-item">';
                    echo '<a class="nav-link" data-toggle="pill" href="#del">Eliminar</a>';
                echo '</li>';
            }
        ?>
    </ul>

   
    <br>
    <div id="registrado">
        <h2>Editado correctamente</h2>
    </div>
    <div id="registroError" class="col-8">
        <h2>Error al editar</h2>
        <p></p>  
    </div>
    <br>
    <div id="guidelines" class="col-8">
        <p> Si tiene alguna duda consulte la <a href="faq.php">FAQ</a></p>
        <p> Antes de añadir consulte si ya existe en la base de datos </p>
    </div>
     <!-- Tab panes -->
     <div class="tab-content">
        <div class="tab-pane active container" id="info">
            <form name="formEditInfo" id="formEditInfo" method="get" action"#"> 
                <div class="form-group mt-3">
                    <label for="nombre">Título: *</label>
                    <input type="text" class="form-control col-8" id="nombre" placeholder="Nombre completo" name="nombre" value="<?php echo $filaJuego['titulo'];?>" />          
                </div>
                <div class="form-group">
                    <label for="sinopsis">Sinopsis:</label>
                    <textarea class="form-control col-8" id="sinopsis" rows="5" placeholder="" name="sinopsis"> <?php echo $filaJuego['sinopsis'];?></textarea>
                </div>

                <div class="form-group">
                    <label for="enlace">Enlace de interés(Página oficial, wikipedia, etc):</label>
                    <input type="text" class="form-control col-8" id="enlace" placeholder="https://www.crashbandicoot.com/es" name="enlace" value="<?php echo $filaJuego['enlace'];?>" />
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="text" class="form-control col-8" id="fecha" placeholder="yy-mm-dd" name="fecha" value="<?php echo $filaJuego['fecha'];?>" />
                </div>
                <div class="form-group">
                    <label for="generos">Seleccione los generos:</label>
                    <select multiple class="form-control col-8" size="3" id="generos" name="generos">
                    
                    </select>
                </div>
                <div class="form-group">
                    <label for="duracion">Horas para pasarse el juego:</label>
                    <select class="form-control col-8"  id="duracion" name="duracion">
                    
                    </select>
                </div>
                
                <br>
                <input type="button" id="btnEditInfo" class="btn btn-primary col-8 mb-5" value="Guardar Cambios" />
        </form>
        </div>


        <div class="tab-pane container" id="comp">
            <form name="formEditCompany" id="formEditCompany" method="get" action"#" class="mt-4">
            <div class="text-center col-8">
                <input type="button" id="btnCompany" class="btn btn-primary col-8" value="Añadir Otra Compañía" />  
            </div>
            <input type="button" id="btnEditarCompany" class="btn btn-primary col-8 mt-5" value="Guardar Cambios" />  
            </form>
        </div>
        <div class="tab-pane container" id="plat">
        <form name="formEditPlat" id="formEditPlat" method="get" action"#" class="mt-4">
            <div class="form-group" id="checkboxPlataformas">

            </div>
            <input type="button" id="btnEditarPlat" class="btn btn-primary col-8 mt-5" value="Guardar Cambios" />  
        </form>
        </div>
        <div class="tab-pane container" id="staff">
            <p>Staff</p>
        </div>
        <div class="tab-pane container" id="images">
            <form name="formEditarImg" id="formEditarImg">
            <div class="form-group mt-3">
                <label for="imgJuegoCover">Imagen Cover:</label>
                <div class="custom-file" id="customFile" lang="es">
                    <input type="file" class="custom-file-input col-8" id="imgJuegoCover" aria-describedby="fileHelp">
                    <label class="custom-file-label col-8" for="imgJuegoCover">
                    Select file...
                    </label>
                </div>
                <input type="button" id="btnEditarCover" class="btn btn-primary col-8 mt-2" value="Guardar Nueva Cover" />
                <input type="button" id="btnEliminarCover" class="btn btn-danger col-8 mt-2" value="Eliminar Cover" />    
            </div>
            
            </form>
        </div>
        <?php
            if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="1") //si es administrador
            {
                echo '<div class="tab-pane container" id="del">';
                    echo "<form id='borrarJuego' name='borrarJuego'>";
                    echo '<input type="button" id="eliminar" class="btn btn-danger col-8 mt-3" value="Eliminar Juego" />';
                    echo "</form>";
                echo '</div>';
            }
        ?>
    </div>

</div>
<?php
}
?>
<div id="revisionesJuego">
<p>Revisiones</p>
</div>
<div id="comentariosJuego">
<p>Comentarios</p>
</div>
</div>
<div id="dialog-eliminar" title="Eliminar <?php echo $filaJuego["titulo"];?>">
    <p class="text-danger"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro de que quiere eliminar este juego?</p>
</div>
<script type="text/javascript">var juego_id = <?php echo $id_juego ;?>; var plats_id= <?php echo $idsPlataforma ;?>; var generos_id= <?php echo $idsGenero ;?>; 
var duracion_id= <?php echo $duracionJuego ;?>;
var user_id= <?php echo $_SESSION["id"] ;?>;
</script>
<script type="text/javascript" src="../js/juego.js"></script>
<script type="text/javascript" src="../js/ListadoStaff.js"></script>
<?php
}
else
{
    echo "<h3>No se ha encontrado el juego</h3>";
}
$rsJuego=null;
$rsCompany=null;
$miconexion=null;
pie();
?>
