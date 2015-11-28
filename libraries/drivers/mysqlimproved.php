<?php

/**
* Driver para MySQL
*/
class MysqlImproved_Driver extends Database_Library
{
	private $connection;
	private $query;
	private $result;
	
	/**
	*	Realizar la conexión a la base de datos
	*/
	public function connect()
	{
		/* Parámetros de conexión */
		$host = 'localhost';
		$user = 'admin';
		$password = 'colage';
		$database = 'mitienda';

		/* Crear conexión */
		$this->connection = new mysqli($host, $user, $password, $database);
		return TRUE;
	}

	/**
	* 	Debido a que derivamos de clase abstracta, 
	*	hay que implementar estos métodos 
	*/
	public function disconnect(){
		$this->connection->close();
		return TRUE;
	}

	/**
	*	Recibir el query
	*/
	public function prepare($query){
		$this->query = $query;	
		return TRUE;
	}
	
	/**
	*	Enviar a ejecución el query
	*/
	public function query(){
		if ( isset($this->query) ){
			$this->result = $this->connection->query($this->query);
		} else {
			return FALSE;
		}
	}
	
	/**
	*	Sanitizar la entrada para evitar inyección sql
	*/
	public function escape($data){
		return $this->connection->real_escape_string($data);
	}
	
	/**
	*	Obtener una fila del resultado de un query 
	*/
	public function fetch($type = 'object'){
		if ( isset($this->result) ){
			switch ($type){
				case 'array':
					$row = $this->result->fetch_array();
					break;
				case 'object':
					// por hacer
				default:
					$row = $this->result->fetch_object();
					break;
			}
			return $row;
		}
		return FALSE;
	}
}
?>
