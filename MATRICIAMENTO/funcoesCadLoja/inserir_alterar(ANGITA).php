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
			INSERT INTO lojas (nomeLogista, usuarioLogista, cnpjLogista, enderecoLogista, telefoneLogista, emailLogista, statusLogista, razaosocialLogista, imagem, descontologista, responsavelLogista, cpfresponsavelLogista, dataLogista) 
			VALUES (:nome, :usuario, :cnpj, :endereco, :telefone, :email, :status, :razao, :imagem, :desconto, :responsavelLogista, :cpfresponsavelLogista, :dataLogista)
		");
		
		$resultado = $statement->execute(
			array(
				':nome'	=>	$_POST["nomeLogista"],
				':usuario'	=>	$_POST["usuarioLogista"],
				':cnpj'	=>	$_POST["cnpjLogista"],
				':endereco'	=>	$_POST["enderecoLogista"],
				':telefone'	=>	$_POST["telefoneLogista"],
				':email'	=>	$_POST["emailLogista"],
				':status'	=>	$_POST["statusLogista"],
				':razao'	=>	$_POST["razaosocialLogista"],
				':imagem'		=>	$imagem,
				':desconto' => $_REQUEST["descontologista"],
				':responsavelLogista' => $_REQUEST["responsavelLogista"],
				':cpfresponsavelLogista' => $_REQUEST["cpfresponsavelLogista"],
				':dataLogista' => date("Y-m-d H:i:s")
				
				
			)
		);
		if(!empty($resultado))
		{
			echo 'Usuario inserido com sucesso !';
			ini_set( 'display_errors', 1 );
			error_reporting( E_ALL );
			$usuario = $_POST["usuarioLogista"];
			$email = $_POST["emailLogista"];
			$nome = $_POST["nomeLogista"];
			$from = "SINDSERVA - SINDICATO DOS SERVIDORES PÚBLICOS MUNICIPAIS DE VARGINHA <contato@sindservasistema.com.br>";
			$to = $email;

			/*$conteudo = "<html><head><title>" . $assunto . "</title></head>";
			$conteudo .= "<body>";
			$conteudo  = "<font face=\"Arial\" size=\"2\">Email automático!</font><hr>";
			$conteudo .= "<img src=\"https://sindservasistema.com.br/logohorizontal.png\">";
			$conteudo .= "</body></html>";
			*/
			$headers = "From:" . $from;
			//$headers .= "MIME-Version: 1.0 \r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1;';
            
			//$imagem_nome = "https://sindservasistema.com.br/logohorizontal.png";

			$subject = "CONTRATO E ACESSO AO SISTEMA SINDSERVA";
			$message = "Abaixo segue o link, usuário e senha para acessar nosso sistema.<br>";
			//$message .= "Content-type: image/png; name=\"$imagem_nome\"\r\n";
			
			mail($to,$subject,$message, $headers);

			ini_set( 'display_errors', 1 );
			error_reporting( E_ALL );
			$from = " SINDSERVA - SINDICATO DOS SERVIDORES PÚBLICOS MUNICIPAIS DE VARGINHA <contato@sindservasistema.com.br>";
				  $to = " $nome<$email>";
				  $subject = "CONTRATO E ACESSO AO SISTEMA SINDSERVA";
				  $message = "Abaixo segue o link, usuário e senha para acessar nosso sistema \n";
				  $message .= "Acesse o link https://sindservasistema.com.br\n Usuário: $usuario \n Senha: 123456 \n Clique em CONTRATO e tenha acesso ao contrato de parceria com o SindServa.\n Qualquer dúvida entre em contato! \n (35) 3690-2034";
		
				  $headers = "From:" . $from;
				  mail($to,$subject,$message, $headers);

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
			"UPDATE lojas 
			SET nomeLogista = :nome, 
			usuarioLogista = :usuario, 
			cnpjLogista = :cnpj,
			enderecoLogista = :endereco,
			telefoneLogista = :telefone,
			emailLogista = :email,
			statusLogista = :status,
			razaosocialLogista = :razao, 
			imagem = :imagem,
			descontologista = :desconto,
			responsavelLogista = :responsavelLogista,
			cpfresponsavelLogista = :cpfresponsavelLogista 
			WHERE idLogista = :id
			"
		);
		$resultado = $statement->execute(
			array(
				':nome'	=>	$_POST["nomeLogista"],
				':usuario'	=>	$_POST["usuarioLogista"],
				':cnpj'	=>	$_POST["cnpjLogista"],
				':endereco'	=>	$_POST["enderecoLogista"],
				':telefone'	=>	$_POST["telefoneLogista"],
				':email'	=>	$_POST["emailLogista"],
				':status'	=>	$_POST["statusLogista"],
				':razao'	=>	$_POST["razaosocialLogista"],
				':imagem'		=>	$imagem,
				':desconto' => $_REQUEST["descontologista"],
				':responsavelLogista' => $_REQUEST["responsavelLogista"],
				':cpfresponsavelLogista' => $_REQUEST["cpfresponsavelLogista"],
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