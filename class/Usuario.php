<?php 

class Usuario{
/*
Métodos que não contém $this optar por deixa-los estáticos, pois, estes não estão tão "amarrados" com a classe.
*/



private $idusuario;
private $deslogin;
private $dessenha;
private $dtcadastro;

	public function getIdusuario(){
		 return $this->idusuario;
	}

	public function setIdusuario($value){
		 $this->idusuario = $value;
	}

	public function getDeslogin(){
		 return $this->deslogin;
	}

	public function setDeslogin($value){
		 $this->deslogin = $value;
	}

	public function getDessenha(){
		 return $this->dessenha;
	}

	public function setDessenha($value){
		 $this->dessenha = $value;
	}


	public function getDtcadastro(){
		 return $this->dtcadastro;
	}

	public function setDtcadastro($value){
		 $this->dtcadastro = $value;
	}


	public function loadById($id){
		$sql = new Sql();
		/* Results é um array de arrays */
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
	    ));

		/*
			count conta número de elementos em um array.
			No if abaixo o parametro do set representam as colunas do banco de dados.
		*/

		if (count($results) > 0){//ou if(isset($results[0])

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
	
		}
	}

	public function __toString(){

			return json_encode(array(
				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDesSenha(),
				/* Retorna um objeto DateTime, logo, é possível usar métodos do DateTime. */
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s") 
			));  

	}


	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}


	public static function search ($login){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
			':SEARCH' => "%".$login."%"
		));
	}
	

	public function login($login, $password){
		$sql = new Sql();
		/* Results é um array de arrays */
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :DESSENHA ", array(
			":LOGIN"=>$login,
			":DESSENHA"=>$password
	    ));

		/*
			count conta número de elementos em um array.
			No if abaixo o parametro do set representam as colunas do banco de dados.
		*/

		if (count($results) > 0){//ou if(isset($results[0])

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
	
		}else{
			throw new Exception("Login e/ou senha inválidos.");
		}
	} 


}

?>