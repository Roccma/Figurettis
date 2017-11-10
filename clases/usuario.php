<?php 
require_once("clases/clase_base.php");
require_once("clases/db.php");
class Usuario extends ClaseBase{
	private $nickname;
	private $nombre;
	private $apellido;
	private $fechaNacimiento;
	private $contacto;
	private $fotoPerfil;
	private $contrasenia;
	private $aplicacion;
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
	public function getNickname(){
		return $this->nickname;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getFechaNacimiento(){
		return $this->fechaNacimiento;
	}

	public function getApellido(){
		return $this->apellido;
	}

	public function getContacto(){
		return $this->contacto;
	}

	public function getFotoPerfil(){
		return $this->fotoPerfil;
	}

	public function getContrasenia(){
		return $this->contrasenia;
	}

	public function getAplicacion(){
		return $this->aplicacion;
	}

	/* Setters */

	public function setNickname($nickname){
		$this->nickname = $nickname;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function setApellido($apellido){
		$this->apellido = $apellido;
	}

	public function setFechaNacimiento($fechaNacimiento){
		$this->fechaNacimiento = $fechaNacimiento;
	}

	public function setContacto($contacto){
		$this->contacto = $contacto;
	}

	public function setFotoPerfil($fotoPerfil){
		$this->fotoPerfil = $fotoPerfil;
	}

	public function setContrasenia($contrasenia){
		$this->contrasenia = $contrasenia;
	}

	public function setAplicacion($aplicacion){
		$this->aplicacion = $aplicacion;
	}

	public function login(){

		$sql = "SELECT * FROM usuarios WHERE nickname=? AND contrasenia = ?";
		
		$stmt = DB::conexion()->prepare($sql);
		$pass = sha1($this->contrasenia);
		$stmt->bind_param("ss", $this->nickname, $pass);

		$result = $stmt->execute();
		
		$stmt->store_result();
		
		return $stmt->num_rows();

	}

	public function getSessionData(){
		$sql = "SELECT * FROM usuarios WHERE nickname = ?";
		$stmt = DB::conexion()->prepare($sql);
		$stmt->bind_param("s", $this->nickname);
		$stmt->execute();
		$result = $stmt->get_result();
		while($usuario = $result->fetch_object()){
			$u = new Usuario(array("nickname" => $this->nickname,
								"nombre" => utf8_encode($usuario->nombre),
								"apellido" => utf8_encode($usuario->apellido),
								"contacto" => $usuario->contacto,
								"fotoPerfil" => $usuario->fotoPerfil,
								"aplicacion" => $usuario->aplicacion));
		}

		return $u;	
	}

	public function existeUsuario(){

		$sql = "SELECT * FROM usuarios WHERE nickname=?";
		
		$stmt = DB::conexion()->prepare($sql);
		$stmt->bind_param("s", $this->nickname);

		$result = $stmt->execute();
		
		$stmt->store_result();
		
		return $stmt->num_rows();

	}
	
	public function insert(){
		$sql = "INSERT INTO usuarios VALUES (?,?,?, '1997-01-01', ?,?,?,?)";
		//echo "aca: " . $this->nickname. $this->nombre. $this->apellido. $this->contacto. $this->fotoPerfil. $this->contrasenia. $this->nickname;
		$stmt = DB::conexion()->prepare($sql);
		//$pass = sha1($this->contrasenia);

		$stmt->bind_param('sssssss', $this->nickname, $this->nombre,$this->apellido, $this->contacto, $this->fotoPerfil, $this->contrasenia ,$this->aplicacion);

		$rc=$stmt->execute();

		if($rc === false){
			  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
		else{
			return true;
		}

	}
/*
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

	}	*/	

} 

?>