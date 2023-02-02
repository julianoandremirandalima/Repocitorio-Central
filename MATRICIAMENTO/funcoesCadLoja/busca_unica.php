<?php
include('db.php');
include('funcoes.php');
if(isset($_POST["usuario_id"]))
{
	$saida = array();
	
	$statement = $con->prepare(
		"SELECT * FROM lojas 
		WHERE idLogista = '".$_POST["usuario_id"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultado = $statement->fetchAll();
	
	foreach($resultado as $linha)
	{
		//DADOS PARA CAMPOS DA MODAL
		$saida["usuarioLogista"] = $linha["usuarioLogista"];
		$saida["nomeLogista"] = $linha["nomeLogista"];
		$saida["razaosocialLogista"] = $linha["razaosocialLogista"];
		$saida["cnpjLogista"] = $linha["cnpjLogista"];
		$saida["enderecoLogista"] = $linha["enderecoLogista"];
		$saida["telefoneLogista"] = $linha["telefoneLogista"];
		$saida["emailLogista"] = $linha["emailLogista"];
		$saida["statusLogista"] = $linha["statusLogista"];
		$saida["descontologista"] = $linha["descontologista"];
		$saida["responsavelLogista"] = $linha["responsavelLogista"];
		$saida["cpfresponsavelLogista"] = $linha["cpfresponsavelLogista"];
		$saida["conveniada"] = $linha["conveniada"];
		$saida["dataLogista"] = $linha["dataLogista"];
		if($linha["imagem"] != '')
		{
			$saida['imagem_usuario'] = '<img src="upload/'.$linha["imagem"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_usuario_imagem" value="'.$linha["imagem"].'" />';
		}
		else
		{
			$saida['imagem_usuario'] = '<input type="hidden" name="hidden_usuario_imagem" value="" />';
		}
	}
	echo json_encode($saida);
}
?>