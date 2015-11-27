<?php

/**
* Esta parte del modelo traerá la vista correspondiente
*/

class Vista_Model
{
    /**
     * Almacenar variables asociadas al template
     */
    private $data = array();
    
    /**
     * Mantiene estatus de la renderización
     */
    private $render = FALSE;
    /**
     * Cargar template
     */
    public function __construct($template){
        //Componer el nombre del archivo
        $file = SERVER_ROOT . '/views/' . strtolower($template) . '.php';
        if (file_exists($file)) {
			$this->render = $file;
        }
    }
    /**
     * Recibe valores del controlador y los almacena localmente
     */
    public function assign($variable , $value){
		$this->data[$variable] = $value;
	}
    
    public function __destruct(){
        // Parsea las variables de data en variables locales, para que redericen la vista.
		$data = $this->data;
		
        // renderizar la vista
		include($this->render);
    }
}
