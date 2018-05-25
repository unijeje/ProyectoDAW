<?php


include_once("../bbdd.php");


$revision = json_decode($_POST["revision"]);

// echo "<pre>";
// print_r($revision);
// echo "</pre>";

$datos = $revision->datos;
$user = $revision->usuario;
$tipo = $revision->tipo;
$id = $revision->idModelo;

echo json_encode(altaRevision($datos, $user, $tipo, $id));

function altaRevision($datos, $user, $tipo, $id)
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

    switch($tipo)
    {
        case "P":
            $modeo="plataforma";
            break;
        case "J":
            $modelo="juego";
            break;
        case "C":
            $modelo="compañía";
            break;
        case "S":
            $modelo="staff";
            break;
    }

    $descripcion = "Creación de entrada de $modelo.";

    $antes = "0";
    $despues = $datos;

    try
    {
        $miconexion=connectDB();
        /*
        $sql = "SELECT max(numero) as numero from revisiones where tipo = ? and id_modelo = ? ";

        $select = $miconexion->prepare($sql);

        $select->execute(array($tipo, $id));

        $fila = $select->fetch(PDO::FETCH_ASSOC);
        */
        $numero=1;


        // if($numero == -1)
        // {
        //     $exito[0] = false;
        //     $exito[1] = "Fallo al buscar la id de revisión con este tipo de datos.";
        //     return $exito;
        // }
        
        $sql = "INSERT INTO revisiones(TIPO, ID_MODELO, NUMERO, FECHA, DESCRIPCION, USUARIO, ANTES, DESPUES) values (?, ?, ?, ?, ?, ?, ?, ?)";

        $insert = $miconexion->prepare($sql);

        $insert->execute(array($tipo, $id, $numero, $fecha, $descripcion, $user, $antes, $despues));

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
        $exito[1] = "Fallo inesperado al insertar.".$e->getMessage();
    }

    return $exito;

}

?>