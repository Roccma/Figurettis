<?php 
require_once("clases/clase_base.php");
require_once("clases/db.php");
class Usuario extends ClaseBase{
	private $ci;
	private $contrasenia;
	private $nombre;
	private $apellido;
	private $email;
	private $fotoperfil;
	private $funcionario;
	private $enviarcorreo;
	/* Constructor */

	public function __construct($obj=NULL){
		if(isset($obj)){
			foreach ($obj as $key => $value) {
				$this->$key=$value;
			}
		}
		$tabla = "usuarios";

		parent::__construct($tabla);
	}

	/* Getters */
	public function getCi(){
		return $this->ci;
	}

	public function getContrasenia(){
		return $this->contrasenia;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getApellido(){
		return $this->apellido;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getFotoperfil(){
		return $this->fotoperfil;
	}

	public function getFuncionario(){
		return $this->funcionario;
	}

	public function getEnviarcorreo(){
		return $this->enviarcorreo;
	}

	/* Setters */

	public function setCi($ci){
		$this->ci = $ci;
	}

	public function setContrasenia($psw){
		$this->contrasenia = $psw;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function setApellido($apellido){
		$this->apellido = $apellido;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setFotoperfil($fotoperfil){
		$this->fotoperfil = $fotoperfil;
	}

	public function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}

	public function login(){

		$sql = "SELECT * FROM usuarios WHERE ci=? AND contrasenia = ?";
		
		$stmt = DB::conexion()->prepare($sql);
		$pass = sha1($this->contrasenia);
		$stmt->bind_param("is", $this->ci, $pass);

		$result = $stmt->execute();
		
		$stmt->store_result();
		
		return $stmt->num_rows();

	}

	public function signUp(){
		$sql = "INSERT INTO usuarios VALUES (?,?,?,?,?,?,?,?)";

		$stmt = DB::conexion()->prepare($sql);
		$pass = sha1($this->contrasenia);

		$stmt->bind_param("isssssii", $this->ci, $pass,$this->nombre,$this->apellido, $this->email, $this->fotoperfil, $this->funcionario ,$this->enviarcorreo);

		$rc=$stmt->execute();

		if($rc === false){
			  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
		else{
			return true;
		}

	}

	public function existeCedula(){
		$sql = "SELECT * FROM usuarios WHERE ci=?";

		$stmt = DB::conexion()->prepare($sql);

		$stmt->bind_param("i", $this->ci);

		$stmt->execute();

		$stmt->store_result();

		return $stmt->num_rows();
	}

	public function existeMail(){
		$sql = "SELECT * FROM usuarios WHERE email=?";

		$stmt = DB::conexion()->prepare($sql);

		$stmt->bind_param("s", $this->email);

		$stmt->execute();

		$stmt->store_result();

		return $stmt->num_rows();
	}

	public function seleccionarUsuario(){
		$sql = "SELECT * FROM usuarios WHERE ci=? ";
		$stmt = DB::conexion()->prepare($sql);
		$stmt ->bind_param('i',$this->ci);
		$stmt->execute();
		$result = $stmt->get_result();
		//$usuario = "";
		while($usr = $result->fetch_object()){
			$usuario= new Usuario(array("ci" =>$usr->ci,
									 "contrasenia"=>$usr->contrasenia,
									 "nombre"=>utf8_encode($usr->nombre),
									 "apellido"=>utf8_encode($usr->apellido),
									 "email"=>$usr->email,
									 "fotoperfil"=>$usr->fotoPerfil,
									 "funcionario"=>$usr->funcionario,
									 "enviarcorreo"=>$usr->enviarCorreo,));
			return $usuario;
		}	
	}

	public function convertToArray(){
		return array("ci" =>$usr->ci,
									 "contrasenia"=>$this->contrasenia,
									 "nombre"=>$this->nombre,
									 "apellido"=>$this->apellido,
									 "email"=>$this->email,
									 "fotoperfil"=>$this->fotoperfil,
									 "funcionario"=>$this->funcionario,
									 "enviarcorreo"=>$this->enviarcorreo,);
	}

	public function update (){
		$enviarcorreo = isset($this->enviarcorreo) ? 1 : 0;
		//var_dump($this);
		$sql = "UPDATE usuarios SET nombre=?, apellido =?, email=?, fotoPerfil=?, enviarCorreo=? WHERE ci=?";
		$stmt = DB::conexion()->prepare($sql);
		//$a='A';
		$foto=$this->fotoperfil;
		//exit;
		$stmt->bind_param('ssssii',$this->nombre,$this->apellido,$this->email,$foto,$enviarcorreo,$this->ci);
		$stmt->execute();

	}

	public function modificarContra(){
		$pass = sha1($this->contrasenia);
		$sql="UPDATE usuarios SET contrasenia=? WHERE ci=?";
		$stmt = DB::conexion()->prepare($sql);
		$stmt->bind_param('si',$pass,$this->ci);
		$stmt->execute();
	}
	public function existeContra(){
		$sql="SELECT * from usuarios WHERE ci=? and contrasenia = ?";
		$pass = sha1($this->contrasenia);
		$stmt = DB::conexion()->prepare($sql);
		$stmt->bind_param('is',$this->ci,$pass);
		$stmt->execute();
		$stmt->store_result();
		return $stmt->num_rows();

	}
	public function banneado(){
		$sql="DELETE  FROM usuarios WHERE ci=?";
		$stmt = DB::conexion()->prepare($sql);
		$stmt->bind_param('i',$this->ci);
		$stmt->execute();
	}
	public function existeEmail(){
		$sql="SELECT * from usuarios WHERE ci<>? and email = ?";
		$stmt = DB::conexion()->prepare($sql);
		$stmt->bind_param('is',$this->ci,$this->email);
		$stmt->execute();
		$stmt->store_result();
		return $stmt->num_rows();

	}		

} 

?>