<?php
	$conexao = mysqli_connect("localhost","root","","tcc");
	if(!$conexao){print "Falha na conexao";}
	else{
		$sql = "select * from usuarios order by nome";
		$consulta = mysqli_query($conexao, $sql);
		$registros = mysqli_num_rows($consulta);
	}
?>

<html lang="pt-br">
	
	<head>
		<meta charset="utf-8"/>
		<title>TCC - Alocação de Leitos</title>
		<link rel="stylesheet" type="text/css" href="estilo.css"/>
	</head>
	
	<body>		
		<div id="titulo2">Consulta de Usuário</div>			
		<br>
		<?php
			echo $registros." registros encontrados";
		?>
		<br>
			<br>
			<br>
			<table id="consulta">
				<tr>
					<td>ID</td>
					<td>E-mail</td>
					<td>Nome</td>
					<td>Telefone</td>
					<td>Level</td>
					<td></td>
				</tr>
				<?php				
				while($exibirRegistros = mysqli_fetch_array($consulta))
				{
					$Id_usuario = $exibirRegistros[0];
					$email = $exibirRegistros[1];
					$nome = $exibirRegistros[2];
					$telefone = $exibirRegistros[3];
					$level = $exibirRegistros[4];
					?>
					<tr>
						<td><?php print "$Id_usuario<br>"; ?></td>
						<td><?php print "$email<br>"; ?></td>
						<td><?php print "$nome<br>"; ?></td>
						<td><?php print "$telefone<br>"; ?></td>
						<td><?php print "$level"; ?></td>
						<td>
							<a href="menu.php?p=Editar_Usuario&Codigo=<?php echo $Id_usuario;?>"><img src="editar.png" width="30" height="30"></img></a>
							<a href="javascript: if(window.confirm('Confirma exclusão do usuário <?php echo $nome;?>')) location.href='menu.php?p=Deletar_Usuario&Codigo=<?php echo $Id_usuario; ?>';"><img src="excluir.png" width="30" height="30"></img></a>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
	</body>
</html>