<?php

function connectDB() 
{
    try 
    {
        $opc=array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dsn="mysql:host=localhost;dbname=videojuegos";
        $usuario="root";
        $contrasena="";
        $base=new PDO($dsn,$usuario,$contrasena,$opc);
    }
    catch (PDOException $e)
    {
        die ("Error".$e->getMessage());
        $resultado=null;
    }
    return $base;
}

function ejecutaConsulta($sql)
{
		//recibe una cadena conteniendo una instruccion SELECT y devuelve un resultset
		
		$miconexion=connectDB();
		return $miconexion->query($sql);
		
}

function ejecutaConsulta2($sql)
{
		//recibe una cadena conteniendo una instruccion SELECT y devuelve el numero de filas de una select
		
		$miconexion=connectDB();
		$resultset= $miconexion->query($sql);
		return $resultset->fetchColumn();
		
}
function ejecutaConsultaArray($sql)
{

		//recibe una cadena conteniendo una instruccion SELECT y devuelve un array con la fila de datos
		$datos=[];
		$resultset=ejecutaConsulta($sql);
		while($fila=$resultset->fetch(PDO::FETCH_ASSOC))
		{
			$datos[]=$fila;
		}
		return $datos;
		

}
function ejecutaConsultaAccion($sql)
{
		/*recibe una cadena conteniendo una instruccion DML, la ejecuta y
		devuelve el nº de filas afectadas por dicha instruccion*/
		$miconexion=connectDB();
		$accion = $miconexion->prepare($sql);
		$accion->execute();
		return $accion->rowCount();
		//return "1";
}
function devuelveUltimaId($tabla){
		$miconexion=connectDB();
		$consulta="SELECT MAX(id) as lastId from $tabla";
		$resultset=ejecutaConsulta($consulta);
		$id=$resultset->fetch(PDO::FETCH_ASSOC);
		
		return $id['lastId'];
}
?>