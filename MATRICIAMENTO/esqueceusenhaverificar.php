<?php
session_start();
## CONEX�O==========================================
include_once("conexao.php");

$usuario = $_REQUEST["usuario"];
$senhareal = $_REQUEST["senha"];
$senha = md5($_REQUEST["senha"]);


//ESQUECEU SENHA======================================
$btesqueceusenha = $_REQUEST["btesqueceusenha"];
if($btesqueceusenha=="sim")
{
	
	$selecuser = $con->prepare("SELECT * FROM usuarios WHERE usuario = '$usuario'");
	$selecuser->execute();
	$conta = $selecuser->rowCount();
	if($conta<1)
	{
		Header("Location: index.php?error=Email incorreto!");
	    exit();
	}
	else
	{
		// Dados de Envio
		$email_enviar = "SISTEC - MATRICIAMENTO <$usuario>";
		$assunto = "SISTEC MATRICIAMENTO - RECUPERAR SENHA";
		
		// Cabeçalho do Email
		$cabecalho = 'MIME-Version: 1.0' . "\r\n";
		$cabecalho .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";
		$cabecalho .= "Return-Path: $email_enviar \r\n";
		$cabecalho .= "From: $email_enviar \r\n";
		$cabecalho .= "Reply-To: $email_enviar \r\n";
		
		// Corpo do Email
		
		$mensagem = '<img src="https://semus.varginha.mg.gov.br/idSISteclaranja.png" width="213" height="77" /> <img src="https://semus.varginha.mg.gov.br/logoAPS.png" width="297" height="92" /><br><br>';
		$mensagem .= "RECUPERE SUA SENHA PELO LINK ABAIXO.<br>";
		$mensagem .= "ACESSO: https://semus.varginha.mg.gov.br/matriciamento<br>";
		$mensagem .= "<br /> <b>TECNOLOGIA DA INFORMAÇÃO SEMUS</br>";
		
		
		
		// Envia o Email
		if(mail($email_enviar, $assunto, $mensagem, $cabecalho))
		{
		//echo "Mensagem enviada com sucesso.";
		}
		else
		{
		echo "Sua mensagem não pode ser enviada. Tente novamente.";
		}
			
			//Header("Location: index.php?error=Mensagem enviada com sucesso!");
	    //exit();
			
	}


}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>.:SISTEC - SEMUS:. - Sistema de Matriciamento</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="icone.png" rel="icon">
  <link href="icone.png" rel="apple-touch-icon">
<style type="text/css">
:root{
--bg1: #66ADFF;/*azul*/
--bg2: #66ADFF;/*verde*/
/*--bg2: #099;verde*/
/*--bg2: #07C460;verde*/
}
body{
	font-family:Verdana, Geneva, sans-serif;
	color:#616161;
	background-image: linear-gradient(to right, var(--bg1) 50%, var(--bg2) 50%);
	height:100vh;
	display:grid;
	place-items: center;	
}

.container{
	background-color:rgba(255,255,255,0.15);
	height:90vh;
	width:90vh;
	border-radius:50%;
	box-sizing:border-box;
	padding:2.2rem;
	}
	
.circle{
	background-color:#fff;
	height:100%;
	border-radius:50%;
	text-align:center;
	display:grid;
	place-items:center;}
	
form{
	box-sizing:border-box;
	}
	
.single-title{
	font-size:2em;
	}
	
.single-text{
	padding-bottom:0.7em;
	border-bottom:3px solid var(--bg2);
	display:inline-block;
	}
	
.user, .pass, .btn{
	padding:1rem 1.5rem;
	margin-top:1rem;
	border-radius:50px;
	width:100%;
	outline:none;
	border:1px solid #adadad;
	display:block;
	box-sizing:border-box;
}

.pass{
	margin-top:0.4rem;
}

.flex{
	display:flex;
	justify-content: center;
	gap: 3rem;
	margin:1rem 0;
	font-size:0.8em;
}

.btn{
	background-color:var(--bg2);
	border:none;
	color:#fff;
	margin:1rem 0;
	cursor:pointer;
}

.btn:hover{
	background-color:var(--bg1);
}

.dont{
	font-style:0.8em;
}

a{
	text-decoration:none;
	color:var(--bg2);
	font-weight:500;
}
	

@media(max-width: 630px){
.container{
	height:100vw;
	width:100vw;
	}

}



</style>
</head>

<body>
<div class="container">
 <div class="circle" style="background-color:#fff">
 	
    <div align="center" class="rotated">
      <p><img src="logosistec.png" style="background-color:#003366; padding:20px; border-radius:30px; max-width:290px; width:100%"></p>
      <p><img src="logoAPS.png" width="297" height="92"></p>
	  <p> VERIFIQUE SUA CAIXA DE EMAIL E DÊ PROSSEGUIMENTO A RECUPERAÇÃO DE SUA SENHA! </p>
      <p><a href="index.php">FECHAR</a></p>
    </div>
     
    
    
     
   
 
 </div>
</div>
</body>
</html>
