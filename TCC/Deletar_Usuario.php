<?php
	$usu_codigo = intval($_GET['Codigo']);
	$conexao = mysqli_connect("localhost","root","","tcc");
	if(!$conexao){print "Falha na conexao";}
	else{
			$sql = "DELETE FROM usuarios WHERE Id_usuario = '$usu_codigo'";
			$consulta = mysqli_query($conexao, $sql);
			if($consulta){
				echo "<script> location.href='menu.php?p=Consulta_Usuario';</script>";
			}else{
				echo "<script> alert('Não foi possível excluir o usuário ');</script>";
			}
			echo "<script>location.href='menu.php?p=Consulta_Usuario';</script>";
	}
?>