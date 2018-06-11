<?php
include("controller/index.php");

?>
<div class="row">
<div id="intro" class="offset-1 col-10 mb-3 text-monospace">
    <h2 class="text-center">Bienvenido a VJDB</h2>
    <p id="intro">Proyecto final 2º DAW Juan Mallén. El objetivo de este proyecto es recopilar información relacionada con videojuegos y permitir a los usuarios tener un seguimiento de los videojuegos que ha jugado. </p>
</div>
<div id="imagenes" class="col-12 mb-5 text-center">
    <?php
    echo $datos->imagenHtml;
    ?>
</div>
</div>

<div class="row">
<div id="buscador" class="offset-2 col-8 mb-5">
    
        <input type="text" class="form-control col-10 offset-1 my-3" id="txtBusqueda" placeholder="buscador. Dejar en blanco para buscar todo" name="txtBusqueda" />
        <div class="form-check-inline offset-3">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" value="juego" name="busqRadio">Juego
        </label>
        </div>
        <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" value="comp" name="busqRadio">Compañía
        </label>
        </div>
        <div class="form-check-inline ">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" value="staff" name="busqRadio">Personas
        </label>
        </div> 
        <div class="form-check-inline ">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" value="plat" name="busqRadio">Plataformas
        </label>
        </div>
        <div class="form-check-inline ">
        <label class="form-check-label">
            <input checked type="radio" class="form-check-input " value="todos" name="busqRadio">Todos
        </label>
        </div>  
        <input type="button" id="btnBusqueda" class="btn btn-primary col-2 offset-5 mt-3" value="Busqueda" />
    
</div>
</div>
<div class="row">
    <div id="revisiones" class="col-4">
        <p>Ultimas Revisiones</p>
        <?php
        echo $datos->revHtml;
        ?>
    </div>
    <div id="comentarios" class="col-4">
        <p>Ultimos Comentarios</p>
        <?php
        echo $datos->commentHtml;
        ?>
    </div>
    <div id="juegos" class="col-4">
        <p>Random Juegos</p>
        <?php
        echo $datos->juegosHtml;
        ?>
    </div>
</div>
<div class="row mb-5">
</div>
<script type="text/javascript" src="js/index.js"></script>
<?php
pie();
?>