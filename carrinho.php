<!doctype html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<html>
	<head>
		<title> Carrinho </title>
		<link rel="stylesheet" type="text/css" href="carrinho.css">
	</head>
	<body>
		<header id="topo"></header>
        <?php include("menu.php"); ?>
		<form method="post" id="compra">
			<h2>SEU CARRINHO</h2>
			<table>
				<thead style="background-color: #D3D3D3;">
					<tr id="l1">
						<th class="produtos">Produtos</th>
						<th class="qt">Quantidade</th>
						<th class="valor">Valor</th>
						<th class="vl-total">Valor Total</th>
					</tr>
				</thead>
                <?php listarCesta(); ?>
				</tfoot>
			</table>
			<button  class="btn" name="finalizar">FINALIZAR</button> 
            <button class="btn" name="limpar">LIMPAR CARRINHO</button>
            <?php 
                if(isset($_POST["limpar"])) limpar();
                // if(isset($_POST["finalizar"])) finalizar();
            ?>
		</form>
	</body>
</html>
<?php
    function retornaConexao(){
        $conexao = new mysqli("localhost","root","","pp2");
        return $conexao;
    }

    function listarCesta(){
        session_start();
        $sessionId = session_id();
        
        $conexao = new mysqli("localhost","root","","pp2");
        $sql = "select p.codigo, p.titulo, c.qtd, p.valor, p.valor*c.qtd as total from produto p inner join cesta c on p.codigo=c.codigoProduto where c.sessionId='$sessionId' order by p.titulo";
        $totalPedido = 0;
        $resultado = mysqli_query($conexao, $sql);
        while($reg = mysqli_fetch_array($resultado)){
            $titulo		=	$reg["titulo"];
            $codigo 	=	$reg["codigo"];	
            $valor		=	$reg["valor"];
            $qtd		=	$reg["qtd"];
            $total	    =	$reg["total"];
            echo"
            <tbody>
                <tr>
                    <td class='produtos'>
                        <section>
                            <aside class='foto'>
                                <img class='imagem' src='logo.jpg' alt='Card image' width='80'>
                            </aside>
                            <article class='dados-produto'>
                                <b>$titulo</b>
                            </article>
                        </section>
                    </td>
                    <td class='qt'>$qtd</td>
                    <td class='valor'>R$ $valor</td>
                    <td class='vl-total'>$total</td>
                </tr>
            </tbody>";
            $totalPedido = $totalPedido + $total;
        }
        mysqli_close($conexao);
        echo "
        <tfoot>
            <tr>
                <td class='produtos'></td>
				<td class='qt'></td>
				<td class='valor'><b>TOTAL</b></td>
				<td class='vl-total'>R$ $totalPedido</td>
            </tr>
        </tfoot>";
    }
    
    function limpar(){
        $conexao	=	retornaConexao();
        $sql		=	"delete from cesta";
        if(mysqli_query($conexao, $sql)){
            echo "<h4>Registro removido com sucesso !!</h4>";
            header("location: carrinho.php");
        }
        else {
            echo "<h4>Ocorreu um erro, tente mais tarde !!!</h4>";
        }
        mysqli_close($conexao);
    }
?>