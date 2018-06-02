<?php

class ListaPlataforma
{
    private $miconexion;
    private $numTotal;
    public $numResultados = 9;
    public $pages;

    function __construct()
    {
        
        $this->getNumeroPlataforma();
        $this->pages = new Paginator($this->numResultados, "p");
        $this->pages->set_total($this->numTotal);

    }

    public function getListadoPlataforma()
    {
        $this->miconexion=connectDB();
        $sql="SELECT id, nombre from plataforma where ACTIVO=1 order by nombre ".$this->pages->get_limit();
        $select=$this->miconexion->prepare($sql);
        $select->execute();
        $this->miconexion=null;
        return $select->fetchAll(PDO::FETCH_ASSOC);
        
    }

    private function getNumeroPlataforma()
    {
        $this->miconexion=connectDB();
        $sql = "select count(*) as total from plataforma";
        $rows=$this->miconexion->prepare($sql);
        $rows->execute();
        $total = $rows->fetch();
        $rows = null;

        $this->numTotal = $total["total"];
        $this->miconexion=null;
    }
    
	public function getNumTotal(){
		return $this->numTotal;
	}

}
?>