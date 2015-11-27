<?php

// CONTROLADOR para el objeto producto

class Producto_Controller {

    /* vista del controlador producto */
    public $template = 'producto';
    
    /* función default que llamará el router.php */
    public function main(array $parametros){
        $productoModel = new Producto_Model;
        $producto = $productoModel->getProducto($parametros['clave']);
        
        // Crear una nueva vista y pasarle nuestro template
		$view = new Vista_Model($this->template);
		
		// Asignar datos de productos a la vista
		$view->assign('nombre', $producto['nombre']);
		$view->assign('precio', $producto['precio']);		
    }
}
?>
