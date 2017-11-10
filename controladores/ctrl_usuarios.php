<?php 
require_once("clases/template.php");
require_once("clases/auth.php");
require_once("clases/usuario.php");
require_once("clases/respuesta.php");
require_once("clases/session.php");
require_once('vendor/autoload.php');

class ControladorUsuarios extends ControladorIndex{

	public function loginWS($params = array()){

		$usuario = new Usuario(array("nickname" => $params[0],
									"contrasenia" => $params[1]));
		$num_rows = $usuario->login();
		if($num_rows < 1)
			return json_encode(array("result" => false));
		else
			return json_encode(array("result" => true));
	}

	public function getSessionDataWS($params = array()){

		$usuario = new Usuario(array("nickname" => $params[0]));
		$u = $usuario->getSessionData();
		$result = array("nickname" => $u->getNickname(),
						"nombre" => $u->getNombre(),
						"apellido" => $u->getApellido(),
						"contacto" => $u->getContacto(),
						"fotoPerfil" => $u->getFotoPerfil(),
						"aplicacion" => $u->getAplicacion());
		echo json_encode($result);
	}

	public function addUserSocialNetworkWS($params = array()){
		//echo "Acaaaaa" . $params[0];
		$usuario = new Usuario(array("nickname" => $params[0],
									"nombre" => $params[1],
									"apellido" => $params[2],
									"contacto" => $params[3],
									"fotoPerfil" => $params[4],
									"aplicacion" => $params[5],
									"contrasenia" => ""));
		//echo "Acaaaaa";
		if($usuario->existeUsuario() < 1){
			$usuario->insert();
		}

		echo json_encode(array("result" => true));
	}
}

?>