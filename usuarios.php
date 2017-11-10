<?php

require_once('libs/Slim/Slim.php');
require_once('controladores/ctrl_index.php');
require_once('controladores/ctrl_usuarios.php');

ini_set("default_socket_timeout", 6000);

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get(
	'/login', function(){
		$request = \Slim\Slim::getInstance() -> request();
	
		$nickname = $request -> params('nickname');
		$contrasenia = $request -> params('contrasenia');

		$ctrl = new ControladorUsuarios();
		echo $ctrl->loginWS(array($nickname, $contrasenia));
	}
);

$app->get(
	'/getSessionData', function(){
		$request = \Slim\Slim::getInstance() -> request();
	
		$nickname = $request -> params('nickname');

		$ctrl = new ControladorUsuarios();
		echo $ctrl->getSessionDataWS(array($nickname));
	}
);

$app->get(
	'/addUserSocialNetwork', function(){
		$request = \Slim\Slim::getInstance() -> request();
		
		$nickname = $request -> params('nickname');
		$nombre = $request -> params('nombre');
		$apellido = $request -> params('apellido');
		$contacto = $request -> params('contacto');
		$fotoPerfil = $request -> params('fotoPerfil');
		$aplicacion = $request -> params('aplicacion');
		//echo "aca: " . $nickname . $nombre . $apellido . $contacto . $fotoPerfil . $aplicacion;
		$params = array($nickname, $nombre, $apellido, $contacto, $fotoPerfil, $aplicacion);

		$ctrl = new ControladorUsuarios();
		echo $ctrl->addUserSocialNetworkWS($params);
	}
);

$app->run();

?>