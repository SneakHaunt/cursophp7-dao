<?php 

require_once("config.php");

//$sql = new Sql();

//$usuarios = $sql->select("SELECT * FROM tb_usuarios");

//echo json_encode($usuarios);


//Carrega um usuário.
//$root = new Usuario();
//$root->loadById(7);
//echo $root;

//Carrega uma lista de usuários.
//$lista = Usuario::getList();
//echo json_encode($lista)


//Carrega uma lista de usuários buscando pelo login.
//$search = Usuario::search("jo");
//echo json_encode($search);


//Carrega um usuário usando o login e a senha.
//$usuario = new Usuario();
//$usuario->login("Zeca","54321");
//echo $usuario; //Echo írá invocar __toString e exibirá json na tela.

//Criando um novo usuário
//$aluno = new Usuario("aluno","@luno");
//$aluno->setDeslogin("aluno"); Não é necessário se tiver construtor.
//$aluno->setDessenha("@lun0"); Não é necessário se tiver construtor.
//$aluno->insert();
//echo $aluno;

$usuario = new Usuario();
//Usa-se loadById com o ID que sofrerá a alteração.
$usuario->loadById(8);
/*
Precisa do loadById antes, porque, ele carrega o ID dentre outros dados do banco e passa para o objeto, 
em seguida, o método update irá atraves do getter obter o ID que deve ser alterado.
*/
$usuario->update("professor","456"); 

echo $usuario;

?>