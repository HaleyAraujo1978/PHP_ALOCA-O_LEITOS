<?php
	$Cod_leito = intval($_GET['Codigo']);
	$conexao = mysqli_connect("localhost","root","","tcc");
	if(!$conexao){print "Falha na conexao";}
	else{
			$sql = "DELETE FROM leitos WHERE Id_leito = '$Cod_leito'";
			$consulta = mysqli_query($conexao, $sql);
			if($consulta){
				echo "<script> location.href='menu.php?p=Consulta_Leito';</script>";
			}else{
				echo "<script> alert('Não foi possível excluir o leito');</script>";
			}
			echo "<script>location.href='menu.php?p=Consulta_Leito';</script>";
	}
?>