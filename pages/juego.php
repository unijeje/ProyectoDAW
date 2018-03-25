<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");
$id_juego=$_GET["id"];

$miconexion=connectDB();
$sql="select titulo, sinopsis, fecha, enlace, duracion from juego where id=?";

$rsJuego=$miconexion->prepare($sql);
$rsJuego->execute(array($id_juego));
$filaJuego=$rsJuego->fetch(PDO::FETCH_ASSOC);


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

//fetch duracion

if($filaJuego["duracion"]!=null)
{
    $sql="select duracion from duracion where id=?";
    $rsDuracion=$miconexion->prepare($sql);
    $rsDuracion->execute(array($filaJuego['duracion']));
    $filaDuracion=$rsDuracion->fetch(PDO::FETCH_ASSOC);
    $rsDuracion=null;
}



cabecera($filaJuego["titulo"]);
navBar();
if($filaJuego!=null)
{
?>

<div id="tabs" style="background: none repeat scroll 0% 0% #dce2df;">
    <ul>
        <li><a href="#mainJuego"><?php echo $filaJuego["titulo"];?></a></li>
        <li><a id="editarJuegoBtn" href="#editingJuego">Editar</a></li>
        <li><a href="#comentariosJuego">Comentarios</a></li>
        <li><a href="#revisionesJuego">Revisiones</a></li>
    </ul>
<div id="mainJuego">
    <div class="row">
        <div id="coverJuego" class="col-3">
        <!-- fetch img name from table and call in gameCover folder with that name -->
            <p>Cover img </p>
        </div>
        <div id="informacionJuego" class="row col-6 offset-1">
            <table class ="table table-dark table-responsive borderless">
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
            ?>
            <tr><td>Enlace</td><td><?php echo $filaJuego["enlace"];?></td></tr>
            <?php
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
                            echo "<td><a class='text-primary' href='company.php?id=".$value['id_plataforma']."'>".$value['nombre']."</a></td>";
                            echo "</tr>";
                        }
                        else
                        echo "<td><a class='text-primary' href='company.php?id=".$value['id_plataforma']."'>".$value['nombre']."</a></td>";
                        $i++;
                    }
                    
                echo "</tr>";
            }
            ?>
            </table>
            
        </div>
        <p class="col-6 offset-2 mt-3"><?php echo $filaJuego["sinopsis"];?></p>
        <p  class="col-10 offset-1 mt-5">Fotos</p>
    </div>

    <h2 class="mt-5">Staff</h2>
    <div id="creditosJuego" class="my-2">
        <p>Creditos</p>

    </div>
</div>
<div id="editingJuego">
    <div id="registrado">
        <h2>Editado correctamente</h2>
        <br>
    </div>
    <div id="registroError">
        <h2 class="text-danger">Error al editar</h2>
        <br>
    </div>

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
        <?php
            if($_SESSION["tipo"]=="1") //si es administrador
            {
                echo '<li class="nav-item">';
                    echo '<a class="nav-link" data-toggle="pill" href="#del">Eliminar</a>';
                echo '</li>';
            }
        ?>
    </ul>

   
    <br>
    <div id="guidelines" class="col-8">
        <p> Si tiene alguna duda consulte la <a href="faq.php">FAQ</a></p>
        <p> Antes de añadir consulte si ya existe en la base de datos </p>
    </div>
     <!-- Tab panes -->
     <div class="tab-content">
        <div class="tab-pane active container" id="info">
            <p>Información</p>
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

            <input type="button" id="btnEditarPlat" class="btn btn-primary col-8 mt-5" value="Guardar Cambios" />  
            </form>
        </div>
        <div class="tab-pane container" id="staff">
            <p>Staff</p>
        </div>
        <div class="tab-pane container" id="staff">
            <p>Staff</p>
        </div>
        <?php
            if($_SESSION["tipo"]=="1") //si es administrador
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
<script type="text/javascript">var juego_id = <?php echo $id_juego ;?>; var plats_id= <?php echo $idsPlataforma ;?>;</script>
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
