<!doctype html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<html>
	<head>
		<title> Vitrine </title>
		<link rel="stylesheet" type="text/css" href="vitrine.css">
	</head>
	<body>
		<header id="topo"></header>
        <?php include("menu.php"); ?>
		<section id="catalogo">
			<?php listar(); ?>
		</section>
	</body>
</html>
<?php
    function listar(){
        $conexao = new mysqli("localhost","root","","pp2");
        if(isset($_POST["btnBusca"])){
            $busca	= $_POST["search"];
            $sql = "select * from produto where titulo like '%$busca%' order by titulo";
        }
        else {
            $sql = "select * from produto order by titulo";
        }
        $resultado = mysqli_query($conexao, $sql);
        while($reg = mysqli_fetch_array($resultado)){
            $titulo		=	$reg["titulo"];
            $codigo 	=	$reg["codigo"];	
            $valor		=	$reg["valor"];
            $qtd		=	$reg["qtd"];
            $descritivo =	$reg["descritivo"];
            $categoria	=	$reg["categoria"];
            echo"
                <div class='prod'>
                    <a href='detalhe.php?codigo=$codigo' method='post' name='detalhe'>
                        <img class='imagem' src='./img/$codigo.jpg' alt='Card image'>
                    </a>
                    <div class='card-body'>
                        <h4 class='valor'>R$ $valor</h4>
                        <a href='detalhe.php?codigo=$codigo' method='post' name='detalhe' class='titulo'>$titulo</a></br></br>
                        <a href='adicionar.php?codigo=$codigo'>
                            <button class='comprar'>COMPRAR</button>
                        </a>
                    </div>
                </div>
            ";
        }
        mysqli_close($conexao);
    }
?>