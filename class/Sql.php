<?php 

class Sql extends PDO{
	/*
	$conn Deve estar aqui, pois, se estivesse dentro de função só teria escopo na função.
	Logo não poderia ser acessado por outros métodos que precisam de conn.
	*/
	private $conn; 
	

	public function __construct(){
		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
	}


	private function setParams($statement, $parameters = array()){
		foreach ($parameters as $key => $value) {
				$this->setParam($statement, $key, $value);
		}
	}

	private function setParam($statement, $key, $value){
		$statement->bindParam($key, $value); //Substitui valores
	}

	public function query($rawQuery, $params = array()){
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt; //Deve se retornar o objeto e não somente o resultado do método $stmt->execute
	}


	public function select($rawQuery, $params = array()):array
	{
		$stmt = $this->query($rawQuery, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}//Esta funcao irá retornar um array de arrays

	/*
	public function query($rawQuery, $params = array()){
		$stmt = $this->conn->prepare($rawQuery);
			foreach ($params as $key => $value) {
				$stmt->bindParam($key, $value);
			}	
	
	return $stmt->execute();
	}
	*/
}


?>