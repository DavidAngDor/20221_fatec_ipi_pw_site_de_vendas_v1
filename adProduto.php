<!doctype html>
<html>
	<body>
	<h1>Produto</h1>
	<a href="listaProduto.php">Voltar para a lista</a>
	<br/><br/>
	<form method="post" ><!-- action="detalhe.php" -->
        codigo:<input type="number" name="codigo" id="codigo" /><br/>
        titulo:<input type="text" name="titulo" id="titulo" /><br/>
        descritivo:<textarea id="descritivo" name="descritivo" rows="5" cols="30"></textarea><br/>
        valor:<input type="number" id="valor" name="valor" step="0.01" /><br/>
        qtd:<input type="number" id="qtd" name="qtd" /><br/>
        categoria:<select id="categoria" name="categoria">
            <option>Romance</option>
            <option>HQs</option>
            <option>Mangas</option>
            <option>Fantasia</option>
            <option>Infantil</option>
            <option>Cultura Pop</option>
            <option>Historia</option>
            <option>Ciencias</option>
            <option>Computação e Informática</option>
            <option>Direito</option>
        </select><br/><br/><br/>
        <button name="b1">Inserir</button>
        <button name="b2">Pesquisar</button>
        <button name="b3">alterar</button>
        <button name="b4">remover</button>
	</form>
	<?php
		if(isset($_POST["b1"])) inserir();
		if(isset($_POST["b2"])) pesquisar($_POST["codigo"]);
		if(isset($_POST["b3"])) alterar();
		if(isset($_POST["b4"])) remover();
		if(isset($_GET["codigo"])) pesquisar($_GET["codigo"]);
	?>	
</body>
</html>
<?php
    function retornaConexao(){
        $conexao = new mysqli("localhost","root","","pp2");
        return $conexao;
    }

    function inserir(){
        $titulo		=	$_POST["titulo"];
        $descritivo =	$_POST["descritivo"];	
        $valor		=	$_POST["valor"];
        $qtd		=	$_POST["qtd"];
        $categoria	=	$_POST["categoria"];
        $conexao	=	retornaConexao();
        $sql		=	"insert into produto(titulo, descritivo, valor, qtd, categoria) values('$titulo', '$descritivo', '$valor', '$qtd', '$categoria')";
        if(mysqli_query($conexao, $sql)){
            echo "<h4>Registro inserido com sucesso !!</h4>";
        } else {
            echo "<h4>Ocorreu um erro, tente mais tarde !!!</h4>";
        }
        mysqli_close($conexao);
    }

    function pesquisar($codigo){
        $conexao   = retornaConexao();
        $sql	   = "select * from produto where codigo='$codigo'";
        $resultado = mysqli_query($conexao, $sql);
        if($reg = mysqli_fetch_array($resultado)){
            $titulo		=	$reg["titulo"];
            $descritivo =	$reg["descritivo"];	
            $valor		=	$reg["valor"];
            $qtd		=	$reg["qtd"];
            $categoria	=	$reg["categoria"];
            echo "<script lang='javascript'>";
            echo "codigo.value='$codigo';";
            echo "titulo.value='$titulo';";
            echo "descritivo.value='$descritivo';";
            echo "valor.value='$valor';";
            echo "qtd.value='$qtd';";
            echo "categoria.value='$categoria';";
            echo "</script>";
        } else {
            echo "<h4>Registro não encontrado !!</h4>";	
        }
        mysqli_close($conexao);
    }

    function alterar(){
        $codigo		=	$_POST["codigo"];
        $titulo		=	$_POST["titulo"];
        $descritivo =	$_POST["descritivo"];	
        $valor		=	$_POST["valor"];
        $qtd		=	$_POST["qtd"];
        $categoria	=	$_POST["categoria"];
        $conexao	=	retornaConexao();
        $sql		=	"update produto set titulo='$titulo', descritivo='$descritivo', valor='$valor', qtd='$qtd', categoria='$categoria' where codigo='$codigo'";
        if(mysqli_query($conexao, $sql)){
            echo "<h4>Registro alterado com sucesso !!</h4>";
        } else {
            echo "<h4>Ocorreu um erro, tente mais tarde !!!</h4>";
        }
        mysqli_close($conexao);
    }

    function remover(){
        $codigo		=	$_POST["codigo"];
        $conexao	=	retornaConexao();
        $sql		=	"delete from produto where codigo='$codigo'";
        if(mysqli_query($conexao, $sql)){
            echo "<h4>Registro removido com sucesso !!</h4>";
        } else {
            echo "<h4>Ocorreu um erro, tente mais tarde !!!</h4>";
        }
        mysqli_close($conexao);
    }
?>		
	