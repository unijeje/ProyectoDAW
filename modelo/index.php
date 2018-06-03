<?php

class Datos
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
    private $numImages = 4;
    public $imagenHtml="";
    public $revHtml="";

    function __construct()
    {
        $this->miconexion=connectDB();
        // $this->id = $idPlataforma;
        // $this->getDatosPlataforma();
        // $this->getNumeroJuegos();
        // $this->pages = new Paginator($this->numResultados, "p");
        // $this->pages->set_total($this->numTotal);
        // $this->getCreditosJuegos();
        // $this->miconexion=null;

    }

    function random_screenshot($dir = 'img/screenshots')
    {
        $dirs = array_filter(glob($dir.'/*'), 'is_dir');


        // $randomDir = $dirs[mt_rand(0, count($dirs) - 1)];

        $randomDir = array_rand($dirs, $this->numImages);

        $imagenes=[];
        foreach($randomDir as $key=>$value)
        {
            $files = glob($dirs[$value] . '/*.*');
            $file = array_rand($files);
            $imagenes[]=$files[$file];
        }

        foreach($imagenes as $filename)
        {
            $this->imagenHtml.="<a href='".$filename."' data-fancybox='gallery' data-caption='Caption #1'>";
            $this->imagenHtml.=   "<img class='m-4 screenshotJuego' src='".$filename."' alt='' />";
            $this->imagenHtml.="</a>";
        }
    }

    public function getUltimasRevisiones()
    {
        $sql="SELECT r.id, r.id_modelo, r.tipo, r.numero, c.nombre as user, c.id as id_user from revisiones r inner join cuentas c on r.usuario=c.id order by r.fecha desc limit 10";
        $select=$this->miconexion->prepare($sql);
        $select->execute();
        $rev=$select->fetchAll(PDO::FETCH_ASSOC);

        $sqlJuego = "SELECT titulo from juego where id=?";
        $sqlStaff = "SELECT nombre from personas where id=?";
        $sqlCompany = "SELECT nombre from company where id=?";
        $sqlPlat = "SELECT nombre from plataforma where id=?";

        $selectJuego = $this->miconexion->prepare($sqlJuego);
        $selectStaff = $this->miconexion->prepare($sqlStaff);
        $selectCompany = $this->miconexion->prepare($sqlCompany);
        $selectPlat = $this->miconexion->prepare($sqlPlat);

        $nombres=[];

        foreach($rev as $key=>$value)
        {
            switch($value["tipo"])
            {
                case "J":
                    $selectJuego->execute([$value["id_modelo"]]);
                    $resJuego = $selectJuego->fetch(PDO::FETCH_ASSOC);
                    $rev[$key]["nombre"]=$resJuego["titulo"];
                    break;
                case "S":
                    $selectStaff->execute([$value["id_modelo"]]);
                    $resStaff = $selectStaff->fetch(PDO::FETCH_ASSOC);
                    $rev[$key]["nombre"]=$resStaff["nombre"];
                    break;
                case "C":
                    $selectCompany->execute([$value["id_modelo"]]);
                    $resCompany = $selectCompany->fetch(PDO::FETCH_ASSOC);
                    $rev[$key]["nombre"]=$resCompany["nombre"];
                    break;
                case "P":
                    $selectPlat->execute([$value["id_modelo"]]);
                    $resPlat = $selectPlat->fetch(PDO::FETCH_ASSOC);
                    $rev[$key]["nombre"]=$resPlat["nombre"];
                    break;
            }

            $this->revHtml.="<a href='pages/revision.php?id=".$rev[$key]["id"]."'>".$rev[$key]["nombre"]."</a> por <a href='pages/perfil.php?id=".$rev[$key]["id_user"]."'>".$rev[$key]["user"]."</a><br>";

        }

        
        $selectJuego = null;
        $selectStaff = null;
        $selectCompany = null;
        $selectPlat = null;
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