<?php

/**
* Driver para MySQL
*/
class MysqlImproved_Driver extends Database_Library
{
	private $connection;
	private $query;
	private $result;

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

	/* Debido a que derivamos de clase abstracta, hay que implementar estos métodos */
	public function disconnect(){
		$this->connection->close();
		return TRUE;
	}

	public function prepare($query){
		$this->query = $query;	
		return TRUE;
	}

	public function query(){
		if ( isset($this->query) ){
			$this->result = $this->connection->query($this->query);
		} else {
			return FALSE;
		}
	}
		
	/* Obtener una fila del resultado de un query */
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
