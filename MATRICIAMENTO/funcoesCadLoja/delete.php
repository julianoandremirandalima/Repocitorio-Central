<?php

include('db.php');
include("funcoes.php");

if(isset($_POST["usuario_id"]))
{
	
	$imagem = get_imagem_nome($_POST["usuario_id"]);
	
	if($imagem != '')
	{
		unlink("upload/" . $imagem);
	}
	
	$statement = $con->prepare(
		"DELETE FROM lojas WHERE idLogista = :id"
	);
	$resultado = $statement->execute(
		array(
			':id'	=>	$_POST["usuario_id"]
		)
	);
	
	if(!empty($resultado))
	{
		echo 'Usuario Deletado';
	}
}



?>