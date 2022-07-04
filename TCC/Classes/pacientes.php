<?php

Class paciente

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
	
	public function cadastrar($RG, $CPF, $endereco, $email, $nome, $telefone, $status)
	{
		global $pdo;
		//verificar se já existe cpf e email cadastrado//
		$sql = $pdo->prepare("SELECT Id_paciente FROM pacientes WHERE email = :d OR CPF = :b");
		$sql->bindValue(":d",$email);
		$sql->bindValue(":b",$CPF);
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			return false; //ja está cadastrado	
		}
		else
		{			
			// caso não, cadastrar//
			$sql = $pdo->prepare("INSERT INTO pacientes (RG, CPF, endereco, email, nome, telefone, status) VALUES (:a, :b, :c, :d, :e, :t, :g)");
			$sql->bindValue(":a",$RG);
			$sql->bindValue(":b",$CPF);
			$sql->bindValue(":c",$endereco);
			$sql->bindValue(":d",$email);
			$sql->bindValue(":e",$nome);
			$sql->bindValue(":t",$telefone);
			$sql->bindValue(":g",$status);
			$sql->execute();
			return true;
		}
	}
}
?>