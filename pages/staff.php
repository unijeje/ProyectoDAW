<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");
$id_staff=$_GET["id"];
$miconexion=connectDB();
$sql="select nombre, nacionalidad, genero, descripcion, enlace from personas where id=?";
$select=$miconexion->prepare($sql);
$select->execute(array($id_staff));
$fila=$select->fetch();

$sql="SELECT j.id, j.titulo, j.fecha, r.rol, p.comentario 
from juego j, personas_roles_juegos p, roles r 
where p.rol=r.id
and p.juego=j.id
and p.persona=? 
order by j.fecha";
$selectCreditos=$miconexion->prepare($sql);
$selectCreditos->execute(array($id_staff));
$filaCreditos=$selectCreditos->fetchAll(PDO::FETCH_ASSOC);
/*
echo "<pre>";
print_r($filaCreditos);
echo "</pre>";
*/
cabecera($fila["nombre"]);
navBar();
?>
<div id="tabs" style="background: none repeat scroll 0% 0% #dce2df;">
    <ul>
        <li><a href="#mainStaff"><?php echo $fila["nombre"];?></a></li>
        <?php
        if(isset($_SESSION["tipo"]))
        {
        ?>
        <li><a id="editarStaffBtn" href="#editingStaff">Editar</a></li>
        <?php
        }
        ?>
        <li><a href="#revisionesStaff">Revisiones</a></li>
    </ul>
<div id="mainStaff">
    <div id="datosPersona" class="col-10 offset-1">
        <h2 class="text-center"><?php echo $fila["nombre"];?></h2>
        <p class="text-center">Nacionalidad: <?php echo $fila["nacionalidad"];?></p>
        <p class="text-center">Género: <?php echo $fila["genero"];?></p>
        <?php if ($fila["enlace"]!=null)
        echo '<p class="text-center">Enlace: '.$fila["enlace"].'</p>';
        ?>
        <p> <?php echo $fila["descripcion"];?> </p>
    </div>
    <h2 class="mt-5">Créditos</h2>
    <div id="creditosPersona" class="my-2">
        <table class="table table-responsive borderless table-striped">
        <tr>
        <th class="w-75">Título</th><th>Lanzamiento</th><th>Rol</th><th>Comentario</th>
        </tr>
        <?php
        foreach($filaCreditos as $value)
        {
            echo "<tr>";
                echo "<td><a href='juego.php?id=".$value['id']."'>".$value["titulo"]."</a></td><td>".$value["fecha"]."</td><td>".$value["rol"]."</td><td>".$value["comentario"]."</td>";
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
<div id="editingStaff">
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
            <form name="formEditarStaff" id="formEditarStaff" method="get" action"#"> 
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control col-8" id="nombre" placeholder="Nombre completo" name="nombre" value="<?php echo $fila["nombre"];?>">
            </div>
            <div class="form-group">
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" class="form-control col-8" id="nacionalidad" placeholder="nacionalidad" name="nacionalidad" value="<?php echo $fila["nacionalidad"];?>">
            </div>
            <div class="form-group">
                <label for="desc">Descripción:</label>
                <textarea class="form-control col-8" id="desc" rows="5" placeholder="" name="desc" > <?php echo $fila["descripcion"];?></textarea>
            </div>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <?php
                    if ($fila["genero"]=="Masculino")
                    echo '<input type="radio" checked="checked" value="Masculino" name="radioGenero"> Masculino';
                    else
                    echo '<input type="radio" value="Masculino" name="radioGenero"> Masculino';
                    ?>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <?php
                    if ($fila["genero"]=="Femenino")
                    echo '<input type="radio" checked="checked" value="Femenino" name="radioGenero"> Femenino';
                    else
                    echo '<input type="radio" value="Femenino" name="radioGenero"> Femenino';
                    ?>
                </label>
            </div>
            <div class="form-group">
                <label for="enlace">Enlace de interés(wikipedia, twitter, etc):</label>
                <input type="text" class="form-control col-8" id="enlace" placeholder="https://en.wikipedia.org/wiki/Jason_Rubin" name="enlace" value="<?php echo $fila["enlace"];?>">
            </div>

            <br>
            <input type="button" id="btnEditar" class="btn btn-primary col-8" value="Guardar" />
            </form>
            <br><br>
            <?php
            if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="1") //si es administrador
            {
                echo "<form id='borrarStaff' name='borrarStaff'>";
                echo '<input type="button" id="eliminar" class="btn btn-danger col-8" value="Eliminar Persona" />';
                echo "</form>";
            }

            ?>
        </div>   
    </div>
</div>
<?php
}
?>
<div id="revisionesStaff">
    <h3 class="text-center">Revisiones</h3>
    <table class="table table-bordered" id="revisionesListado">
    <tr><th>ID REVISION</th><th>USUARIO</th><th>Descripción</th><th>Fecha</th></tr>
    </table>
</div>

</div>
<div id="dialog-eliminar" title="Eliminar <?php echo $fila["nombre"];?>">
    <p class="text-danger"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro de que quiere eliminar a esta persona?</p>
</div>
<script type="text/javascript">var staff_id = <?php echo $id_staff ?>;</script>
<script type="text/javascript" src="../js/staff.js"></script>
<?php
$miconexion=null;
pie();
?>
