<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");
$id_company=$_GET["id"];
$sql="select nombre, fecha, pais, descripcion, enlace from company where id=".$id_company;
$fila=consultaUnica($sql);
cabecera($fila["nombre"]);
navBar();
?>
<div id="tabs" style="background: none repeat scroll 0% 0% #dce2df;">
    <ul>
        <li><a href="#mainCompany"><?php echo $fila["nombre"];?></a></li>
        <li><a id="editarCompanyBtn" href="#editingCompany">Editar</a></li>
        <li><a href="#revisionesCompany">Revisiones</a></li>
    </ul>
<div id="mainCompany">
    <div id="datosCompany" class="w-75 offset-1">
        <h2 class="text-center"><?php echo $fila["nombre"];?></h2>
        <p class="text-center">Nacionalidad: <?php echo $fila["pais"];?></p>
        <p class="text-center">Fecha: <?php echo $fila["fecha"];?></p>
        <?php if ($fila["enlace"]!=null)
        echo '<p class="text-center">Enlace: '.$fila["enlace"].'</p>';
        ?>
        <p> <?php echo $fila["descripcion"];?> </p>
    </div>
    <h2 class="mt-5">Creditos</h2>
    <div id="creditosCompany" class="my-2">

    </div>
</div>
<div id="editingCompany">
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
            <form name="formEditarCompany" id="formEditarCompany" method="get" action"#"> 
            <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control col-8" id="nombre" placeholder="Nombre completo" name="nombre" value="<?php echo $fila['nombre'];?>"/>
        </div>
        <div class="form-group">
            <label for="pais">Pais:</label>
            <input type="text" class="form-control col-8" id="pais" placeholder="Estados Unidos" name="pais"  value="<?php echo $fila['pais'];?>"/>
        </div>
        <div class="form-group">
            <label for="desc">Descripción:</label>
            <textarea class="form-control col-8" id="desc" rows="5" placeholder="" name="desc"> <?php echo $fila['descripcion'];?></textarea>
        </div>

        <div class="form-group">
            <label for="enlace">Página web:</label>
            <input type="text" class="form-control col-8" id="enlace" placeholder="https://www.naughtydog.com/" name="enlace"  value="<?php echo $fila['enlace'];?>"/>
        </div>
        <div class="form-group">
            <label for="fecha">Año:</label>
            <input type="text" class="form-control col-8" id="fecha" placeholder="1984" name="fecha"  value="<?php echo $fila['fecha'];?>"/>
        </div>
        <br>

        <br>
        <input type="button" id="btnEditar" class="btn btn-primary col-8" value="Guardar" />
        </form>
        <br><br>
        <?php
        if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="1") //si es administrador
        {
            echo "<form id='borrarCompany' name='borrarCompany'>";
            echo '<input type="button" id="eliminar" class="btn btn-danger col-8" value="Eliminar Compañía" />';
            echo "</form>";
        }

            ?>
        </div>   
    </div>
</div>

<div id="revisionesCompany">
<p>Revisiones</p>
</div>

</div>
<div id="dialog-eliminar" title="Eliminar <?php echo $fila["nombre"];?>">
    <p class="text-danger"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro de que quiere eliminar a esta compañía?</p>
</div>
<script type="text/javascript">var company_id = <?php echo $id_company ?>;</script>
<script type="text/javascript" src="../js/company.js"></script>
<?php
pie();
?>
