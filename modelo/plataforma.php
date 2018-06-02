<?php

class Plataforma
{
    private $miconexion;
    private $id;
    private $nombre;
    private $company;
    private $descripcion;
    private $especificaciones;
    private $fecha;
    private $pais;
    private $enlace;
    private $activo;
    private $juegos = [];
    private $numResultados = 10;
    public $pages;
    private $numTotal;

    function __construct($idPlataforma)
    {
        $this->miconexion=connectDB();
        $this->id = $idPlataforma;
        $this->getDatosPlataforma();
        $this->getNumeroJuegos();
        $this->pages = new Paginator($this->numResultados, "p");
        $this->pages->set_total($this->numTotal);
        $this->getCreditosJuegos();
        $this->miconexion=null;

    }

    private function getDatosPlataforma()
    {
        $sql="select p.nombre, p.fecha, c.nombre as company, p.descripcion, p.especificaciones, p.activo from company c, plataforma p where p.company=c.id and p.id=? ";
        $select=$this->miconexion->prepare($sql);
        $select->execute(array($this->id));
        $fila=$select->fetch();
        $this->nombre = $fila["nombre"];
        $this->fecha = $fila["fecha"];
        $this->company = $fila["company"];
        $this->descripcion = $fila["descripcion"];
        $this->especificaciones = $fila["especificaciones"];
        $this->activo = $fila["activo"];

        $select = null;
    }

    private function getCreditosJuegos()
    {
        $sql="SELECT j.id, j.titulo,j.fecha, j.media from plataforma p, plataforma_juego pj, juego j
        where j.id=pj.id_juego and p.id=pj.id_plataforma
        and p.id=? and j.activo=1 order by j.fecha asc ".$this->pages->get_limit();
        $selectCreditos=$this->miconexion->prepare($sql);
        $selectCreditos->execute(array($this->id));
        $this->juegos = $selectCreditos->fetchAll(PDO::FETCH_ASSOC);

        $selectCreditos = null;
    }

    private function getNumeroJuegos()
    {
        $sql="SELECT COUNT(*) from plataforma p, plataforma_juego pj, juego j
        where j.id=pj.id_juego and p.id=pj.id_plataforma
        and p.id=? and j.activo=1 ";
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


	public function getFecha(){
		return $this->fecha;
	}


	public function getCompany(){
		return $this->company;
	}

	public function getEspecificaciones(){
		return $this->especificaciones;
	}

	public function getActivo(){
		return $this->activo;
	}

	public function getJuegos(){
		return $this->juegos;
	}

}

?>