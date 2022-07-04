<?php
	$conexao = mysqli_connect("localhost","root","","tcc");
	if(!$conexao){print "Falha na conexao";}
	else{
		$sql = "select * from leitos order by setor, quarto, numero";
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
		<div id="titulo2">Consulta de Leito</div>			
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
					<td>Setor</td>
					<td>Quarto</td>
					<td>Leito</td>
					<td>Status</td>
					<td></td>
				</tr>
				<?php				
				while($exibirRegistros = mysqli_fetch_array($consulta))
				{
					$Id_leito = $exibirRegistros[0];
					$setor = $exibirRegistros[1];
					$quarto = $exibirRegistros[2];
					$numero = $exibirRegistros[3];
					$status = $exibirRegistros[4];
					?>
					<tr>
						<td><?php print "$Id_leito<br>"; ?></td>
						<td><?php print "$setor<br>"; ?></td>
						<td><?php print "$quarto<br>"; ?></td>
						<td><?php print "$numero<br>"; ?></td>
						<td><?php print "$status"; ?></td>
						<td>
							<a href="menu.php?p=Editar_Leito&Codigo=<?php echo $Id_leito;?>"><img src="editar.png" width="30" height="30"></img></a>
							<a href="javascript: if(window.confirm('Confirma exclusão do leito <?php echo " ".$setor." ".$quarto." ".$numero;?>')) location.href='menu.php?p=Deletar_Leito&Codigo=<?php echo $Id_leito; ?>';"><img src="excluir.png" width="30" height="30"></img></a>
							<a href="javascript: if(window.confirm('Confirma desalocação do leito <?php echo " ".$setor." ".$quarto." ".$numero;?>')) if(window.confirm('Deseja alocar o leito <?php echo " ".$setor." ".$quarto." ".$numero;?> com pacientes da fila?'));"><img src="cama.png" width="30" height="30"></img></a>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
	</body>
</html>