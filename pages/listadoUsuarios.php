<?php
include("../controller/listadoUsuarios.php");
?>
<div id="registroError">
    <h2 class="text-danger">Ha habido un error en la busqueda </h2>
</div>
<div id="busqueda">
    <h1>Buscar Usuario</h1>
    
    <div class="form-group row">
        <input type="text" class="form-control col-10" id="txtBusqueda" placeholder="" name="txtBusqueda">
        <input type="button" id="btnBusqueda" class="btn btn-primary col-1 ml-2" value="Busqueda" />
    </div>
    <div class="form-group row">
        <input type="button" id="btnFiltro" class="btn btn-primary col-2 offset-5 text-center my-3" value="Filtros" />
    </div>
</div>

<div id="listado" class="col-12 mt-5">
    <?php
        $i=0;
        echo '<div class="list-inline text-center col-12">';
        foreach($filaCuentas as $fila)
        {
            if($i==$resPorTabla)
            {
                echo '</div>';
                echo '<div class="list-inline text-center col-12">';
                echo "<br>";
                $i=0;
            }
            $idActual=$fila["id"];
            echo '<li class="list-inline-item elementoListado"><a href="perfil.php?id='.$idActual.'" class="list-group-item list-group-item-action">'.$fila["nombre"].'</a></li>';
            $i++;
            
        }

        echo '</div>';

    
    
    ?>
</div>
<div id="paginacion" class="mt-5 ml-5">
    <?php
    echo $listado->pages->page_links();

    ?>
</div>

<script type="text/javascript" src="../js/listadoUsuarios.js"></script>
<?php
pie();
?>
