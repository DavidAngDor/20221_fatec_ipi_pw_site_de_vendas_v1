<?php
	session_start();
	//caso queiram autenticar a pagina
	if(isset($_SESSION["codigo"])==false) header("location:login.php");
?>
<!doctype html>
<html>
    <head>
		<title> Cliente </title>
		<link rel="stylesheet" type="text/css" href="cliente.css">
	</head>
    <body>
        <header id="topo"></header>
		<?php include("menu.php"); ?>
        <section>
            <h1><?php if(isset($_SESSION["nome"])) echo "Ola, ". $_SESSION["nome"]; ?></h1>
            
            <a href="logoff.php">sair</a><br/>
            <!-- <form method="post" action="cliente.php">
                <input type="text" id="buscar" name="buscar" required>
                <button name="btnBusca">Pesquisar</button>
            </form> -->
            <!-- <a href="cadastro.php">Criar novo</A><br/> -->
            <table border="1">
                <tr>
                    <td>codigo</td>
                    <td>nome</td>
                    <td>email</td>
                    <td></td>
                </tr>
                <?php listar(); ?>
            </table>
        <section>
    </body>
</html>
<?php
    function listar(){
        $conexao = new mysqli("localhost", "root", "", "pp2");
        if(isset($_POST["btnBusca"])){
            $busca = $_POST["buscar"];
            $sql = "select * from cliente where nome like '%$busca%' or email like '%$busca%'";	
        }
        else {
            $sql = "select * from cliente order by nome";
        }
        $resultado = mysqli_query($conexao, $sql);
        while($reg = mysqli_fetch_array($resultado)){
            $codigo = $reg["codigo"];
            $nome	= $reg["nome"];
            $email  = $reg["email"];
            echo "<tr><td>$codigo</td><td>$nome</td><td>$email</td><td><a href='cliente.php?codigo=$codigo'>editar</a></tr>";	
        }
        mysqli_close($conexao);
    }
?>