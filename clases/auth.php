<?php 
require_once "clases/session.php";
class Auth extends ControladorIndex{
	public static function loggedIn(){
		Session::init();
		if(Session::get('tipo') == null){
			Session::destroy();
			self::redirect("usuarios", "login");
			exit();
		}
	}
}

?>