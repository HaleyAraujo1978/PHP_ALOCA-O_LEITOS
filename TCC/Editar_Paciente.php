<html lang="pt-br">
	
	<head>
		<meta charset="utf-8"/>
		<title>TCC - Alocação de Leitos</title>
		<link rel="stylesheet" href="estilo.css">
	</head>
	
	<body>
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
				$Cod_paciente = intval($_GET['Codigo']);
				//verificar se está tudo preenchido
				if(!empty($nome) && !empty($RG) && !empty($CPF)&& !empty($endereco) && !empty($email) && !empty($telefone) && !empty($status))
				{
					$conexao = mysqli_connect("localhost","root","","tcc");
					if($conexao)
					{
						$sql = "UPDATE pacientes SET nome = '$nome', RG = '$RG', CPF = '$CPF', endereco = '$endereco', email = '$email', telefone = '$telefone', status = '$status' WHERE Id_paciente = '$Cod_paciente'";
						$consulta = mysqli_query($conexao, $sql);
						if($consulta)
						{
							?>
							<link rel="stylesheet" href="estilo.css">
							<div id="msg-erro">Alterado com sucesso</div>
							<?php							
						}else
						{
							?>
							<link rel="stylesheet" href="estilo.css">
							<div id="msg-erro">Ocorreu erro na gravação</div>
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
			}else
			{
				$Cod_paciente = intval($_GET['Codigo']);
				$conexao = mysqli_connect("localhost","root","","tcc");
				if(!$conexao){print "Falha na conexao";}
				else{
					$sql = "select * from pacientes WHERE Id_paciente = '$Cod_paciente'";
					$consulta = mysqli_query($conexao, $sql);
					$registros = mysqli_fetch_array($consulta);
					$nome = $registros['nome'];
					$RG = $registros['RG'];
					$CPF = $registros['CPF'];
					$endereco = $registros['endereco'];
					$email = $registros['email'];
					$telefone = $registros['telefone'];					
					$status = $registros['status'];
				}
			}
		?>
		<div id="titulo2">Edição de Paciente</div>
			<form method = "POST">
				<input type="text" name="nome" value='<?php echo $nome; ?>' placeholder="Nome" maxlength="40"><br>
				<input type="text" name="RG" value='<?php echo $RG; ?>' placeholder="RG" maxlength="15"><br>
				<input type="text" name="CPF" value='<?php echo $CPF; ?>' placeholder="CPF" maxlength="11"><br>
				<input type="text" name="endereco" value='<?php echo $endereco; ?>' placeholder="Endereço" maxlength="40"><br>				
				<input type="email" name="email" value='<?php echo $email; ?>' placeholder="E-mail" maxlength="32"><br>
				<input type="text" name="telefone" value='<?php echo $telefone; ?>' placeholder="Telefone" maxlength="11"><br>
				<div id="txtUsu">Status:</div>
				<select name="status">
					<option value ="Consulta" <?php if($status == 'Consulta'){echo 'selected';}?>>Consulta</option>
					<option value ="Alta" <?php if($status == 'Alta'){echo 'selected';}?>>Alta</option>
					<option value ="Internado" <?php if($status == 'Internado'){echo 'selected';}?>>Internado</option>
					<option value ="Fila" <?php if($status == 'Fila'){echo 'selected';}?>>Fila</option>
				</select><br>
				<input id="entrar" type="submit" name "salvar" value="SALVAR">
				<br>
			</form>
	</body>
</html>
			