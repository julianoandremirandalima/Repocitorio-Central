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
			INSERT INTO colaboradores (
			matricula,
			nome,
			data_nascimento,
			estado_civil,
			sexo,
			escolaridade,
			rg,
			cpf,
			endereco,
			numero,
			bairro,
			cep,
			cidade,
			funcao,
			setor,
			tipo,
			data1,
			data2,
			telefone,
			celular,
			wattsap,
			email,
			limite,
			local,

				imagem) 
			VALUES (
				:matricula,
				:nome,
				:data_nascimento,
				:estado_civil,
				:sexo,
				:escolaridade,
				:rg,
				:cpf,
				:enderecox,
				:numerox,
				:bairrox,
				:cepx,
				:cidade,
				:funcao,
				:setor,
				:tipo,
				:data1,
				:data2,
				:telefone,
				:celular,
				:wattsap,
				:email,
				:limite,
				:local,
				:imagem)
		");
		
		$resultado = $statement->execute(
			array(

			':matricula' => $_POST["matricula"],
			':nome' => $_POST["nome"],
			':data_nascimento' => $_POST["data_nascimento"],
			':estado_civil' => $_POST["estado_civil"],
			':sexo' => $_POST["sexo"],
			':escolaridade' => $_POST["escolaridade"],
			':rg' => $_POST["rg"],
			':cpf' => $_POST["cpf"],
			':enderecox' => $_POST["endereco"],
			':numerox' => $_POST["numero"],
			':bairrox' => $_POST["bairro"],
			':cepx' => $_POST["cep"],
			':cidade' => $_POST["cidade"],
			':funcao' => $_POST["funcao"],
			':setor' => $_POST["setor"],
			':tipo' => $_POST["tipo"],
			':data1' => $_POST["data1"],
			':data2' => $_POST["data2"],
			':telefone' => $_POST["telefone"],
			':celular' => $_POST["celular"],
			':wattsap' => $_POST["wattsap"],
			':email' => $_POST["email"],
			':limite' => $_POST["novolimite"],
			':local' => $_POST["local"],


				':imagem'		=>	$imagem
				
				
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

		$limite = $_POST["limite"];
		$novolimite = $_POST["novolimite"];
		if($novolimite=="")
		{
			$novolimite = $limite;
		}

		$statement = $con->prepare("UPDATE colaboradores 
			SET	matricula = :matricula,
			nome = :nome,
			data_nascimento = :data_nascimento,
			estado_civil = :estado_civil,
			sexo = :sexo,
			escolaridade = :escolaridade,
			rg = :rg,
			cpf = :cpf,
			endereco = :enderecox,
			numero = :numerox,
			bairro = :bairrox,
			cep = :cepx,
			cidade = :cidade,
			funcao = :funcao,
			setor = :setor,
			tipo = :tipo,
			data1 = :data1,
			data2 = :data2,
			telefone = :telefone,
			celular = :celular,
			wattsap = :wattsap,
			email = :email,
			limite = :limite,
			local = :local, 

			imagem = :imagem  
			WHERE id = :id
			"
		);
		$resultado = $statement->execute(
			array(
				':matricula' => $_POST["matricula"],
			':nome' => $_POST["nome"],
			':data_nascimento' => $_POST["data_nascimento"],
			':estado_civil' => $_POST["estado_civil"],
			':sexo' => $_POST["sexo"],
			':escolaridade' => $_POST["escolaridade"],
			':rg' => $_POST["rg"],
			':cpf' => $_POST["cpf"],
			':enderecox' => $_POST["endereco"],
			':numerox' => $_POST["numero"],
			':bairrox' => $_POST["bairro"],
			':cepx' => $_POST["cep"],
			':cidade' => $_POST["cidade"],
			':funcao' => $_POST["funcao"],
			':setor' => $_POST["setor"],
			':tipo' => $_POST["tipo"],
			':data1' => $_POST["data1"],
			':data2' => $_POST["data2"],
			':telefone' => $_POST["telefone"],
			':celular' => $_POST["celular"],
			':wattsap' => $_POST["wattsap"],
			':email' => $_POST["email"],
			':limite' => $novolimite,
			':local' => $_POST["local"],
			':imagem'		=>	$imagem,
				
				':id' => $_POST["usuario_id"]
			)
		);
		if(!empty($resultado))
		{
			echo 'Usuario alterado com sucesso !';
			
			$idusuariolimite = $_POST["usuario_id"];
			$datahj = date("Y-m-d H:i:s");
			$matriculabd = $_POST["matricula"];
			$nomebd = $_POST["nome"];
			
			$usuariologadox = $_POST["usuariologado"];
			$idusuariologadox = $_POST["idusuariologado"];
			$loglimite = $con->prepare("INSERT INTO alteracaolimite (
				data_alteracao, para_quem_matricula, para_quem_nome, para_quem_id, quem_fez_id, quem_fez_nome, novovalor, limiteantigo)
				VALUES
				('$datahj', '$matriculabd', '$nomebd', '$idusuariolimite', '$idusuariologadox', '$usuariologadox', '$novolimite', '$limite')
				");
			$loglimite->execute();

			//ENVIAR E-MAIL-------------------------------------------
					
			ini_set( 'display_errors', 1 );
			error_reporting( E_ALL );
			$from = "administrador@sindserva.esferasistemadigital.com.br";
			$to = "alteracaolimite@sindserva.esferasistemadigital.com.br,controlesindserva@gmail.com";
			$subject = "ALTERAÇÃO DE LIMITE PELO OPERADOR";
			$message = "LIMITE ALTERADO DE $limite PARA $novolimite PARA O SERVIDOR $nomebd - $matriculabd, FEITA PELO OPERADOR $usuariologadox NA DATA DE $datahj";
			$headers = "From:" . $from;
			mail($to,$subject,$message, $headers);
			//echo "The email message was sent.";

			
		}
	}
}

?>