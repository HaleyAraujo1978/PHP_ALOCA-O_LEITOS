<?php
	require_once 'Classes\pacientes.php';
	$u = new paciente;
?>

<html lang="pt-br">
	
	<head>
		<meta charset="utf-8"/>
		<title>TCC - Alocação de Leitos</title>
		<link rel="stylesheet" href="estilo.css">
	</head>
	
	<body>		
			<div id="titulo2">Cadastro de Paciente</div>
			<form method = "POST">
				
				<input type="text" name="nome" placeholder="Nome" maxlength="40"><br>
				<input type="text" name="RG" placeholder="RG" maxlength="15"><br>
				<input type="text" name="CPF" placeholder="CPF" maxlength="11"><br>
				<input type="text" name="endereco" placeholder="Endereço" maxlength="40"><br>				
				<input type="email" name="email" placeholder="E-mail" maxlength="32"><br>
				<input type="text" name="telefone" placeholder="Telefone" maxlength="11"><br>
				<div id="txtUsu">Status:</div>
				<select name="status">
					<option value ="Consulta">Consulta</option>
					<option value ="Alta">Alta</option>
					<option value ="Internado">Internado</option>
					<option value ="Fila">Fila</option>
				</select><br>
				<input id="entrar" type="submit" name "salvar" value="SALVAR">
				<br>
			</form>
		<?php
			//verificar se clicou no botão			
			if(isset($_POST['email']))
			{
				$nome = addslashes($_POST['nome']);
				$RG = addslashes($_POST['RG']);
				$CPF = addslashes($_POST['CPF']);
				$endereco = addslashes($_POST['endereco']);
				$email = addslashes($_POST['email']);
				$telefone = addslashes($_POST['telefone']);
				$status = addslashes($_POST['status']);
				//verificar se está tudo preenchido
				if(!empty($nome) && !empty($RG) && !empty($CPF)&& !empty($endereco) && !empty($email) && !empty($telefone) && !empty($status))
				{
					$u->conectar("TCC", "localhost","root","");
					if($u->msgErro == "")
					{
						if($u->cadastrar($RG, $CPF, $endereco, $email, $nome, $telefone, $status))
						{
							?>
							<link rel="stylesheet" href="estilo.css">
							<div id="msg-erro">Cadastrado com sucesso</div>
							<?php							
						}else
						{
							?>
							<link rel="stylesheet" href="estilo.css">
							<div id="msg-erro">Paciente já cadastrado</div>
							<?php														
						}
					}
					else
					{
						?>
						<link rel="stylesheet" href="estilo.css">
						<div id="msg-erro">Não foi possível conectar ao servidor!</div>
						<?php	
					}
				}else
				{
					?>
					<link rel="stylesheet" href="estilo.css">
					<div id="msg-erro">Preencha todos os campos!</div>
					<?php
				}
			}
		?>
	</body>
</html>