<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Añadir Staff");
navBar();
include_once("../servidor/bbdd.php");
$limit=9;

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit; 

/*3 Filas dividir limit entre 3 y hacer 3 tablas */
$resPorTabla=$limit/3;

$sql="SELECT id, nombre from company where ACTIVO=1 order by nombre LIMIT $start_from, $limit";
$resultset=ejecutaConsulta($sql);
?>
<div id="registroError">
    <h2 class="text-danger">Ha habido un error en la busqueda </h2>
</div>
<div id="busqueda">
    <h1>Buscar Compañía</h1>
    
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
        while($fila=$resultset->fetch(PDO::FETCH_ASSOC))
        {
            if($i==$resPorTabla)
            {
                echo '</div>';
                echo '<div class="list-inline text-center col-12">';
                echo "<br>";
                $i=0;
            }
            $idActual=$fila["id"];
            echo '<li class="list-inline-item elementoListado"><a href="company.php?id='.$idActual.'" class="list-group-item list-group-item-action">'.$fila["nombre"].'</a></li>';
            $i++;
            
        }

        echo '</div>';

    
    
    ?>
</div>
<div id="paginacion" class="mt-5 ml-5">
    <?php
    $resultset=null;
    $sqlCount="Select count(id) as num from company";
    $fila=consultaUnica($sqlCount);
    $numRes=$fila["num"];
    $numPag=ceil($numRes / $limit);
    $pagLink = "<nav><ul class='pagination'>";  
    for ($i=1; $i<=$numPag; $i++) {  
                    $pagLink .= "<li class='page-item'><a  class='page-link' href='listadoCompany.php?page=".$i."'>".$i."</a></li>";  
    };  
    echo $pagLink . "</ul></nav>";

    ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
    $('.pagination').pagination({
            items: <?php echo $numRes;?>,
            itemsOnPage: <?php echo $limit;?>,
            cssStyle: 'compact-theme',
            currentPage : <?php echo $page;?>,
            hrefTextPrefix : 'listadoCompany.php?page='
        });
        });
</script>
<script type="text/javascript" src="../js/ListadoCompany.js"></script>
<script type="text/javascript" src="../utilities/jquery.simplePagination.js"></script>
<?php
pie();
?>
