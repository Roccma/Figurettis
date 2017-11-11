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
// ////

    private $nombreJugador;
    private $imagenFigurita;
    private $imagenBandera;



	public function __construct($obj=NULL){
		if(isset($obj)){

			foreach ($obj as $key => $value) {
                // echo $key;
				$this->$key=$value;
			}
		}
		$tabla = "publicaciones";

		parent::__construct($tabla);
	}

    // public function __construct($obj=NUL){
    //     echo $obj;
    //     if(isset($obj)){
    //         foreach ($obj as $key => $value) {
    //             $this->$key=$value;
    //         }
    //     }
    // }

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


    /**
     * @return mixed
     */
    public function getNombreJugador()
    {
        return $this->nombreJugador;
    }

    /**
     * @param mixed $nombreJugador
     *
     * @return self
     */
    public function setNombreJugador($nombreJugador)
    {
        $this->nombreJugador = $nombreJugador;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImagenFigurita()
    {
        return $this->imagenFigurita;
    }

    /**
     * @param mixed $imagenFigurita
     *
     * @return self
     */
    public function setImagenFigurita($imagenFigurita)
    {
        $this->imagenFigurita = $imagenFigurita;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImagenBandera()
    {
        return $this->imagenBandera;
    }

    /**
     * @param mixed $imagenBandera
     *
     * @return self
     */
    public function setImagenBandera($imagenBandera)
    {
        $this->imagenBandera = $imagenBandera;

        return $this;
    }
    
    public function getAllPublicaciones(){
    	$sql = "SELECT f.nombre, f.numero, f.imagen, p.* , paises.bandera FROM publicaciones as p, figuritas as f, paises WHERE f.numero = p.numeroFigurita AND f.codigoPais = paises.codigo AND p.estado = 1";
    	$stmt = DB::conexion()->prepare($sql);
    	$stmt->execute();
    	$result = $stmt->get_result();
    	$publicaciones = [];
    	while($publicacion = $result->fetch_object()){
            $p = array("nombre" => $publicacion->nombre ,
                    "numero" => $publicacion->numero,
                    "imagen" => $publicacion->imagen,
                    "cantidad" => $publicacion->cantidad,
                    "fechaHora" => $publicacion->fechaHora,
                    "bandera" => $publicacion->bandera

             );
    		array_push($publicaciones,$p);
    	}
    	return $publicaciones;
    }
}

?>