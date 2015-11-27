<?php

/* MODELO para el controlador producto */

class Producto_Model {
    
   /* private $productos =  array(
                            '100' => array('nombre'=>'galleta','precio'=>23.50),
                            '101' => array('nombre'=>'leche','precio'=>12.80),
                            '102' => array('nombre'=>'atún','precio'=>13.20)
                            );
*/
    private $db;
    
    public function __construct(){
        $this->db = new MysqlImproved_Driver();
    }
    
    /* Devolver los datos de un producto */
    public function getProducto($codigoBarra){
        // $producto = $this->productos[$clave];
        $this->db->connect();
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
