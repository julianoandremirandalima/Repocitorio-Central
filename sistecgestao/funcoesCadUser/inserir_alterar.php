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
			INSERT INTO usuarios (nome, imagem, usuario, senha) 
			VALUES (:nome, :imagem, :usuario, :senha)
		");
		
		$resultado = $statement->execute(
			array(
				':nome'	=>	$_POST["nome"],
				':imagem'		=>	$imagem,
				':usuario'	=>	$_POST["usuario"],
				':senha'	=>	md5("123456")
				
			)
		);
		if(!empty($resultado))
		{
			echo 'Usuario inserido com sucesso !';
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
			SET nome = :nome, usuario = :usuario, senha = :senha, imagem = :imagem  
			WHERE id = :id
			"
		);
		$resultado = $statement->execute(
			array(
				':nome'	=>	$_POST["nome"],
				':usuario'	=>	$_POST["usuario"],
				':imagem'		=>	$imagem,
				':senha'		=>	md5($_POST["senha"]),
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