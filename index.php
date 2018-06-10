<?php
include("controller/index.php");

?>
<div class="row">
<div id="intro" class="offset-1 col-10 mb-3 text-monospace">
    <h2 class="text-center">Bienvenido a VJDB</h2>
    <p>Proyecto final 2º DAW Juan Mallén. El objetivo de este proyecto es recopilar información relacionada con videojuegos y sus autores y hacerla accesible de manera asequible a todo el mundo.</p>
</div>
<div id="imagenes" class="col-12 mb-5 text-center">
    <?php
    echo $datos->imagenHtml;
    ?>
</div>
</div>

<div class="row">
<div id="buscador" class="offset-2 col-8 mb-5">
    <p>Buscador</p>
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
    </div>
</div>
<div class="row mb-5">
</div>
<script type="text/javascript" src="js/index.js"></script>
<?php
pie();
?>