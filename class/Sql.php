<?php 

class Sql extends PDO{

	private $conn;

	public function __construct(){
		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
	}


	private function setParams($statment, $parameters = array()){
		foreach ($parameters as $key => $value) {
				$this->setParam($statment,$key,$value);
		}
	}

	private function setParam($statment, $key, $param){
		$statment->bindParam($key,$value);
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
	}







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