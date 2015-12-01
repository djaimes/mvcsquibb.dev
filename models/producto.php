<?php

/* MODELO para el controlador producto */

class Producto_Model {
    
    private $db;
    
    public function __construct(){
        $this->db = new MysqlImproved_Driver();
    }
    
    /* Devolver los datos de un producto */
    public function getProducto($codigoBarra){
		
        $this->db->connect();
		
		// Sanitizar la entrada para evitar injection sql
		$codigoBarra = $this->db->escape($codigoBarra);
		
        $this->db->prepare(
            "
            SELECT descripcion, precio 
            FROM producto 
            WHERE codigobarra ='$codigoBarra';
            "
        );
        
        $this->db->query();
        $producto = $this->db->fetch('array');
        
        return $producto;
    }
}
?>
