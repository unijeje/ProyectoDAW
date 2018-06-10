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
    public $commentHtml="";

    function __construct()
    {
        $this->miconexion=connectDB();
        $this->random_screenshot();
        $this->getUltimasRevisiones();
        $this->getUltimosComentarios();
        $this->miconexion=null;

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

    public function getUltimosComentarios()
    {
        $sql="SELECT p.nombre, p.id as id_user, 
        IF( LENGTH(C.TEXTO) > 25, CONCAT(SUBSTR(c.TEXTO, 1, 25), '...') , c.TEXTO ) as texto, 
        FROM_UNIXTIME(c.fecha, '%d/%m/%Y %h:%i') as fecha, c.juego, j.titulo from comentarios c 
        inner join cuentas p on p.id=c.USUARIO INNER JOIN JUEGO j on c.JUEGO=j.ID  order by c.fecha desc limit 10";
        $selectComent=$this->miconexion->prepare($sql);
        $selectComent->execute();
        $datos = $selectComent->fetchAll(PDO::FETCH_ASSOC);

        foreach($datos as $key=>$value)
        {
            $this->commentHtml .= $value["fecha"]." - <a data-toggle='tooltip' title='".$value["titulo"]."' href='pages/juego.php?id=".$value["juego"]."'>".$value["texto"]."</a> 
            por <a href='pages/perfil.php?id=".$value["id_user"]."'>".$value["nombre"]."</a><br>";
        }
        //data-toggle='tooltip' title='Hooray!'
        $selectComent = null;
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