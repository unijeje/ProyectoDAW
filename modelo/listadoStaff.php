<?php

class ListaStaff
{
    private $miconexion;
    private $numTotal;
    public $numResultados = 9;
    public $pages;

    function __construct()
    {
        
        $this->getNumeroPersonas();
        $this->pages = new Paginator($this->numResultados, "p");
        $this->pages->set_total($this->numTotal);

    }

    public function getListadoPersonas()
    {
        $this->miconexion=connectDB();
        $sql="SELECT id, nombre, nacionalidad from personas where ACTIVO=1 order by nombre ".$this->pages->get_limit();
        $select=$this->miconexion->prepare($sql);
        $select->execute();
        $this->miconexion=null;
        return $select->fetchAll(PDO::FETCH_ASSOC);
        
    }

    private function getNumeroPersonas()
    {
        $this->miconexion=connectDB();
        $sql = "select count(*) as total from personas";
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