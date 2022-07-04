<?php
	require_once 'Classes\usuarios.php';
	$u = new usuario;
?>

<html lang="pt-br">
	
	<head>
		<meta charset="utf-8"/>
		<title>TCC - Alocação de Leitos</title>
		<link rel="stylesheet" href="estilo.css">
	</head>
	
	<body>		
			<div id="titulo2">Cadastro de Usuário</div>
			<form method = "POST">
				<br>
				<input type="email" name="email" placeholder="Usuário (e-mail)" maxlength="32"><br>
				<input type="text" name="nome" placeholder="Nome" maxlength="40"><br>
				<input type="text" name="telefone" placeholder="Telefone" maxlength="11"><br>				
				<select name="level">
					<option value ="1">Level 1</option>
					<option value ="2">Level 2</option>
					<option value ="3">Level 3</option>
					<option value ="4">Level 4</option>
				</select><br>
				<input type="password" name="senha" placeholder="Senha" maxlength="30"><br>
				<input type="password" name="confsenha" placeholder="Confirmar Senha" maxlength="30"><br>
				<input id="entrar" type="submit" name "salvar" value="SALVAR">
				<br>
			</form>
		<?php
			//verificar se clicou no botão			
			if(isset($_POST['email']))
			{
				$email = addslashes($_POST['email']);
				$nome = addslashes($_POST['nome']);
				$telefone = addslashes($_POST['telefone']);
				$level = addslashes($_POST['level']);
				$senha = addslashes($_POST['senha']);
				$confsenha = addslashes($_POST['confsenha']);
				//verificar se está tudo preenchido
				if(!empty($email) && !empty($nome) && !empty($telefone)&& !empty($level) && !empty($senha) && !empty($confsenha))
				{
					$u->conectar("TCC", "localhost","root","");
					if($u->msgErro == "")
					{
						if($senha == $confsenha)
						{
							if($u->cadastrar($nome, $telefone, $email, $senha, $level))
							{
								?>
								<link rel="stylesheet" href="estilo.css">
								<div id="msg-erro">Cadastrado com sucesso</div>
								<?php							
	
							}else
							{
								?>
								<link rel="stylesheet" href="estilo.css">
								<div id="msg-erro">Usuário já cadastrado</div>
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
			}
		?>
	</body>
</html>