<!doctype html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<html>
	<head>
		<title> Cadastro </title>
		<link rel="stylesheet" type="text/css" href="cadastro.css">
		<!-- <script language="javascript" src="jquery-3.6.0.min.js"></script> -->
	</head>
	<body>
		<header id="topo"></header>
		<?php include("menu.php"); ?>
		<section>
			<form method="post" id="corpo">
				<h1> CADASTRE-SE</h1>
				<input type="text" id="nome" name="nome" size="55" maxlength="50" placeholder="Nome" />
				<input type="text" id="cpf" name="cpf" size="55" placeholder="CPF" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF no formato: xxx.xxx.xxx-xx" />
				<input type="text" id="telefone" name="telefone" size="55" maxlength="50" placeholder="Telefone" pattern="[0-9]{2} [0-9]{4, 5}-[0-9]{4}" title="Digite o telefone no formato: DDD 0000-0000" />
				<input type="email" id="email" name="email" size="55" maxlength="50" placeholder="Endereço de e-mail"  />
				<input type="password" id="senha" name="senha" size="55" placeholder="Senha" />
				<input type="password" id="senha2" name="senha2" size="55" placeholder="Confirme a senha"  />
				<button class="button" id="enviar" name="enviar" onclick="validar();">CADASTRAR</button>
			</form>
            <?php
                if(isset($_POST["enviar"])) inserir();
            ?>
		</section>
	</body>
</html>
<script lang="javascript">
    function validar(){
        if(nome.value.length <= 3){
            nome.focus();
            return false;
        }
		if(cpf.value.length <= 9){
            nome.focus();
            return false;
        }
		if(telefone.value.length <= 8){
            nome.focus();
            return false;
        }
        if(senha.value.lenght <6 || !isNaN(senha.value)){
            senha.focus();
            return false;
        }
        if(senha2.value != senha.value){
            senha2.value="";
            senha2.focus();
            return false;
        }
        if(email.value.length <6 || email.value.indexOf("@") <=0 || email.value.lastIndexOf(".") <= email.value.indexOf("@")){
            email.focus();
            return false;        
        }
        corpo.submit();
    }
</script>
<?php
    function inserir(){
        $nome	    =	$_POST["nome"];
        $cpf        =   $_POST["cpf"];
        $telefone   =   $_POST["telefone"];
        $email	    =	$_POST["email"];
        $senha	    =	$_POST["senha"];
        $senha2	    =	$_POST["senha2"];
        if($senha2 != $senha){
            echo"<h4>Digite a mesma senha</h4>";
			return;
        }
        $conexao    =	new mysqli("localhost", "root", "", "pp2");
        $sql	    =	"insert into cliente(nome, cpf, telefone, email, senha) values('$nome', '$cpf', '$telefone', '$email', md5('$senha'))";	
        mysqli_query($conexao, $sql);
        mysqli_close($conexao);
    }
?>