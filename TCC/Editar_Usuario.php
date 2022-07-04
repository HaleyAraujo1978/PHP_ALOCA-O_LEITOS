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
				$email = addslashes($_POST['email']);
				$nome = addslashes($_POST['nome']);
				$telefone = addslashes($_POST['telefone']);
				$level = addslashes($_POST['level']);
				$senha = md5(addslashes($_POST['senha']));
				$confsenha = md5(addslashes($_POST['confsenha']));
				$usu_codigo = intval($_GET['Usuario']);
				//verificar se está tudo preenchido
				if(!empty($email) && !empty($nome) && !empty($telefone)&& !empty($level) && !empty($senha) && !empty($confsenha))
				{
					$conexao = mysqli_connect("localhost","root","","tcc");
					if($conexao)
					{
						if($senha == $confsenha)
						{
							$sql = "UPDATE usuarios SET email = '$email', nome = '$nome', telefone = '$telefone', level = '$level', senha = '$senha' WHERE Id_usuario = '$usu_codigo'";
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
						}else
						{
							?>
							<link rel="stylesheet" href="estilo.css">
							<div id="msg-erro">Senha e confirmar não conferem</div>
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
				$usu_codigo = intval($_GET['Codigo']);
				$conexao = mysqli_connect("localhost","root","","tcc");
				if(!$conexao){print "Falha na conexao";}
				else{
					$sql = "select * from usuarios WHERE Id_usuario = '$usu_codigo'";
					$consulta = mysqli_query($conexao, $sql);
					$registros = mysqli_fetch_array($consulta);
					$email = $registros['email'];
					$nome = $registros['nome'];
					$telefone = $registros['telefone'];
					$level = $registros['level'];
				}
			}
		?>
		<div id="titulo2">Edição de Usuário</div>			
		<form method = "POST">
			<br>
			<input type="email" name="email" value='<?php echo $email; ?>' placeholder="Usuário (e-mail)" maxlength="32"><br>
			<input type="text" name="nome" value='<?php echo $nome; ?>' placeholder="Nome" maxlength="40"><br>
			<input type="text" name="telefone" value='<?php echo $telefone; ?>' placeholder="Telefone" maxlength="11"><br>				
			<select name="level">
				<option value ="1" <?php if($level == 1){echo 'selected';}?>>Level 1</option>
				<option value ="2" <?php if($level == 2){echo 'selected';}?>>Level 2</option>
				<option value ="3" <?php if($level == 3){echo 'selected';}?>>Level 3</option>
				<option value ="4" <?php if($level == 4){echo 'selected';}?>>Level 4</option>
			</select><br>
			<input type="password" name="senha" placeholder="Senha" maxlength="30"><br>
			<input type="password" name="confsenha" placeholder="Confirmar Senha" maxlength="30"><br>
			<input id="entrar" type="submit" name "salvar" value="SALVAR">
			<br>
		</form>
	</body>
</html>
			