<?php

Class leito

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
	
	public function cadastrar($setor, $quarto, $numero, $status)
	{
		global $pdo;
		//verificar se já existe leito cadastrado//
		$sql = $pdo->prepare("SELECT id_leito FROM leitos WHERE setor = :s AND quarto = :q AND numero = :n");
		$sql->bindValue(":s",$setor);
		$sql->bindValue(":q",$quarto);
		$sql->bindValue(":n",$numero);
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			return false; //ja está cadastrado	
		}
		else
		{			
			// caso não, cadastrar//
			$sql = $pdo->prepare("INSERT INTO leitos (setor, quarto, numero, status) VALUES (:s, :q, :n, :t)");
			$sql->bindValue(":s",$setor);
			$sql->bindValue(":q",$quarto);
			$sql->bindValue(":n",$numero);
			$sql->bindValue(":t",$status);
			$sql->execute();
			return true;
		}
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