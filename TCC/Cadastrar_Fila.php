<?php
	require_once 'Classes\fila.php';
	$u = new fila;
	$setor = $_GET['setor'];
	$paciente = $_GET['paciente'];
	$entrada = $_GET['entrada']; 
	$u->conectar("TCC", "localhost","root","");
	if($u->cadastrar($setor, $paciente, $entrada))
	{
		?>
		<link rel="stylesheet" href="estilo.css">
		<div id="msg-erro">Paciente Inserido na Fila!</div>
		<?php							
	}
?>