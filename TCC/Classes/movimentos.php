<?php

Class movimento

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
	
	public function cadastrar($paciente, $leito, $mov, $data_mov)
	{
		global $pdo;
		$sql = $pdo->prepare("INSERT INTO movimentos (paciente, leito, movimento, data_mov) VALUES (:p, :l, :m, :d)");
		$sql->bindValue(":p",$paciente);
		$sql->bindValue(":l",$leito);
		$sql->bindValue(":m",$mov);
		$sql->bindValue(":d",$data_mov);
		//$sql->bindValue(":d",$data_mov);
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