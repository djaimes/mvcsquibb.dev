<?php

/* MODELO para el controlador producto */

class Producto_Model {
    
    private $productos =  array(
                            '100' => array('nombre'=>'galleta','precio'=>23.50),
                            '101' => array('nombre'=>'leche','precio'=>12.80),
                            '102' => array('nombre'=>'atún','precio'=>13.20)
                            );

    public function __construct(){
        
    }
    
    /* Devolver los datos de un producto */
    public function getProducto($nombreProducto){
        $producto = $this->productos[$nombreProducto];
        return $producto;
    }
}
?>
