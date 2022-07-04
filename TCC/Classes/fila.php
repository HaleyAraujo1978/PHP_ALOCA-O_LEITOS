<?php

Class fila

{
	private $pdo;
	public $msgErro = ""; //ok sem erro
	
	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		//global $msgErro;
		try{
			$pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
		} catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
	}
	
	public function cadastrar($setor, $paciente, $entrada)
	{
		global $pdo;
		$sql = $pdo->prepare("INSERT INTO fila (setor, paciente, entrada) VALUES (:s, :p, :e)");
		$sql->bindValue(":s",$setor);
		$sql->bindValue(":p",$paciente);
		$sql->bindValue(":e",$entrada);
		$sql->execute();
		return true;
	}

	public function logar($email, $senha)
	{
		global $pdo;
		//verificar se o email e senha estão cadastrados, se sim 
		$sql = $pdo->prepare("SELECT id_usuario, nome, level FROM usuarios WHERE email = :e AND senha = :s");
		$sql->bindValue(":e",$email);
		$sql->bindValue(":s",md5($senha));
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			//entrar no sistema
			$dado = $sql->fetch();
			session_start();
			$_SESSION['id_usuario'] = $dado['id_usuario'];		
			$_SESSION['nome'] = $dado['nome'];
			$_SESSION['level'] = $dado['level'];
			return true; //logado com sucesso
		}
		else
		{
			return false; //não conseguiu logar
		}			
				
	}
}

?>