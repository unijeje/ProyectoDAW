<?php

class Company
{
    private $miconexion;
    private $id;
    private $nombre;
    private $descripcion;
    private $fecha;
    private $pais;
    private $enlace;
    private $activo;
    private $juegos = [];
    private $plataformas = [];
    private $numResultados = 10;
    public $pages;
    private $numTotal;

    function __construct($idCompany)
    {
        $this->miconexion=connectDB();
        $this->id = $idCompany;
        $this->getDatosCompany();
        $this->getNumeroJuegos();
        $this->pages = new Paginator($this->numResultados, "p");
        $this->pages->set_total($this->numTotal);
        $this->getCreditosJuegos();
        $this->getCreditosConsolas();
        $this->miconexion=null;

    }

    private function getDatosCompany()
    {
        $sql="select nombre, fecha, pais, descripcion, enlace, activo from company where id=? ";
        $select=$this->miconexion->prepare($sql);
        $select->execute(array($this->id));
        $fila=$select->fetch(PDO::FETCH_ASSOC);
        $this->nombre = $fila["nombre"];
        $this->descripcion = $fila["descripcion"];
        $this->fecha = $fila["fecha"];
        $this->pais = $fila["pais"];
        $this->enlace = $fila["enlace"];
        $this->activo = $fila["activo"];
        $select = null;
    }

    private function getCreditosJuegos()
    {
        $sql="SELECT j.id, j.titulo,j.fecha, j.media from company c, company_juegos cj, juego j
        where j.id=cj.id_juego and c.id=cj.id_company
        and c.id=? and j.activo=1 order by j.fecha asc ".$this->pages->get_limit();
        $selectCreditos=$this->miconexion->prepare($sql);
        $selectCreditos->execute(array($this->id));
        $this->juegos = $selectCreditos->fetchAll(PDO::FETCH_ASSOC);

        $selectCreditos = null;
    }

    private function getCreditosConsolas()
    {
        $sql="SELECT p.id, p.nombre, p.fecha
        from company c, plataforma p
        where p.company=c.id
        and p.activo=1 
        and c.id=? order by p.fecha";
        $selectCreditos=$this->miconexion->prepare($sql);
        $selectCreditos->execute(array($this->id));
        $this->plataformas = $selectCreditos->fetchAll(PDO::FETCH_ASSOC);
        $selectCreditos = null;
    }

    private function getNumeroJuegos()
    {
        $sql="SELECT COUNT(*) from company c, company_juegos cj, juego j
        where j.id=cj.id_juego and c.id=cj.id_company
        and c.id=? and j.activo=1 ";
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


	public function getPais(){
		return $this->pais;
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

	public function getPlataformas(){
		return $this->plataformas;
    }


}
?>