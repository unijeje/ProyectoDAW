<?php


include_once("../bbdd.php");


$revision = json_decode($_POST["revision"]);

$datos = $revision->datos;
$user = $revision->usuario;
$tipo = $revision->tipo;

echo json_encode(altaRevision($datos, $user, $tipo));

function altaRevision($datos, $user, $tipo)
{
    /*
    TIPO: 
    P > PLATAFORMA
    J > JUEGO
    C > COMPAÑIA
    S > STAFF
    */
    $numero = -1; //select where tipo es P y max number

    $fecha = date('Y-m-d H:i:s');

    $descripcion = "Creación de entrada de plataforma.";

    $antes = "0";
    $despues = $datos;

    try
    {
        $miconexion=connectDB();

        $sql = "SELECT max(numero) as numero from revisiones where tipo = ? ";

        $select = $miconexion->prepare($sql);

        $select->execute(array($tipo));

        $fila = $select->fetch(PDO::FETCH_ASSOC);
    
        $numero=$fila["numero"]+1;


        if($numero == -1)
        {
            $exito[0] = false;
            $exito[1] = "Fallo al buscar la id de revisión con este tipo de datos.";
            return $exito;
        }

        $sql = "INSERT INTO revisiones(TIPO, NUMERO, FECHA, DESCRIPCION, USUARIO, ANTES, DESPUES) values (?, ?, ?, ?, ?, ?, ?)";

        $insert = $miconexion->prepare($sql);

        $insert->execute(array($tipo, $numero, $fecha, $descripcion, $user, $antes, $despues));

        $n = $insert->rowCount();
    
        $select = null;
        $insert = null;
        $miconexion = null;

        if($n > 0)
            $exito[0] = true;
        else
        {
            $exito[0] = false;
            $exito[1] = "Fallo inesperado al insertar.";
        }

    }
    catch(PDOEXCEPTION $e)
    {
        $exito[0] = false;
        $exito[1] = "Fallo inesperado al insertar.";
    }

    return $exito;

}

?>