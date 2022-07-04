<?php
	$cod_paciente = intval($_GET['Codigo']);
	$conexao = mysqli_connect("localhost","root","","tcc");
	if(!$conexao){print "Falha na conexao";}
	else{
			$sql = "DELETE FROM pacientes WHERE Id_paciente = '$cod_paciente'";
			$consulta = mysqli_query($conexao, $sql);
			if($consulta){
				echo "<script> location.href='menu.php?p=Consulta_Paciente';</script>";
			}else{
				echo "<script> alert('Não foi possível excluir o Paciente');</script>";
			}
			echo "<script> location.href='menu.php?p=Consulta_Paciente';</script>";
	}
?>