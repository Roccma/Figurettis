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
		// $res = [];
		// foreach ($result as $key => $value) {
		// 	$arrayName = array('codigo' => $value->getCodigo(),
		// 				'nicknameUsuario' => $value->getNicknameUsuario(),
		// 				'numeroFigurita' => $value->getNumeroFigurita(),
		// 				'fechaHora' => $value->getFechaHora(),
		// 				'cantidad' => $value->getCantidad(),
		// 				'estado' => $value->getEstado()
		// 		);
		// 	array_push($res, $arrayName);
		// }
		$resultFinal = array('results'=>$result);
		echo json_encode($resultFinal);

	}
}

?>