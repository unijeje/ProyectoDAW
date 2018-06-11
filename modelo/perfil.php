<?php

class Perfil
{
    private $miconexion;
    private $id;
    public $pages;
    public $usuario;
    public $fecha;
    public $email;
    public $numTotal;
    public $tipo;
    public $activo;

    function __construct($id_user)
    {
        $this->id = $id_user;
        $this->miconexion=connectDB();
        $this->getDatosUsuario();
        $this->getNumeroVotos();
        $this->miconexion = null;

    }

    public function getDatosUsuario()
    {
       
        $sql="SELECT nombre, email, registro, tipo, activo from cuentas where id=? ";
        $select=$this->miconexion->prepare($sql);
        $select->execute(array($this->id));
        $fila=$select->fetch();
        $this->usuario = $fila["nombre"];
        $this->fecha = fechaFormato($fila['registro']);
        $this->email = $fila["email"];
        $this->tipo = $fila["tipo"];
        $this->activo = $fila["activo"];
    }

    private function getNumeroVotos()
    {
        $sql="select count(nota) as total from votos where cuenta=?";
        $select=$this->miconexion->prepare($sql);
        $select->execute(array($this->id));
        $filaNumVotos=$select->fetch();

        $rows = null;

        $this->numTotal = $filaNumVotos["total"];
    }
    
	

}
?>