﻿<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");
$id_plat=$_GET["id"];
$sql="select p.nombre, p.fecha, c.nombre as company, p.descripcion, p.especificaciones from company c, plataforma p where p.company=c.id and p.id=".$id_plat;
$fila=consultaUnica($sql);
cabecera($fila["nombre"]);
navBar();
?>
<div id="tabs" style="background: none repeat scroll 0% 0% #dce2df;">
    <ul>
        <li><a href="#mainPlat"><?php echo $fila["nombre"];?></a></li>
        <li><a id="editarPlatBtn" href="#editingPlat">Editar</a></li>
        <li><a href="#revisionesPlataforma">Revisiones</a></li>
    </ul>
<div id="mainPlat">
    <div id="datosCompany" class="w-75 offset-1">
        <h2 class="text-center"><?php echo $fila["nombre"];?></h2>
        <p class="text-center">Compañía: <?php echo $fila["company"];?></p>
        <p class="text-center">Fecha: <?php echo $fila["fecha"];?></p>
        <p> <?php echo $fila["descripcion"];?> </p>
        <h3>Especificaciones</h3>
        <p> <?php echo $fila["especificaciones"];?> </p>
    </div>
    <h2 class="mt-5">Lista de juegos</h2>
    <div id="creditosCompany" class="my-2">

    </div>
</div>
<div id="editingPlat">
    <div id="registrado">
        <h2>Editado correctamente</h2>
        <br>
    </div>
    <div id="registroError">
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
        if($_SESSION["tipo"]=="1") //si es administrador
        {
            echo "<form id='borrarPlat' name='borrarPlat'>";
            echo '<input type="button" id="eliminar" class="btn btn-danger col-8" value="Eliminar Plataforma" />';
            echo "</form>";
        }

            ?>
        </div>   
    </div>
</div>

<div id="revisionesPlataforma">
<p>Revisiones</p>
</div>

</div>
<div id="dialog-eliminar" title="Eliminar <?php echo $fila["nombre"];?>">
    <p class="text-danger"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro de que quiere eliminar a esta plataforma?</p>
</div>
<script type="text/javascript">var plat_id = <?php echo $id_plat ?>;</script>
<script type="text/javascript" src="../js/plataforma.js"></script>
<?php
pie();
?>