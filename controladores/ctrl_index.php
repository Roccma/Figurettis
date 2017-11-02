<?php
require_once ("config/config.php");
class ControladorIndex{
	//Función cargarContolador devuelve un objeto del controlador solicitado
	//Para ello:
	//	- Todos los archivos que contengan controladores como nombre deben tener el prefijo "ctrl_(low c)"
	//	- El nombre de la clase de un controlador debe tener el prefijo Controlador(up c)
	function cargarControlador($controller){
		$controladorArchivo = "ctrl_".$controller;

		$controladorClase = "Controlador".ucfirst($controller);
		$pathControlador = "controladores/".$controladorArchivo.".php";
		
		if(!is_file($pathControlador)){

			$controladorClase = "ControladorUsuarios";
			$pathControlador = "controladores/ctrl_usuarios.php";
		}

		require_once $pathControlador;

		$objetoControlador = new $controladorClase();
		return $objetoControlador;
	}

	//Función que realmente ejecuta el método. Los parámetros son:
	//	- El objeto controlador en el que se encuentra el método que se quiere ejecutar
	//	- El nombre del método que se quiere ejecutar
	//	- Parámetros en caso de que ese método los necesite para ejecutarse
	function ejecutarMetodoInterno($controllerObj, $method, $params){
		$controllerObj->$method($params);
	}

	//Función que se lanza en un evento cuando desea ejecutar una acción
	//Recibe los mismos parámetros que la anterior (ejecutarMetodoInterno)
	function ejecutarAccion($controllerObj, $method, $params){
		if(isset($method) && method_exists($controllerObj, $method)){
			$this->ejecutarMetodoInterno($controllerObj, $method, $params); 
		}
		else{
			$this->ejecutarMetodoInterno($controllerObj, "login", $params);
		}
	}

	//  Función para redireccionar hacia otra página
	function redirect($controller="usuarios", $method="login", $params=array()){
		$url = URL_BASE . $controller . "/" . $method . "/";

		foreach ($params as $key => $value) {
			$url.= $value . "/";
		}
		header("Location:".$url);
	}	

	//	Función para obtener la URL de una función (?);
	function getURL($controller="usuarios", $method="login", $params=array()){
		$url = URL_BASE . $controlador . "/" . $method ."/";

		foreach ($params as $key => $value) {
			$url.= $value . "/";
		}
		return $url;
	}
}

?>