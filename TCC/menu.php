<?php
	session_start();
	if(!isset($_SESSION['nome']))
	{
		header("location: index.php");
		exit;
	}else
	{
		$usuario = $_SESSION['nome'];
		$level = $_SESSION['level'];
	}
?>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<title>TCC - Alocação de Leitos</title>
		<link rel="stylesheet" type="text/css" href="estilo.css"/>
	</head>
	<body>		
		<div id="tempo"><?php require_once 'tempo.php';?></div>
		<div id="cadastro">Menu</div>
		<div id="texto">
			<hr>
			<table>
				<tr>
					<td style="width:200px">Usuários</td>
				</tr>
				
				<tr>
					<td><a href="./menu.php?p=Cadastro_Usuario">Incluir</a></td>
					<td><a href="./menu.php?p=Consulta_Usuario">Consultar</a></td>
				</tr>
			</table>	
			<hr>
			<table>
				<tr>
					<td style="width:200px">Paciente</td>
				</tr>	
				<tr>
					<td><a href="./menu.php?p=Cadastro_Paciente">Incluir</a></td>
					<td><a href="./menu.php?p=Consulta_Paciente">Consultar</a></td>
				</tr>
			</table>	
			<hr>
			<table>
				<tr>
					<td style="width:200px">Leitos</td>
				</tr>
				
				<tr>
					<td><a href="./menu.php?p=Cadastro_Leito">Incluir</a></td>
					<td><a href="./menu.php?p=Consulta_Leito">Consultar</a></td>
				</tr>
				
				<tr>
					<td><a href="./menu.php?p=Alocar_Leito">Alocar</a></td>
					<td><a href="./menu.php?p=Gerenciar_Fila">Fila</a></td>
				</tr>
			</table>
		</div>
		
		<div id="corpo">
			<?php	
				$valor = @$_GET['p'];
				if ($valor == 'Cadastro_Usuario'){require_once 'Cadastro_Usuario.php';}
				if ($valor == 'Consulta_Usuario'){require_once 'Consulta_Usuario.php';}
				if ($valor == 'Deletar_Usuario'){require_once 'Deletar_Usuario.php';}
				if ($valor == 'Editar_Usuario'){require_once 'Editar_Usuario.php';}
				if ($valor == 'Cadastro_Paciente'){require_once 'Cadastro_Paciente.php';}
				if ($valor == 'Consulta_Paciente'){require_once 'Consulta_Paciente.php';}
				if ($valor == 'Deletar_Paciente'){require_once 'Deletar_Paciente.php';}
				if ($valor == 'Editar_Paciente'){require_once 'Editar_Paciente.php';}
				if ($valor == 'Cadastro_Leito'){require_once 'Cadastro_Leito.php';}
				if ($valor == 'Consulta_Leito'){require_once 'Consulta_Leito.php';}
				if ($valor == 'Deletar_Leito'){require_once 'Deletar_Leito.php';}
				if ($valor == 'Editar_Leito'){require_once 'Editar_Leito.php';}
				if ($valor == 'Alocar_Leito'){require_once 'Alocar_Leito.php';}
				if ($valor == 'Gerenciar_Fila'){require_once 'Gerenciar_Fila.php';}
				if ($valor == 'Cadastrar_Movimento'){require_once 'Cadastrar_Movimento.php';}
			?>					
		</div>
		
		<div id="rodape">
			<div id="txtUsu">Usuário:
				<?php
				echo $usuario;
				?>
			</div>
		</div>

	</body>	
</html>		