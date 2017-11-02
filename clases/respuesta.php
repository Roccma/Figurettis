<?php

require_once("clases/clase_base.php");
require_once("clases/db.php");

class Respuesta{
	private $code;
	private $message;
	private $content;

	public function __construct($obj = NULL){
		if(isset($obj)){
			foreach ($obj as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	public function setCode($code){
		$this->code = $code;
	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function getResult(){
		return json_encode(array("code" => $this->code,
								"message" => $this->message,
								"content" => $this->content,));
	}
}

?>