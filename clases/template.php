<?php 

require_once('libs/smarty/Smarty.class.php');
require_once('config/config.php');	

class Template{

	private $_smarty;

	public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }
        

        return $instance;
    }

     protected function __construct()
    {
         $this->_smarty = new Smarty();
         
        global $template_config;
        $this->_smarty->template_dir = $template_config['template_dir'];
        $this->_smarty->compile_dir = $template_config['compile_dir'];
        $this->_smarty->cache_dir = $template_config['cache_dir'];
        $this->_smarty->config_dir = $template_config['config_dir'];
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    } 


    //Función para mostrar un tpl (vista) específica y cargar los datos que necesarios que tiene adentro
    function mostrar($template, $data = array()){
    	foreach ($data as $key => $value) {
    		$this->asignar($key, $value);
    	}
    	$this->_smarty->display($template . ".tpl");
    }

    function asignar($key, $value){
    	$this->_smarty->assign($key, $value);
    }

}

?>