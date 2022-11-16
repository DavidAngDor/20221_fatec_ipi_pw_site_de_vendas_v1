<!doctype html>
<html>
	<body>
		<h1>Lista de produtos</h1>
		<form method="post" action="listaProduto.php">
			<input type="text" id="busca" name="busca"  required />
			<button name="btnBusca">Pesquisar</button>
		</form>
		<a href="adProduto.php">Inserir um novo</a><br/><br/>
		<table border="1">
		<tr><td><b>Codigo</b></td><td><b>titulo</b></td><td><b>valor</b></td><td><b>Qtd</b></td><td><b>Categoria</b></td>
		<td></td></tr>
		<?php listar(); ?>
		</table>
	</body>
</html>
<?php
function listar(){
	$conexao = new mysqli("localhost","root","","pp2");
	if(isset($_POST["btnBusca"])){
		$busca	= $_POST["busca"];
		$sql = "select * from produto where titulo like '%$busca%' order by titulo";
	} else {
		$sql = "select * from produto order by titulo";
	}
	$resultado = mysqli_query($conexao, $sql);
	while($reg = mysqli_fetch_array($resultado)){
		$titulo		=	$reg["titulo"];
		$codigo 	=	$reg["codigo"];	
		$valor		=	$reg["valor"];
		$qtd		=	$reg["qtd"];
		$categoria	=	$reg["categoria"];
		echo"<tr><td>$codigo</td><td>$titulo</td><td>R$ $valor</td><td>$qtd</td><td>$categoria</td>
		<td><a href='adProduto.php?codigo=$codigo'>editar</a></td></tr>";
	}
	mysqli_close($conexao);
}
?>
