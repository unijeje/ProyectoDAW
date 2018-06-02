<?php
include("../controller/company.php");

?>
<div id="tabs" style="background: none repeat scroll 0% 0% #dce2df;">
    <ul>
        <li><a href="#mainCompany"><?php echo $company->getNombre();?></a></li>
        <?php
        if(isset($_SESSION["tipo"]))
        {
        ?>
        <li><a id="editarCompanyBtn" href="#editingCompany">Editar</a></li>
        <?php
        }
        ?>
        <li><a href="#revisionesCompany">Revisiones</a></li>
    </ul>
<div id="mainCompany">
    <div id="datosCompany" class="col-10 offset-1">
        <h2 class="text-center"><?php echo $company->getNombre();?></h2>
        <p class="text-center">Nacionalidad: <?php echo $company->getPais();?></p>
        <p class="text-center">Fecha: <?php echo $company->getFecha();?></p>
        <?php if ($company->getEnlace()!=null)
        echo '<p class="text-center">Enlace: '.$company->getEnlace().'</p>';
        ?>
        <p> <?php echo $company->getDescripcion();?> </p>
    </div>
    <h2 class="mt-5">Creditos</h2>
    <div id="accordion">
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapseJuego">
                Juegos
                </a>
            </div>
            <div id="collapseJuego" class="collapse show" data-parent="#accordion">
                <div class="card-body">
                    <table class="table borderless table-striped">
                    <tr>
                    <th class="w-75">Título</th><th>Lanzamiento</th><th>Nota</th>
                    </tr>
                    <?php
                    foreach($company->getJuegos() as $value)
                    {
                        echo "<tr>";
                            echo "<td><a href='juego.php?id=".$value['id']."'>".$value["titulo"]."</a></td><td>".$value["fecha"]."</td><td>".$value["media"];
                        echo "</tr>";
                    }
                    echo '</table>';
                    echo $company->pages->page_links('?', '&id='.$id_company);
                    ?>
                </div>
            </div>
        </div>
        <?php
        if($company->getPlataformas()!=null)
        {
        ?>
        <div class="card">
            <div class="card-header">
                <a class="card-link my-2" data-toggle="collapse" href="#collapsePlat">
                Plataformas
                </a>
            </div>
            <div id="collapsePlat" class="collapse show" data-parent="#accordion">
                <div class="card-body">
                    <table class="table borderless table-striped">
                    <tr>
                    <th class="w-75">Título</th><th>Lanzamiento</th>
                    </tr>
                    <?php
                    foreach($company->getPlataformas() as $value)
                    {
                        echo "<tr>";
                            echo "<td><a href='plataforma.php?id=".$value['id']."'>".$value["nombre"]."</a></td><td>".$value["fecha"]."</td>";
                        echo "</tr>";
                    }
                    ?>
                    </table>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    
        
            
    
</div>
<?php
if(isset($_SESSION["tipo"]))
{
?>
<div id="editingCompany">
    <div id="registrado" class="col-8">
        <h2>Editado correctamente</h2>
        <br>
    </div>
    <div id="registroError" class="col-8">
        <h2 class="text-danger">Error al editar</h2>
        <br>
    </div>

    <h1>Editar <?php echo $company->getNombre();?> </h1>
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
            <input type="text" class="form-control col-8" id="nombre" placeholder="Nombre completo" name="nombre" value="<?php echo $company->getNombre();?>"/>
        </div>
        <div class="form-group">
            <label for="pais">Pais:</label>
            <input type="text" class="form-control col-8" id="pais" placeholder="Estados Unidos" name="pais"  value="<?php echo $company->getPais();?>"/>
        </div>
        <div class="form-group">
            <label for="desc">Descripción:</label>
            <textarea class="form-control col-8" id="desc" rows="5" placeholder="" name="desc"> <?php echo $company->getDescripcion();?></textarea>
        </div>

        <div class="form-group">
            <label for="enlace">Página web:</label>
            <input type="text" class="form-control col-8" id="enlace" placeholder="https://www.naughtydog.com/" name="enlace"  value="<?php echo $company->getDescripcion();?>"/>
        </div>
        <div class="form-group">
            <label for="fecha">Año:</label>
            <input type="text" class="form-control col-8" id="fecha" placeholder="1984" name="fecha"  value="<?php echo $company->getFecha();?>"/>
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
<?php
}
?>
<div id="revisionesCompany">
    <h3 class="text-center">Revisiones</h3>
    <table class="table table-bordered" id="revisionesListado">
    <tr><th>ID REVISION</th><th>USUARIO</th><th>Descripción</th><th>Fecha</th></tr>
    </table>
</div>

</div>
<div id="dialog-eliminar" title="Eliminar <?php echo $company->getNombre();?>">
    <p class="text-danger"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro de que quiere eliminar a esta compañía?</p>
</div>

<script type="text/javascript">var company_id = <?php echo $id_company ?>;
var user_id= <?php echo isset($_SESSION["id"]) ? $_SESSION["id"] : -1 ;?>;</script>
<script type="text/javascript" src="../js/company.js"></script>
<?php
pie();
?>
