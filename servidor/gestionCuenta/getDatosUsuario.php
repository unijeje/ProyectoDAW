<?php



function getDatosUsuario($clave)
{
    $miconexion=connectDB();

    $sql="SELECT nombre, tipo, id from cuentas where clave=? ";
    $select=$miconexion->prepare($sql);
    $select->execute(array($clave));
    $fila=$select->fetch(PDO::FETCH_ASSOC);
    
    $res=array("id"=>$fila["id"], "nombre"=>$fila["nombre"], "tipo"=>$fila["tipo"]);
    return $res;
}

?>