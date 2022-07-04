<html lang="pt-br">
	
	<head>
		<meta charset="utf-8"/>
		<title>TCC - Alocação de Leitos</title>
		<link rel="stylesheet" href="estilo.css">
	</head>
	
	<body>
		<?php
			//verificar se clicou no botão			
			if(isset($_POST['numero']))
			{
				$setor = addslashes($_POST['setor']);
				$quarto = addslashes($_POST['quarto']);
				$numero = addslashes($_POST['numero']);
				$status = addslashes($_POST['status']);
				$Cod_leito = intval($_GET['Codigo']);
				//verificar se está tudo preenchido
				if(!empty($setor) && !empty($quarto) && !empty($numero)&& !empty($status))
				{
					$conexao = mysqli_connect("localhost","root","","tcc");
					if($conexao)
					{
						$sql = "UPDATE leitos SET setor = '$setor', quarto = '$quarto', numero = '$numero', status = '$status' WHERE Id_leito = '$Cod_leito'";
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
				$Cod_leito = intval($_GET['Codigo']);
				$conexao = mysqli_connect("localhost","root","","tcc");
				if(!$conexao){print "Falha na conexao";}
				else{
					$sql = "select * from leitos WHERE Id_leito = '$Cod_leito'";
					$consulta = mysqli_query($conexao, $sql);
					$registros = mysqli_fetch_array($consulta);
					$setor = $registros['setor'];
					$quarto = $registros['quarto'];
					$numero = $registros['numero'];
					$status = $registros['status'];
				}
			}
		?>
		<div id="titulo2">Edição de Leito</div>			
		<form method = "POST">
			<br>
			<select name="setor">
				<option value ="CTI" <?php if($setor == 'CTI'){echo 'selected';}?>>CTI</option>
				<option value ="Enfermaria" <?php if($setor == 'Enfermaria'){echo 'selected';}?>>Enfermaria</option>
				<option value ="UTI" <?php if($setor == 'UTI'){echo 'selected';}?>>UTI</option>
				<option value ="Hotel" <?php if($setor == 'Hotel'){echo 'selected';}?>>Hotel</option>
			</select><br>
			<input type="text" name="quarto" value='<?php echo $quarto; ?>' placeholder="Quarto" maxlength="4"><br>
			<input type="text" name="numero" value='<?php echo $numero; ?>' placeholder="Numero" maxlength="3"><br>
			<select name="status">
				<option value ="Alocado" <?php if($status == 'Alocado'){echo 'selected';}?>>Alocado</option>
				<option value ="Desalocado" <?php if($status == 'Desalocado'){echo 'selected';}?>>Desalocado</option>
				<option value ="Manutenção" <?php if($status == 'Manutenção'){echo 'selected';}?>>Manutenção</option>
			</select><br>			
			<input id="entrar" type="submit" name "salvar" value="SALVAR">
			<br>
		</form>
	</body>
</html>
			