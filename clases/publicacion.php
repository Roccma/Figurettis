<?php 
require_once("clases/clase_base.php");
require_once("clases/db.php");
class Publicacion extends ClaseBase{
	private $codigo;
	private $nicknameUsuario;
	private $numeroFigurita;
	private $fechaHora;
	private $cantidad;
	private $estado;

	public function __construct($obj=NULL){
		if(isset($obj)){
			foreach ($obj as $key => $value) {
				$this->$key=$value;
			}
		}
		$tabla = "publicaciones";

		parent::__construct($tabla);
	}


    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     *
     * @return self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNicknameUsuario()
    {
        return $this->nicknameUsuario;
    }

    /**
     * @param mixed $nicknameUsuario
     *
     * @return self
     */
    public function setNicknameUsuario($nicknameUsuario)
    {
        $this->nicknameUsuario = $nicknameUsuario;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroFigurita()
    {
        return $this->numeroFigurita;
    }

    /**
     * @param mixed $numeroFigurita
     *
     * @return self
     */
    public function setNumeroFigurita($numeroFigurita)
    {
        $this->numeroFigurita = $numeroFigurita;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechaHora()
    {
        return $this->fechaHora;
    }

    /**
     * @param mixed $fechaHora
     *
     * @return self
     */
    public function setFechaHora($fechaHora)
    {
        $this->fechaHora = $fechaHora;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     *
     * @return self
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     *
     * @return self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    public function getAllPublicaciones(){
    	$sql = "SELECT f.nombre, f.numero, f.imagen, p.cantidad, p.fechaHora  FROM publicaciones as p, figuritas as f WHERE f.numero = p.numeroFigurita AND p.estado = 1";
    	$stmt = DB::conexion()->prepare($sql);
    	$stmt->execute();
    	$result = $stmt->get_result();
    	$publicaciones = [];
    	while($publicacion = $result->fetch_object()){
    		// $p = new Publicacion(array("codigo"=>$publicacion->codigo,
    		// 						"nicknameUsuario"=>utf8_encode($publicacion->nicknameUsuario),
    		// 						"numeroFigurita"=>$publicacion->numeroFigurita,
    		// 						"fechaHora"=>$publicacion->fechaHora,
    		// 						"cantidad"=>$publicacion->cantidad,
    		// 						"estado"=>$publicacion->estado
    		// 					));
    		// return $p;
            $p = array("nombre" => $publicacion->nombre ,
                    "numero" => $publicacion->numero,
                    "imagen" => $publicacion->imagen,
                    "cantidad" => $publicacion->cantidad,
                    "fechaHora" => $publicacion->fechaHora
             );
    		array_push($publicaciones,$p);
    	}
    	return $publicaciones;
    	return $result;
    }
}

?>