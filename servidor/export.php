<?php
include("bbdd2.php");

if(isset($_POST["export"]))
{
    $sql = "SELECT j.id, j.titulo, v.nota, v.fecha from juego j inner join votos v on j.id=v.juego where v.cuenta=? order by v.fecha ";
    $id = $_POST["id"];
    $nombre = $_POST["usuario"];

    $salida = '';

    $stmt = DB::run($sql, [$id]);
    if($stmt->rowCount() > 0)
    {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $salida .= '
            <table class="table" bordered="1">
                <tr>
                    <th>Fecha</th>
                    <th>Id Juego</th>
                    <th>Titulo</th>
                    <th>Nota</th>
                </tr>        
        ';

        foreach($rows as $key=>$value)
        {
            $salida .= '
                <tr>
                    <td>'.$value["fecha"].'</td>
                    <td>'.$value["id"].'</td>
                    <td>'.$value["titulo"].'</td>
                    <td>'.$value["nota"].'</td>
                </tr>
            ';
        }

        $salida .='</table>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$nombre.'_'.$id.'.xls');
        echo $salida;

    }
    else
    {
        echo "<h2>Tiene que tener algún voto para poder exportar</h2>";
    }


}

?>