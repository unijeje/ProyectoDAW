<?php
include("../controller/listadoCompany.php");

?>
<div id="registroError">
    <h2 class="text-danger">Ha habido un error en la busqueda </h2>
</div>
<div id="busqueda">
    <h1>Buscar Compañía</h1>
    
    <div class="form-group row">
        <input type="text" class="form-control col-9" id="txtBusqueda" placeholder="" name="txtBusqueda">
        <input type="button" id="btnBusqueda" class="btn btn-primary col-2 ml-2" value="Busqueda" />
    </div>
    <div class="form-group row">
        <input type="button" id="btnFiltro" class="btn btn-primary col-2 offset-5 text-center my-3" value="Filtros" />
    </div>
</div>

<div id="listado" class="col-12 mt-5">
    <?php
        echo '<div class="list-group ">';
        foreach($filaCompany as $fila)
        {
            $idActual=$fila["id"];
            echo '<a href="company.php?id='.$idActual.'" class="list-group-item list-group-item-action elementoListado">'.$fila["nombre"].' &emsp; '.$fila["pais"].' &emsp; '.$fila["fecha"].'</a>';
           
        }
        echo '</div>';
    ?>
</div>

<div id="paginacion" class="mt-5 ml-5">
    <?php
    echo $listado->pages->page_links();
    ?>
</div>

<script type="text/javascript" src="../js/ListadoCompany.js"></script>
<?php
pie();
?>
