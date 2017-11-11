<?php 
require_once("clases/template.php");
require_once("clases/auth.php");
require_once("clases/publicacion.php");
require_once("clases/respuesta.php");
require_once("clases/session.php");
require_once('vendor/autoload.php');

class ControladorPublicaciones extends ControladorIndex{
	public function getAllPublicaciones(){
		$publicacion = new Publicacion();

		$result = $publicacion->getAllPublicaciones();
		$resultFinal = array('results'=>$result);
		echo json_encode($resultFinal);
		}

}

?>