<html lang="pt-br">
	
	<head>
		<meta charset="utf-8"/>
		<title>TCC - Alocação de Leitos</title>
		<link rel="stylesheet" href="estilo.css">
	</head>
	
	<body>		
		<div id="titulo2">Alocar de Leito</div>
		<form method = "POST">		
			<?php				
				$mysqli = NEW MySQLi('localhost', 'root','','tcc');
				$resultSet = $mysqli->query("SELECT * FROM pacientes WHERE status = 'Consulta'");
			?>					
			<br>
			<a>Paciente:</a>
			<select name="paciente">
				<?php
				while($rows = $resultSet->fetch_assoc())
				{
					$Id_paciente = $rows['Id_paciente'];
					$nome_paciente = $rows['nome'];
					echo "<option value='$Id_paciente'>$nome_paciente</option>";
				}
				?>
			</select><br>
			<a>Setor:</a>
			<select name="setor">
				<option value ="CTI">CTI</option>
				<option value ="Enfermaria">Enfermaria</option>
				<option value ="UTI">UTI</option>
				<option value ="Hotel">Hotel</option>
			</select><br>
			<button type="submit"><img src="lupa.png" style="max-widht:64px; max-height:64px;"></button>
			<?php
			if(isset($_POST['setor']))
			{
				$setor = addslashes($_POST['setor']); 
				$movimento = 'Alocar';
				$agora = date('d/m/Y H:i');
				$conexao = mysqli_connect("localhost","root","","tcc");
				if(!$conexao){print "Falha na conexao";}
				else{
					$sql = "select * from leitos where status = 'Desalocado' and setor = '$setor'";
					$consulta = mysqli_query($conexao, $sql);
					$registros = mysqli_num_rows($consulta);
				}

				if($registros > 0)
				{?>
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
						while($registros = mysqli_fetch_array($consulta))
						{
							$Id_leito = $registros[0];
							$setor = $registros[1];
							$quarto = $registros[2];
							$numero = $registros[3];
							$status = $registros[4];
							?>
							<tr>
								<td><?php print "$Id_leito<br>"; ?></td>
								<td><?php print "$setor<br>"; ?></td>
								<td><?php print "$quarto<br>"; ?></td>
								<td><?php print "$numero<br>"; ?></td>
								<td><?php print "$status"; ?></td>
								<td>
									<a href="javascript: if(window.confirm('Confirma a alocação do leito <?php echo " ".$setor." ".$quarto." ".$numero;?> para o paciente <?php echo $nome_paciente;?>?'))location.href='menu.php?p=Cadastrar_Movimento&paciente=<?php echo $Id_paciente;?>&leito=<?php echo $Id_leito;?>&mov=<?php echo $movimento;?>&data_mov=<?php echo $agora;?>';">
								</td>
							</tr>
							<?php
						}
						?>	
					</table>
					<?php
				}
				else
				{?>
					<br><br>
					<?php
					echo "Confirma a inclusão do paciente ".$nome_paciente." na fila do setor ".$setor."?";
					?>
					<br>
					<button type="button" onclick "executa()"><img src="fila.jpg" style="max-widht:64px; max-height:64px;"></button> 
					<?php 
					require_once 'Classes\fila.php'; 
					$u = new fila; 
					$u->conectar("TCC", "localhost","root",""); 
					if($u->cadastrar($setor, $Id_paciente, $agora))
					{?>
						<link rel="stylesheet" href="estilo.css">
						<div id="msg-erro">Paciente Inserido na Fila!</div>
					<?php
					}
				}
			}
			?>					
		</form>
	</body>
</html>