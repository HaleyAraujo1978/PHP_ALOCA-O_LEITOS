<?php
	$conexao = mysqli_connect("localhost","root","","tcc");
	if(!$conexao){print "Falha na conexao";}
	else{
		$sql = "select * from pacientes order by nome";
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
		<div id="titulo2">Consulta de Paciente</div>			
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
					<td>Nome</td>
					<td>Telefone</td>
					<td>CPF</td>
					<td>Status</td>
					<td></td>
				</tr>
				<?php				
				while($exibirRegistros = mysqli_fetch_array($consulta))
				{
					$Id_paciente = $exibirRegistros[0];
					$nome = $exibirRegistros[5];
					$telefone = $exibirRegistros[6];
					$CPF = $exibirRegistros[2];
					$status = $exibirRegistros[7];
					?>
					<tr>
						<td><?php print "$Id_paciente<br>"; ?></td>
						<td><?php print "$nome<br>"; ?></td>
						<td><?php print "$telefone<br>"; ?></td>
						<td><?php print "$CPF<br>"; ?></td>
						<td><?php print "$status"; ?></td>
						<td>
							<a href="menu.php?p=Editar_Paciente&Codigo=<?php echo $Id_paciente;?>"><img src="editar.png" width="30" height="30"></img></a>
							<a href="javascript: if(window.confirm('Confirma exclusão do paciente <?php echo $nome;?>')) location.href='menu.php?p=Deletar_Paciente&Codigo=<?php echo $Id_paciente; ?>';"><img src="excluir.png" width="30" height="30"></img></a>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
	</body>
</html>