<?php
	session_start();
	//caso queiram autenticar a pagina
	if(isset($_SESSION["codigo"])==true) header("location: cliente.php");
?>


<!doctype html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<html>
	<head>
		<title> Login </title>
		<link rel="stylesheet" type="text/css" href="login.css">
	</head>
	<body>
		<section id="corpo">
			<form class="box" method="post" action="login.php">
				<img src="login.png" width="96" height="96" /></br>
				<input type="email" id="email" name="email" size="47" placeholder="Endereço de e-mail" required /></br>
				<input type="password" id="senha" name="senha" size="47" placeholder="Senha" required /></br>
				<a href="esqueci.php" id="esqueci">Esqueceu sua senha?</a></br>
				<button name="logar">ENTRAR</button></br>
				<a href="cadastro.php" id="sem-cadastro">Não tenho cadastro</a>
			    <?php if(isset($_POST["logar"])) Login(); ?>
            </form>
		</section>
	</body>
</html>
<?php
    function Login(){
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $conexao=	new mysqli("localhost", "root", "", "pp2");
        $sql = "select * from cliente where email='$email' and senha = md5('$senha')";
        $resultado = mysqli_query($conexao, $sql);
        if($reg = mysqli_fetch_array($resultado)){
            session_start();
            $_SESSION["codigo"] = $reg["codigo"];
            $_SESSION["nome"] = $reg["nome"];
            $_SESSION["email"] = $reg["email"];
            header("location: cliente.php");
        } else {
            echo "<h4>email ou senha invalidos !!!</h4>";	
        }
        mysqli_close($conexao);
    }
?>