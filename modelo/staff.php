<?php

class Staff
{
    private $miconexion;
    private $id;
    private $nombre;
    private $nacionalidad;
    private $genero;
    private $descripcion;
    private $enlace;
    private $activo;
    private $juegos = [];
    private $numResultados = 10;
    public $pages;
    private $numTotal;

    function __construct($idStaff)
    {
        $this->miconexion=connectDB();
        $this->id = $idStaff;
        $this->getDatosStaff();
        $this->getNumeroJuegos();
        $this->pages = new Paginator($this->numResultados, "p");
        $this->pages->set_total($this->numTotal);
        $this->getCreditosJuegos();
        $this->miconexion=null;

    }

    private function getDatosStaff()
    {
        $sql="select nombre, nacionalidad, genero, descripcion, enlace, activo from personas where id=?";
        $select=$this->miconexion->prepare($sql);
        $select->execute(array($this->id));
        $fila=$select->fetch();
        $this->nombre = $fila["nombre"];
        $this->nacionalidad = $fila["nacionalidad"];
        $this->genero = $fila["genero"];
        $this->descripcion = $fila["descripcion"];
        $this->enlace = $fila["enlace"];
        $this->activo = $fila["activo"];

        $select = null;
    }

    private function getCreditosJuegos()
    {
        $sql="SELECT j.id, j.titulo, j.fecha, r.rol, p.comentario, j.media 
        from juego j, personas_roles_juegos p, roles r 
        where p.rol=r.id and p.juego=j.id and p.persona=? 
        order by j.fecha ".$this->pages->get_limit();

        $selectCreditos=$this->miconexion->prepare($sql);
        $selectCreditos->execute(array($this->id));
        $this->juegos = $selectCreditos->fetchAll(PDO::FETCH_ASSOC);

        $selectCreditos = null;
    }

    private function getNumeroJuegos()
    {
        $sql="SELECT COUNT(*) from personas_roles_juegos pj, juego j
        where j.id=pj.juego and pj.persona=? and j.activo=1 ";
        $selectNumber = $this->miconexion->prepare($sql);
        $selectNumber->execute(array($this->id));
        $this->numTotal=$selectNumber->fetch()[0];

        $selectNumber = null;
    }
    
	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}


	public function getDescripcion(){
		return $this->descripcion;
	}


	public function getNacionalidad(){
		return $this->nacionalidad;
	}


	public function getGenero(){
		return $this->genero;
	}

	public function getEspecificaciones(){
		return $this->especificaciones;
    }
    
    public function getEnlace(){
		return $this->enlace;
    }

	public function getActivo(){
		return $this->activo;
	}

	public function getJuegos(){
		return $this->juegos;
	}

}

?>