<?php 
require_once("clases/clase_base.php");
require_once("clases/db.php");
class Figurita extends ClaseBase{
	private $numero;
	private $nombre;
	private $codigoPais;
	private $imagen;

	public function __construct($obj=NULL){
		if(isset($obj)){
			foreach ($obj as $key => $value) {
				$this->$key=$value;
			}
		}
		$tabla = "figuritas";

		parent::__construct($tabla);
	}

	public function getNumero(){
		return $this->numero;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getCodigoPais(){
		return $this->codigoPais;
	}

	public function getImagen(){
		return $this->imagen;
	}

	public function setNumero($numero){
		$this->numero = $numero;	
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;	
	}

	public function setCodigoPais($codigoPais){
		$this->codigoPais = $codigoPais;	
	}

	public function setImagen($imagen){
		$this->imagen = $imagen;	
	}

	public function insert(){
		$sql = "INSERT INTO figuritas (numero, nombre, codigoPais, imagen) VALUES (?,?,?,?)";

		$stmt = DB::conexion()->prepare($sql);

		$stmt->bind_param("isis", $this->numero, $this->nombre, $this->codigoPais, $this->imagen);

		$rc=$stmt->execute();
		echo $this->numero . " - " . $this->nombre . " - " . $this->codigoPais;

		if($rc === false){
			die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
		else{
			return true;
		}

	}

	public function getCantidadFigurita(){
		$sql = "SELECT * FROM figuritas WHERE numero = ?";
		$stmt = DB::conexion()->prepare($sql);
		$stmt->bind_param('i', $this->numero);
		$stmt->execute();
		$stmt->store_result();
		return $stmt->num_rows();
	}
} 

?>