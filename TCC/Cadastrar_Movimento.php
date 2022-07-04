<?php
	require_once 'Classes\movimentos.php';
	$u = new movimento;
	$paciente = $_GET['paciente'];
	$leito = $_GET['leito'];
	$mov = $_GET['mov']; 
	$data_mov = $_GET['data_mov']; 
	$u->conectar("TCC", "localhost","root","");
	if($u->cadastrar($paciente, $leito, $mov, $data_mov))
	{
		?>
		<link rel="stylesheet" href="estilo.css">
		<div id="msg-erro">Leito Alocado com Sucesso!</div>
		<?php							
	}
?>