<?php 	
	ini_set("display_errors", 1);
	error_reporting(E_ALL & ~E_NOTICE);
	require "clases/db.php";
	require "vendor/autoload.php";
	require "controladores/ctrl_index.php";
	require "controladores/ctrl_usuarios.php";
	require_once('clases/template.php');

	if(isset($_GET["url"])){

		$request = explode('/', $_GET["url"]);

		$controlador = (!empty($request[0])) ? $request[0] : "usuario";

		$method = (!empty($request[1])) ? $request[1] : "login";

		 $params = array();

		 for($i=2; $i< count($request) ; $i++){
		 	$params[] = $request[$i];
		 }
	}
	else{
		$controlador = "usuario";

		$method = "login";

		$params = array();
	}
 	$controlIndex = new ControladorIndex();
	$objetoControlador = $controlIndex->cargarControlador($controlador);

	
	$controlIndex->ejecutarAccion($objetoControlador, $method, $params);
?>	