<?php 
require_once("clases/template.php");
require_once("clases/auth.php");
require_once("clases/figurita.php");
require_once("clases/respuesta.php");
require_once("clases/session.php");
require_once('vendor/autoload.php');

class ControladorFiguritas extends ControladorIndex{

	function agregarFigurita($params = array()){
		$valores = array("numero" => $params[0],
						"nombre" => $params[1],
						"codigoPais" => $params[2],
						"imagen" => "img/Figuritas/" . $params[0] . ".jpg");
		$figurita = new Figurita($valores);
		$cantidad = $figurita->getCantidadFigurita();
		if($cantidad < 1){
			$figurita->insert();
			echo "insertado";
		}
		else{
			echo "no insertado";
		}
	}	

	function cargarFiguritas($param=array()){
		$tpl = Template::getInstance();
		$tpl->asignar('location', 'Cargar figuritas');
		$tpl->mostrar('cargarFiguritas');
	}

	function leerCSV($params=array()){

		$fichero = fopen('figuritas.csv', 'r');
		$figuritas = array();
		if($fichero != NULL){
			while(($datos = fgetcsv($fichero, 1000, ';')) != NULL){
					$figurita = array("numero" => $datos[0],
										"nombre" => utf8_encode($datos[1]),
										"codigoPais" => $datos[2],);
					$figuritas[] = $figurita;
			}
			fclose($fichero);			
			echo json_encode(array("error" => 0, "content" => $figuritas));
		}
		else{
			echo json_encode(array("error" => 1, "content" => ""));
		}
	}
}

?>