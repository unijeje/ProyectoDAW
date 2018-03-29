<?php

include_once("../bbdd.php");

$oDatos=json_decode($_POST['datos']);
$nombre=$oDatos->nombre;
$sinopsis=$oDatos->sinopsis;
$enlace=$oDatos->enlace;
$fecha=$oDatos->fecha;
$company=json_decode($oDatos->arrayCompany);


$miconexion=connectDB();
$miconexion->beginTransaction(); 
try
{
    
    $sql="insert into juego(TITULO, SINOPSIS, FECHA, ENLACE, ACTIVO) values(?, ?, ?, ?, 1)";
    $accion = $miconexion->prepare($sql);
    $accion->execute(array($nombre, $sinopsis, $fecha, $enlace));
    $idInsert=$miconexion->lastInsertId(); 
    $n=$accion->rowCount();

    if($n > 0)
    {
        $exito = true;
        
        if(trim($company[0])!="")
        {
            $stmt = $miconexion->prepare("INSERT INTO company_juegos (ID_JUEGO, ID_COMPANY) VALUES(?,?)");    
            $accion = $miconexion->prepare("select ID from company where NOMBRE=?");     
            $comapny_ids=[];
            foreach($company as $value)
            {
                $accion->execute(array($value));
                $fila=$accion->fetch();
                $stmt->execute(array($idInsert, $fila["ID"]));
                //$comapny_ids[]=$fila["ID"];
            }

        }

        
        
        
    }

    $miconexion->commit();

}
catch(PDOException $e)
{
    $miconexion->rollback();
    $exito = false;
}

$miconexion=null;

echo json_encode($exito); 

//echo json_encode($sql); 

?>