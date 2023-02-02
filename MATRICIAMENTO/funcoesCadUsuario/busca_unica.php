<?php
include('db.php');
include('funcoes.php');
if(isset($_POST["usuario_id"]))
{
	$saida = array();
	
	$statement = $con->prepare(
		"SELECT * FROM colaboradores 
		WHERE id = '".$_POST["usuario_id"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultado = $statement->fetchAll();
	
	foreach($resultado as $linha)
	{
		
		//DADOS PARA CAMPOS DA MODAL
		$saida["matricula"] = $linha["matricula"];
		$saida["nome"] = $linha["nome"];
		$saida["data_nascimento"] = $linha["data_nascimento"];
		$saida["estado_civil"] = $linha["estado_civil"];
		$saida["sexo"] = $linha["sexo"];
		$saida["escolaridade"] = $linha["escolaridade"];
		$saida["rg"] = $linha["rg"];
		$saida["cpf"] = $linha["cpf"];
		$saida["enderecox"] = $linha["endereco"];
		$saida["numerox"] = $linha["numero"];
		$saida["bairrox"] = $linha["bairro"];
		$saida["cepx"] = $linha["cep"];
		$saida["cidade"] = $linha["cidade"];
		$saida["funcao"] = $linha["funcao"];
		$saida["setor"] = $linha["setor"];
		$saida["tipo"] = $linha["tipo"];
		$saida["data1"] = $linha["data1"];
		$saida["data2"] = $linha["data2"];
		$saida["telefone"] = $linha["telefone"];
		$saida["celular"] = $linha["celular"];
		$saida["wattsap"] = $linha["wattsap"];
		$saida["email"] = $linha["email"];
		$saida["limite"] = $linha["limite"];
		$saida["local"] = $linha["local"];
		
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