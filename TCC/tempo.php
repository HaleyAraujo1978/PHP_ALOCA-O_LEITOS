<?php

$cid = 'BRXX0201'; //ID Yahoo da cidade que deseja exibir o tempo

$dados = unserialize(file_get_contents("http://frameworks.hgbrasil.com/tempo/hg_tempo.php?cid=$cid")); //Recebe os valores do HG Framework

?>

<html>
<head>
<style type="text/css">
	/* HG Brasil CSS Framework */
	* {
	margin:0 0 7 0;
	padding:0;
	list-style:none;
	}
	body{
	font: normal 16px Arial;
	
	}
	#HGweather{
	background-image: url(http://frameworks.hgbrasil.com/tempo/backgroud.png);
	width: 270px;
	height: 79px;
	position: absolute; 
	top: 7px; /* Altere aqui para mudar a posição do tempo */
	left: 7px; /* Altere aqui para mudar a posição do tempo */
	background-repeat: no-repeat;
	}
	#imagem{
	position: absolute;
	top: 7px;
	left: 5px;
	}
	#cidade{
	position: absolute;
	top: 7px;
	left: 120px;
	}
	#condicao{
	position: absolute;
	top: 27px;
	left: 120px;
	}
	#temperatura{
	position: absolute;
	top: 47px;
	left: 120px;
	}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="author" content="Hugo Leonardo Demiglio - HG Brasil" />
<title>Tempo</title>
</head>
<body>

<div id="HGweather">
	<div id="imagem">
		<p><?php echo "<img src='http://frameworks.hgbrasil.com/tempo/imagens/". $dados[8] .".png' border='0' width='125px' height='90px'>"; ?></p>
	</div>
	<div id="cidade">
		<p><?php echo $dados[7]; ?></p>
	</div>
	<div id="condicao">
		<p><?php echo ucwords($dados[4]); ?></p>
	</div>
</div>
</body>
</html>