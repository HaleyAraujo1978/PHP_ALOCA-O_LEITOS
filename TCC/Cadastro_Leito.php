<?php
	require_once 'Classes\Leitos.php';
	$u = new leito;
?>

<html lang="pt-br">
	
	<head>
		<meta charset="utf-8"/>
		<title>TCC - Alocação de Leitos</title>
		<link rel="stylesheet" href="estilo.css">
	</head>
	
	<body>		
			<div id="titulo2">Cadastro de Leito</div>
			<form method = "POST">
				<br>			
				<select name="setor">
					<option value ="CTI">CTI</option>
					<option value ="Enfermaria">Enfermaria</option>
					<option value ="UTI">UTI</option>
					<option value ="Hotel">Hotel</option>
				</select><br>
				<input type="text" name="quarto" placeholder="Quarto" maxlength="4"><br>
				<input type="text" name="numero" placeholder="Número" maxlength="3"><br>
				<select name="status">
					<option value ="Alocado">Alocado</option>
					<option value ="Desalocado">Desalocado</option>
					<option value ="Manutenção">Manutenção</option>
				</select><br>	
				<input id="entrar" type="submit" name "salvar" value="SALVAR">
				<br>
			</form>
		<?php
			//verificar se clicou no botão			
			if(isset($_POST['quarto']))
			{
				$setor = addslashes($_POST['setor']);
				$quarto = addslashes($_POST['quarto']);
				$numero = addslashes($_POST['numero']);
				$status = addslashes($_POST['status']);
				//verificar se está tudo preenchido
				if(!empty($setor) && !empty($quarto) && !empty($numero) && !empty($status))
				{
					$u->conectar("TCC", "localhost","root","");
					if($u->msgErro == "")
					{
						if($u->cadastrar($setor, $quarto, $numero, $status))
							{
							?>
							<link rel="stylesheet" href="estilo.css">
							<div id="msg-erro">Cadastrado com sucesso</div>
							<?php							

						}else
						{
							?>
							<link rel="stylesheet" href="estilo.css">
							<div id="msg-erro">Leito já cadastrado</div>
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