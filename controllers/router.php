<?php

/* Controlará todas las peticiones del cliente vía URL
   llamará al controlador adecuado a la petición o request.
   Ejemplo: http://mvcsquib/index.php?var1=valor1&var2=valor2&var3=valor3
*/

/**	
*	La función __autoload ya está definida en PHP, su función es cargar
*	el archivo que contiene la clase llamada, sin necesidad de que hagámos
*	un include_once o un require_once.
*	Sin embargo PHP no conoce las rutas de nuestro sistema, por lo que 
*	utilizamos una característica de la POO que se llama "recarga de métodos"
*	la cual consiste en redefinir el método, lo cual permite tomar el control
*	de la carga automática de clases con nuestras rutas.
*/
function __autoload($className){
	    /* La clase Producto_Model está en el archivo models/producto.php */
	    $parse = explode('_' , $className);
	    $filename = $parse[0];
	    $sufijo = strtolower($parse[1]);

	    /* Componer la carpeta donde se encuentra el archivo */
	    switch ($sufijo){
	    	case 'model':
	    		$folder = '/models/';
	    		break;
	    	case 'library':
	    		$folder = '/libraries/';
	    		break;
	    	case 'driver':
	    		$folder = '/libraries/drivers/';
	    }
		
	    /* Componer el nombre del archivo */
	    $file = SERVER_ROOT . $folder . strtolower($filename) . '.php';
	    
	    /* Verificar que exista */
	    if (file_exists($file)){
	        include_once($file);        
	    } else {
	        die("El archivo '$filename' con la clase '$className' no existe.");    
	    }
}

$request = $_SERVER['QUERY_STRING'];
$url = explode('&', $request);
$controlador = array_shift($url);
$parametros = array();

foreach($url as $var){
	$var = explode('=', $var);
	$variable = $var[0];
	$valor = $var[1];
	$parametros[$variable] = $valor;
}

/* componer la ruta del controlador llamado */
$ruta = SERVER_ROOT . '/controllers/' . $controlador . '.php';

/* validar que exista y que la clase pueda ser llamada */
if(file_exists($ruta)){
	include_once($ruta);
	
	/* La primera mayúscula para cumplir con las reglas de nombrado */
	$clase = ucfirst($controlador) . '_Controller';
	
	/* Asegurarnos que la clase exista */
	if(class_exists($clase)){
		$controlador = new $clase;
	}else{
		die('La clase no existe');
	}
}else{
	die('El controlador no existe');
}

/* Una vez instanciado el controlador, llamamos a su método main controlador
con los parámetros de la url */
$controlador->main($parametros);

?>
