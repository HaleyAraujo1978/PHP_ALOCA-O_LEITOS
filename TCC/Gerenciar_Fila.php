<?php
	$conexao = mysqli_connect("localhost","root","","tcc");
	if(!$conexao){print "Falha na conexao";}
	else{
		$sql = "select * from fila, pacientes where paciente = Id_paciente";
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
		<div id="titulo2">Fila de Pacientes Aguardando Leito</div>			
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
					<td>Status</td>
					<td>Leitos</td>
					<td></td>
				</tr>
				<?php				
				while($exibirRegistros = mysqli_fetch_array($consulta))
				{
					$Id_paciente = $exibirRegistros[2];
					$nome = $exibirRegistros[9];
					$status = $exibirRegistros[11];
					?>
					<tr>
						<td><?php print "$Id_paciente<br>"; ?></td>
						<td><?php print "$nome<br>"; ?></td>
						<td><?php print "$status"; ?></td>
						<td><?php				
							$mysqli = NEW MySQLi('localhost', 'root','','tcc');
							$resultSet = $mysqli->query("SELECT * FROM leitos WHERE status = 'Desalocado'");
							?>					
							<select name="leito">
							<?php
								while($rows = $resultSet->fetch_assoc())
								{
									$Id_leito = $rows['Id_leito'];
									$setor = $rows['setor'];
									$quarto = $rows['quarto'];
									$numero = $rows['numero'];
									echo "<option value='$Id_leito'>$setor $quarto $numero</option>";
								}
							?>
							</select>
							<a href="javascript: if(window.confirm('Confirma alocação do leito <?php echo " ".$setor." ".$quarto." ".$numero;?> para o paciente <?php echo $nome?>;'));"><img src="cama.png" width="30" height="30"></img></a>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
	</body>
</html>