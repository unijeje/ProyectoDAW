<?php


include_once("../bbdd.php");


$revision = json_decode($_POST["revision"]);

$datosNuevo = $revision->datosNuevo;
$datosAntiguo = $revision->datosAntiguo;
$user = $revision->usuario;
$tipo = $revision->tipo;
$id = $revision->idModelo;
$descripcion = $revision ->descripcion;

echo json_encode(altaRevision($datosNuevo, $datosAntiguo, $user, $tipo, $id, $descripcion));

function altaRevision($datosNuevo, $datosAntiguo, $user, $tipo, $id, $descripcion)
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

    try
    {
        $miconexion=connectDB();

        $sql = "SELECT max(numero) as numero from revisiones where tipo = ? and id_modelo = ?";

        $select = $miconexion->prepare($sql);

        $select->execute(array($tipo, $id));

        $fila = $select->fetch(PDO::FETCH_ASSOC);
    
        $numero=$fila["numero"]+1;


        if($numero == -1)
        {
            $exito[0] = false;
            $exito[1] = "Fallo al buscar la id de revisión con este tipo de datos.";
            return $exito;
        }

        $sql = "INSERT INTO revisiones(TIPO, ID_MODELO, NUMERO, FECHA, DESCRIPCION, USUARIO, ANTES, DESPUES) values (?, ?, ?, ?, ?, ?, ?, ?)";

        $insert = $miconexion->prepare($sql);

        $insert->execute(array($tipo, $id, $numero, $fecha, $descripcion, $user, $datosAntiguo, $datosNuevo));

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