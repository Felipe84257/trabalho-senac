<?php
include ('inc/incCabecalho.php');
?>
<?php



function sanitize($v) {
	$v = trim($v); 
	$v = stripslashes($v); 
	$v = htmlspecialchars($v); 
	return $v;
}


$nome = '';
$email = '';
$assunto = '';
$mensagem = '';


$erro = '';


$sucesso = false;


if (strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {

	
	$nome = sanitize($_POST['nome']);
	$email = sanitize($_POST['email']);
	$assunto = sanitize($_POST['assunto']);
	$mensagem = sanitize($_POST['mensagem']);

	
	if (strlen($nome) < 3) {
		$erro .= "<li>O nome deve ter pelo menos 3 caracteres.</li>";
	} else {
		
		if (!preg_match("/^[a-zA-ZÀ-ÿ ]*$/", $nome)) {
			$erro .= "<li>Seu nome deve conter apenas letras e espaços.</li>"; 
		}
	}

	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$erro .= "<li>Seu e-mail não é válido.</li>"; 
	}

	
	$contaAssunto = strlen($assunto);
	if ($contaAssunto == 0) {
		$erro .= "<li>Escreva um assunto para o contato.</li>";
	} elseif ($contaAssunto < 3) {
		$erro .= "<li>O assunto está muito curto.</li>";
	}

	
	$contaMensagem = strlen($mensagem);
	if ($contaMensagem == 0) {
		$erro .= "<li>Escreva uma mensagem para o contato.</li>";
	} elseif ($contaMensagem < 5) {
		$erro .= "<li>A mensagem está muito curta.</li>";
	}

	
	if ($erro == '') {

		

		
		$mailDestinatario = "email1@servidor.com, email2@servidor.com";

	
		$mailAssunto = "Formulário de Contatos de 'MeuSite'";

		
		$mailMensagem = "
		<!DOCTYPE html>
		<html lang=\"pt-br\">
		<head><title>Formulário de Contatos de 'MeuSite'</title></head>
		<body>
		<p><i>Olá!</i></p>
		<p>O formulário de contatos de 'MeuSite' foi enviado:</p>
		<ul>
		<li><b>Nome:</b> {$nome}</li>
		<li><b>E-mail:</b> {$email}</li>
		<li><b>Assunto:</b> {$assunto}</li>
		</ul>
		<hr><pre>{$mensagem}</pre><hr>
		</body></html>
		";

		

		
		$mailHeader = "MIME-Version: 1.0" . "\r\n";
		$mailHeader .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		
		$mailHeader .= 'From: <root@localhost>' . "\r\n";

		
		@mail($mailDestinatario, $mailAssunto, $mailMensagem, $mailHeader);

	

		
		require('conn.php');

		
		$sql = "INSERT INTO `contatos` (`id`, `nome`, `email`, `assunto`, `mensagem`, `data`, `status`) VALUES (NULL, '{$nome}', '{$email}', '{$assunto}', '{$mensagem}', NOW(), '1');";

		
		if (mysqli_query($conn, $sql)) {

			
			$sucesso = true;

			
			$nome = '';
			$email = '';
			$assunto = '';
			$mensagem = '';

		} else {

			
			$erro = "<li>Ocorreu erro ao gravar sua mensagem no banco de dados.</li>";

		}

	}

}

?>

<form name="contatos" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">

<?php

if($erro != '') {
	echo "<div class=\"erro\">";
	echo "<h3>Ooops!</h3>";
	echo "<p>Ocorreram erros que impedem o envio da mensagem:</p>";
	echo "<ul>{$erro}</ul>";
	echo "<p>Por favor, corrija os erros e tente novamente.</p>";
	echo "</div>";
}


if($sucesso) {
	echo "<div class=\"sucesso\">";
	echo "<h3>Obrigado!</h3>";
	echo "<p>Seu contato foi enviado com sucesso...</p>";
	echo "</div>";	
}
?>

<h2 style="color: blue; font-size: 29px;">Fale Conosco</h2>
<p style="; font-size: 21px;"><b><i>Preencha corretamente o formulário abaixo.<b></i></p>

<p>
	<label style="color: green; font-size: 20px;" for="nome"> Nome:</label>
	<input type="text" name="nome" id="nome" placeholder="Seu nome completo" value="<?php echo $nome ?>">
</p>
<p>
	<label style="color: green; font-size: 20px;" for="email">E-mail:</label>
	<input type="text" name="email" id="email" placeholder="Seu e-mail válido" value="<?php echo $email ?>">
</p>
<p>
	<label style="color: green; font-size: 20px;" for="assunto">Assunto:</label>
	<input type="text" name="assunto" id="assunto" placeholder="Assunto da mensagem" value="<?php echo $assunto ?>">
</p>
<p>
	<label style="color: green; font-size: 20px;" for="mensagem">Mensagem:</label>
	<textarea name="mensagem" id="mensagem" placeholder="Sua mensagem"><?php echo $mensagem ?></textarea>
</p>
<p>
	<label></label>
	<button type="submit">Enviar</button>
	<small style="color: red; font-size: 20px;"> ← Clique aqui para enviar.</small>
</p>

</form>
<link rel="stylesheet" href="web/contato.css">