<?php
	require_once 'Classes\usuarios.php';
	$u = new usuario;
?>

<html lang="pt-br">
	
	<head>
		<meta charset="utf-8"/>
		<title>TCC - Alocação de Leitos</title>
		<link rel="stylesheet" type="text/css" href="estilo.css"/>
	</head>
	
	<body>
		<div id="corpo-form">
			<div id="titulo_imagem"><img src="davi.jpg" alt="some text" width=80 height=80><div id="titulo">Acesso ao Sistema</div></div>
			<script language=javascript type="text/javascript">
				dayName = new Array ("Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "sábado")
				monName = new Array ("janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto","setembro","outubro", "novembro", "dezembro")
				now = new Date
				document.write (dayName[now.getDay() ] + ", " + now.getDate () + " de " + monName [now.getMonth() ]   +  " de "  +     now.getFullYear () + ".")
			</script>			
			<form method = "POST">
				<hr/><hr/>
				<div id="login">
					<br>
					<input type="email" name="email" placeholder="Usuário (e-mail)" maxlength="40">
					<input type="password" name="senha" placeholder="Senha" maxlength="32">
					<input id="entrar" type="submit" name "button_menu" value="ACESSAR">
					<br>
				</div>
			</form>
			<?php
				if(isset($_POST['email']))				
				{
					$email = addslashes($_POST['email']);
					$senha = addslashes($_POST['senha']);
					if (!empty($email) && !empty($senha))
					{
						$u->conectar("tcc", "localhost","root","");
						if($u->msgErro == "")
						{					
							if ($u->logar($email, $senha) == true)
							{
								header('location: menu.php');
							}else
							{
								?>
								<link rel="stylesheet" href="estilo.css">
								<div id="msg-erro-login">Email e/ou senha incorretos!</div>
								<?php
							}
						}else
						{
							?>
							<link rel="stylesheet" href="estilo.css">
							<div id="msg-erro-login">Não foi possível conectar ao servidor!</div>
							<?php						
						}
					}else
					{
						?>
						<link rel="stylesheet" href="estilo.css">
						<div id="msg-erro-login">Preencha todos os campos!</div>
						<?php
					}
				}
			?>
		</div>	
	</body>
</html>