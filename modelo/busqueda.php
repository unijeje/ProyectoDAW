<?php

class Busqueda
{
    private $miconexion;
    private $numTotal;
    public $numResultados = 10;
    public $pages;
    public $tipo;
    public $busq;
    public $resHtml;
    public $datos=[];

    function __construct($tipo, $texto)
    {
        $this->miconexion=connectDB();
        $this->miconexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        $this->busq = $texto;
        $this->pages = new Paginator($this->numResultados, "pag");
        
        $this->clasificarBusqueda($tipo);
        
        $this->miconexion=null;
    }

    public function clasificarBusqueda($tipo)
    {
        switch($tipo)
        {
            case "j": 
                $this->buscarJuego();
                break;
            case "c":
                $this->buscarCompany();
                break;
            case "s":
                $this->buscarStaff();
                break;
            case "p":
                $this->buscarPlataforma();
                break;
            case "a":
                $this->buscarTodo();
                break;
            case "u":
                $this->buscarUser();
                break;
            
        }
        
    }


    private function buscarUser()
    {
        $sql = "SELECT ID, NOMBRE, REGISTRO FROM cuentas where nombre like CONCAT(:busq,'%') and ACTIVO=1 ";

        $this->countTotal($sql);

        $sql = $sql." ".$this->pages->get_limit();

        $select=$this->miconexion->prepare($sql);
        $select->execute(array(':busq' => $this->busq));
        $data = $select->fetchAll(PDO::FETCH_ASSOC);
        $select = null;

        $this->datos = $data;
    }

    private function buscarJuego()
    {
        
        $sql = "SELECT ID, TITULO, FECHA, MEDIA FROM juego where TITULO like CONCAT(:busq,'%') and ACTIVO=1 ";

        $this->countTotal($sql);

        $sql = $sql." ".$this->pages->get_limit();

        $select=$this->miconexion->prepare($sql);
        $select->execute(array(':busq' => $this->busq));
        $data = $select->fetchAll(PDO::FETCH_ASSOC);
        $select = null;

        $this->datos = $data;
        
    }

    private function buscarPlataforma()
    {
        
        $sql = "SELECT p.ID, p.NOMBRE, c.NOMBRE as COMPANY, c.ID as COMPANY_ID, p.FECHA FROM plataforma p INNER JOIN company c on p.company=c.id where p.NOMBRE like CONCAT(:busq,'%') and p.ACTIVO=1 ";

        $this->countTotal($sql);

        $sql = $sql." ".$this->pages->get_limit();

        $select=$this->miconexion->prepare($sql);
        $select->execute(array(':busq' => $this->busq));
        $data = $select->fetchAll(PDO::FETCH_ASSOC);
        $select = null;

        $this->datos = $data; 
    }

    private function buscarCompany()
    {
        
        $sql = "SELECT ID, NOMBRE, FECHA, PAIS FROM company where NOMBRE like CONCAT(:busq,'%') and ACTIVO=1 ";

        $this->countTotal($sql);

        $sql = $sql." ".$this->pages->get_limit();
        
        $select=$this->miconexion->prepare($sql);
        $select->execute(array(':busq' => $this->busq));
        $data = $select->fetchAll(PDO::FETCH_ASSOC);
        $select = null;

        $this->datos = $data; 
    }

    private function buscarStaff()
    {
        
        $sql = "SELECT ID, NOMBRE, NACIONALIDAD, GENERO FROM personas where NOMBRE like CONCAT(:busq,'%') and ACTIVO=1 ";

        $this->countTotal($sql);

        $sql = $sql." ".$this->pages->get_limit();

        $select=$this->miconexion->prepare($sql);
        $select->execute(array(':busq' => $this->busq));
        $data = $select->fetchAll(PDO::FETCH_ASSOC);
        $select = null;

        $this->datos = $data; 
    }

    private function buscarTodo()
    {
        $sql= "SELECT ID, TITULO, FECHA as DATO1, MEDIA as DATO2, '' as DATO3, 'juego' as tabla FROM juego where TITULO like CONCAT(:busq,'%') and ACTIVO=1
        UNION ALL
        SELECT p.ID, p.NOMBRE, p.FECHA, c.NOMBRE,  c.ID , 'plataforma' as tabla FROM plataforma p INNER JOIN company c on p.company=c.id where p.NOMBRE like CONCAT(:busq,'%') and p.ACTIVO=1
        UNION ALL
        SELECT id, nombre, NACIONALIDAD, GENERO, '', 'staff' as tabla from personas where NOMBRE like CONCAT(:busq,'%') and ACTIVO=1
        UNION ALL
        SELECT id, nombre, FECHA, PAIS, '', 'company' as tabla from company where NOMBRE like CONCAT(:busq,'%') and ACTIVO=1";

        $this->countTotal($sql);

        $sql = $sql." ".$this->pages->get_limit();

        $select=$this->miconexion->prepare($sql);
        $select->execute(array(':busq' => $this->busq));
        $data = $select->fetchAll(PDO::FETCH_ASSOC);
        $select = null;

        $this->datos = $data; 
    }

    private function countTotal($sql)
    {
        // $this->numTotal = $total["total"];

        $sqlc = "SELECT COUNT(*) as total from ( ".$sql." ) as t1";

        $selectCount = $this->miconexion->prepare($sqlc);

        $selectCount->execute(array(':busq' => $this->busq));

        $total = $selectCount->fetch();
        $selectCount = null;

        $this->pages->set_total($total["total"]);

        /*
        
        select COUNT(*) from (
        SELECT ID, TITULO,  "juego" as tabla FROM juego where TITULO like 'p%'
        UNION ALL
        SELECT ID, NOMBRE, "plat" as tabla FROM plataforma where NOMBRE like 'p%'
        UNION ALL
        SELECT id, nombre, "staff" as tabla from personas where NOMBRE like 'p%'
        UNION ALL
        SELECT id, nombre, "company" as tabla from company where NOMBRE like 'p%'

        ) as t1
*/
    }
    
	public function getNumTotal(){
		return $this->numTotal;
    }
    
    

}
?>