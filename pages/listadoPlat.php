<?php

include("../controller/listadoPlat.php");

?>
<div id="registroError">
    <h2 class="text-danger">Ha habido un error en la busqueda </h2>
</div>
<div id="busqueda">
    <h1>Buscar Plataforma</h1>
    
    <div class="form-group row">
        <input type="text" class="form-control col-lg-8 col-12 offset-0 mr-2" id="txtBusqueda" placeholder="" name="txtBusqueda">
        <input type="button" id="btnBusqueda" class="btn btn-primary col-lg-3 col-12  mobile-margin-top" value="Busqueda" />
    </div>
    <!-- <div class="form-group row">
        <input type="button" id="btnFiltro" class="btn btn-primary col-2 offset-5 text-center my-3" value="Filtros" />
    </div> -->
</div>

<div id="listado" class="col-12 mt-5">
    <?php
        echo '<div class="list-group ">';
        foreach($filaPlataforma as $fila)
        {
            $idActual=$fila["id"];
            echo '<a href="plataforma.php?id='.$idActual.'" class="list-group-item list-group-item-action elementoListado">'.$fila["nombre"].' &emsp; '.$fila["company"].' &emsp; '.$fila["fecha"].'</a>';
        }

        echo '</div>';

    
    
    ?>
</div>
<div id="paginacion" class="mt-5 ml-5">
    <?php
    echo $listado->pages->page_links();
    ?>
</div>

<script type="text/javascript" src="../js/ListadoPlat.js"></script>
<?php
$miconexion=null;
pie();
?>
