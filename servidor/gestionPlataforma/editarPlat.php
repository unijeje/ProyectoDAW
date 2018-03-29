<?php

include_once("../bbdd.php");
$oDatos=json_decode($_POST['datos']);
$id=$oDatos->id;
$nombre=$oDatos->nombre;
$company=$oDatos->company;
$desc=$oDatos->desc;
$fecha=$oDatos->fecha;
$esp=$oDatos->esp;

$miconexion=connectDB();
$miconexion->beginTransaction(); 

try{



    $sql="select ID from company where NOMBRE=? ";

    $selectCompany=$miconexion->prepare($sql);
    $selectCompany->execute(array($company));
    if($selectCompany->rowCount()>0)
    {
        $fila=$selectCompany->fetch();
        $company=$fila["ID"];
        
        $sqlUpdate="update plataforma set NOMBRE=? , COMPANY=? , Fecha=? , DESCRIPCION=? , ESPECIFICACIONES=? where id=? ";
        $update=$miconexion->prepare($sqlUpdate);
        $update->execute(array($nombre, $company, $fecha, $desc, $esp, $id));

        $miconexion->commit();
        $exito = true;
    }
    else
    {
        $exito="Compañía no existe";   
    }


}
catch(PDOException $e)
{
    $miconexion->rollback();
    $exito = $e;
}
echo json_encode($exito); 

?>