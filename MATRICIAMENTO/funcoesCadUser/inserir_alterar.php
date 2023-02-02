<?php
include('db.php');
include('funcoes.php');
if(isset($_POST["operacao"]))
{
	if($_POST["operacao"] == "Add")
	{
		$imagem = '';
		if($_FILES["imagem_usuario"]["name"] != '')
		{
			$imagem = upload_imagem();
		}
		
		$statement = $con->prepare("
			INSERT INTO usuarios (nome, imagem, usuario, senha, tipo_user) 
			VALUES (:nome, :imagem, :usuario, :senha, :tipo)
		");
		
		$resultado = $statement->execute(
			array(
				':nome'	=>	$_POST["nome"],
				':imagem'		=>	$imagem,
				':usuario'	=>	$_POST["usuario"],
				':senha'	=>	md5("123456"),
				':tipo'	=>	$_POST["tipo"]
				
			)
		);
		if(!empty($resultado))
		{
			echo 'Usuario inserido com sucesso !';
			$usuario = $_POST["usuario"];
			// Dados de Envio
		$email_enviar = "SISTEC - MATRICIAMENTO <$usuario>";
		$assunto = "SISTEC MATRICIAMENTO - USUÁRIO INSERIDO NO SISTEMA";
		
		// Cabeçalho do Email
		$cabecalho = 'MIME-Version: 1.0' . "\r\n";
		$cabecalho .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";
		$cabecalho .= "Return-Path: $email_enviar \r\n";
		$cabecalho .= "From: $email_enviar \r\n";
		$cabecalho .= "Reply-To: $email_enviar \r\n";
		
		// Corpo do Email
		
		$mensagem = '<img src="https://semus.varginha.mg.gov.br/idSISteclaranja.png" width="213" height="77" /> <img src="https://semus.varginha.mg.gov.br/logoAPS.png" width="297" height="92" /><br><br>';
		$mensagem .= "Bem vindo ao nosso sistema de Matriciamento!<br>Segue abaixo os dados de acesso ao sistema.<br>";
		$mensagem .= "ACESSO: https://semus.varginha.mg.gov.br/matriciamento<br />Usuario: $usuario<br>Senha: 123456<br>";
		$mensagem .= "<br /> <b>TECNOLOGIA DA INFORMAÇÃO SEMUS</br>";
		
		mail($email_enviar, $assunto, $mensagem, $cabecalho);
		
		}
	}
	if($_POST["operacao"] == "Edit")
	{
		
		$imagem = '';

		if($_FILES["imagem_usuario"]["name"] != '')
		{
			$imagem = upload_imagem();
		}
		else
		{
			$imagem = $_POST["hidden_usuario_imagem"];
		}
		$statement = $con->prepare(
			"UPDATE usuarios 
			SET nome = :nome, usuario = :usuario, tipo_user = :tipo, imagem = :imagem  
			WHERE id = :id
			"
		);
		$resultado = $statement->execute(
			array(
				':nome'	=>	$_POST["nome"],
				':usuario'	=>	$_POST["usuario"],
				':imagem'		=>	$imagem,
				':tipo'	=>	$_POST["tipo"],
				':id'			=>	$_POST["usuario_id"]
				
			)
		);
		if(!empty($resultado))
		{
			echo 'Usuario alterado com sucesso !';
		}
	}
}

?>