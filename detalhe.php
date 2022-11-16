<!doctype html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<html>
	<head>
		<title> Detalhe </title>
		<link rel="stylesheet" type="text/css" href="detalhe.css">
	</head>
	<body>
		<header id="topo"></header>
		<?php include("menu.php"); ?>
		
		<?php
			if(isset($_GET["codigo"])){
				$codigo = $_GET["codigo"];
				session_start();
				$sessionId = session_id();
				$conexao = new mysqli("localhost","root","","pp2");
				
				$sql = "select * from produto where codigo='$codigo'";
				$resultado = mysqli_query($conexao, $sql);
				if($reg = mysqli_fetch_array($resultado)){
					$codigo = $reg["codigo"];
					$titulo = $reg["titulo"];
					$descritivo = $reg["descritivo"];
					echo "
					<section id='produto'>
						</br></br>
						<aside id='foto'>
							<img src='./img/$codigo.jpg' width='256' />
						</aside>
						<article id='dados-produto'>
							<h1>$titulo</h1>
							$descritivo
						</article>
					</section>
					<footer>
						<a href='adicionar.php?codigo=$codigo'><button href='adicionar.php?codigo=$codigo' id='comprar'>COMPRAR</button></a>
					</footer>
					";
				}
				mysqli_query($conexao, $sql);
				mysqli_close($conexao);
			}
			else {
				echo "<h4>Codigo invalido!!</h4>";	
			}
		?>
	</body>
</html>