<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");
$id_plat=$_GET["id"];
$miconexion=connectDB();
$sql="select p.nombre, p.fecha, c.nombre as company, p.descripcion, p.especificaciones from company c, plataforma p where p.company=c.id and p.id=? ";
$select=$miconexion->prepare($sql);
$select->execute(array($id_plat));
$fila=$select->fetch();

//listado juegos por plataforma
$sql="SELECT j.id, j.titulo, j.fecha
from plataforma p, plataforma_juego pj, juego j
where pj.id_juego=j.id
and pj.id_plataforma=p.id
and pj.id_plataforma=? order by j.titulo";
$selectJuegos=$miconexion->prepare($sql);
$selectJuegos->execute(array($id_plat));
$filaJuegos=$selectJuegos->fetchAll(PDO::FETCH_ASSOC);


cabecera($fila["nombre"]);
navBar();
?>
<div id="tabs" style="background: none repeat scroll 0% 0% #dce2df;">
    <ul>
        <li><a href="#mainPlat"><?php echo $fila["nombre"];?></a></li>
        <?php
        if(isset($_SESSION["tipo"]))
        {
        ?>
        <li><a id="editarPlatBtn" href="#editingPlat">Editar</a></li>
        <?php
        }
        ?>
        <li><a href="#revisionesPlataforma">Revisiones</a></li>
    </ul>
<div id="mainPlat">
    <div id="datosCompany" class="col-10 offset-1">
        <h2 class="text-center"><?php echo $fila["nombre"];?></h2>
        <p class="text-center">Compañía: <?php echo $fila["company"];?></p>
        <p class="text-center">Lanzamiento: <?php echo $fila["fecha"];?></p>
        <p> <?php echo $fila["descripcion"];?> </p>
        <h3>Especificaciones</h3>
        <p> <?php echo $fila["especificaciones"];?> </p>
    </div>
    <h2 class="mt-5">Lista de juegos</h2>
    <div id="creditosCompany" class="my-2">
        <table class="table borderless table-striped">
        <tr>
        <th class="w-75">Título</th><th>Lanzamiento</th>
        </tr>
        <?php
        foreach($filaJuegos as $value)
        {
            echo "<tr>";
                echo "<td><a href='juego.php?id=".$value['id']."'>".$value["titulo"]."</a></td><td>".$value["fecha"]."</td>";
            echo "</tr>";
        }
        ?>
        </table>
    </div>
</div>
<?php
if(isset($_SESSION["tipo"]))
{
?>
<div id="editingPlat">
    <div id="registrado" class="col-8">
        <h2>Editado correctamente</h2>
        <br>
    </div>
    <div id="registroError" class="col-8">
        <h2 class="text-danger">Error al editar</h2>
        <br>
    </div>

    <h1>Editar <?php echo $fila["nombre"];?> </h1>
    <br>
    <div id="guidelines" class="col-8">
    <p> Si tiene alguna duda consulte la <a href="faq.php">FAQ</a></p>
    <p> Antes de añadir consulte si ya existe en la base de datos </p>
    </div>
    <br>
    <div id="registrar" class="row">
        <div class="col-12 ">
            <form name="formEditarPlat" id="formEditarPlat" method="get" action"#"> 
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control col-8" id="nombre" placeholder="Nombre completo" name="nombre" value="<?php echo $fila["nombre"];?>"/>
        </div>
        <div class="form-group">
            <label for="company">Compañía:</label>
            <input type="text" class="form-control col-8" id="company" placeholder="Sony" name="company" value="<?php echo $fila["company"];?>"/>
            <input type="hidden" id="company-name">
        </div>
        <div class="form-group">
            <label for="desc">Descripción:</label>
            <textarea class="form-control col-8" id="desc" rows="5" placeholder="" name="desc"><?php echo $fila["descripcion"];?></textarea>
        </div>

        <div class="form-group">
            <label for="esp">Especificaciones:</label>
            <textarea class="form-control col-8" id="esp" rows="5" placeholder="" name="esp"><?php echo $fila["especificaciones"];?></textarea>
        </div>
        <div class="form-group">
            <label for="fecha">Año:</label>
            <input type="text" class="form-control col-8" id="fecha" placeholder="1984" name="fecha" value="<?php echo $fila["fecha"];?>"/>
        </div>
        <br>

        <br>
        <input type="button" id="btnEditar" class="btn btn-primary col-8" value="Guardar" />
        </form>
        <br><br>
        <?php
        if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="1") //si es administrador
        {
            echo "<form id='borrarPlat' name='borrarPlat'>";
            echo '<input type="button" id="eliminar" class="btn btn-danger col-8" value="Eliminar Plataforma" />';
            echo "</form>";
        }

            ?>
        </div>   
    </div>
</div>
<?php
}
?>
<div id="revisionesPlataforma">
    <h3 class="text-center">Revisiones</h3>
    <table class="table table-bordered" id="revisionesListado">
    <tr><th>ID REVISION</th><th>USUARIO</th><th>Descripción</th><th>Fecha</th></tr>
    </table>
</div>

</div>
<div id="dialog-eliminar" title="Eliminar <?php echo $fila["nombre"];?>">
    <p class="text-danger"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro de que quiere eliminar a esta plataforma?</p>
</div>
<script type="text/javascript">var plat_id = <?php echo $id_plat ?>;</script>
<script type="text/javascript" src="../js/plataforma.js"></script>
<?php
$miconexion=null;
pie();
?>
