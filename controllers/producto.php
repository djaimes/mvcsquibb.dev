<?php

// CONTROLADOR para el objeto producto

class Producto_Controller {

    /* vista del controlador producto */
    public $template = 'producto';
    
    /* función default que llamará el router.php */
    public function main(array $parametros){
        $productoModel = new Producto_Model;
        $producto = $productoModel->getProducto($parametros['codigobarra']);
        
        // Crear una nueva vista y pasarle nuestro template
		$view = new Vista_Model($this->template);
		
		// Asignar datos de productos a la vista
		$view->assign('nombre', $producto['descripcion']);
		$view->assign('precio', $producto['precio']);		
		
		// Renderizar
		$view->render();
    }
}
?>
