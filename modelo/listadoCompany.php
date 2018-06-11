<?php

class ListaCompany
{
    private $miconexion;
    private $id;
    private $nombre;
    private $fecha;
    private $pais;
    private $numTotal;
    public $numResultados = 9;
    public $pages;

    function __construct()
    {
        
        $this->getNumeroCompany();
        $this->pages = new Paginator($this->numResultados, "p");
        $this->pages->set_total($this->numTotal);

    }

    public function getListadoCompany()
    {
        $this->miconexion=connectDB();
        $sql="SELECT id, nombre, fecha, pais from company where ACTIVO=1 order by nombre ".$this->pages->get_limit();
        $select=$this->miconexion->prepare($sql);
        $select->execute();
        $this->miconexion=null;
        return $select->fetchAll(PDO::FETCH_ASSOC);
        
    }

    private function getNumeroCompany()
    {
        $this->miconexion=connectDB();
        $sql = "select count(*) as total from company";
        $rows=$this->miconexion->prepare($sql);
        $rows->execute();
        $total = $rows->fetch();
        $rows = null;

        $this->numTotal = $total["total"];
        $this->miconexion=null;
    }
    
	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}


	public function getNumTotal(){
		return $this->numTotal;
	}


	public function getFecha(){
		return $this->fecha;
	}


	public function getPais(){
		return $this->pais;
	}

}
?>