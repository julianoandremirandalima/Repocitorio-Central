<?php
session_start();
error_reporting(0);
date_default_timezone_set ("America/Sao_Paulo");
include("conexao.php");

//TESTAR SE CONTINUA LOGADO E SE CASO NÃO, CHAMAR A TELA DE LOGIN======

$NOMELOGADO = $_SESSION["USER_NOME"];
/*
if($NOMELOGADO=="")
{
  echo "<script language= 'JavaScript'>location.href='index.php?error=Conexão expirada! Faça novamente o Login!'</script>";
  Header("Location: index.php?error=Conexão expirada! Faça novamente o Login!");
}
*/
$tipologado = $_SESSION["USER_TIPO"];
if($tipologado=="administrador")
{
  $menu = 'menuadmin.php';
  $conteudoprincipal = "conteudoadm.php";
  $mostrar = "none";
}
else if($tipologado=="logista")
{
  $menu = 'menulogista.php';
  $conteudoprincipal = "conteudologista.php";
  $mostrar = "none";
}
else if($tipologado=="operadorlogista")
{
  $menu = 'menulogista.php';
  $conteudoprincipal = "conteudologistaoperador.php";
  $mostrar = "none";
}
else if($tipologado=="operador")
{
  $menu = 'menuoperador.php';
  $conteudoprincipal = "conteudooperador.php";
  $mostrar = "none";
}
else
{
  $menu = 'menucolaborador.php';
  $conteudoprincipal = "conteudocolaborador.php";
  $mostrar = "block";
}
$idcolaboradorlogado = $_SESSION["USER_ID_COLABORADOR"];
$idlogistalogado = $_SESSION["USER_ID_IDENTIFICADOR_LOGISTA"];
$nomelogadox = $_SESSION["USER_NOME"];
//ALTERAR SENHA==========================================
$btaterasenha = $_REQUEST["btaterasenha"];

if($btaterasenha=="sim")
{   
    $confirma = md5($_REQUEST["confirmar"]);
    if($tipologado=="logista")
    {
      $alterarsenha = $con->prepare("UPDATE usuarios SET senha = '$confirma' WHERE id_identificador_logista = '$idlogistalogado'");
    }
    else
    {
      $alterarsenha = $con->prepare("UPDATE usuarios SET senha = '$confirma' WHERE id_identificador = '$idcolaboradorlogado'");
    }

    $alterarsenha->execute();
   
}
//ALTERAR PERFIL==========================================================
$btperfil = $_REQUEST["btperfil"];
if($btperfil=="sim")
{
  $nome = $_REQUEST["nome"];
  $escolaridade = $_REQUEST["escolaridade"];
  $estadocivil = $_REQUEST["estadocivil"];
  $endereco = $_REQUEST["endereco"];
  $numero = $_REQUEST["numero"];
  $bairro = $_REQUEST["bairro"];
  $cidade = $_REQUEST["cidade"];
  $cep = $_REQUEST["cep"];
  $cpf = $_REQUEST["cpf"];
  $salario = $_REQUEST["salario"];
  $rg = $_REQUEST["rg"];
 // $limitecalculo = $salario * 0.3;
/*
  if($limitecalculo<400)
  {
    $limitecalculo = 400;
  }
*/
  $alterar = $con->prepare("UPDATE colaboradores SET nome = '$nome', estado_civil = '$estadocivil', escolaridade = '$escolaridade', endereco = '$endereco', numero = '$numero', bairro = '$bairro', cidade = '$cidade', cep = '$cep', cpf = '$cpf', 
  rg = '$rg', salario = '$salario', cartao = 'sim'
   WHERE id = '$idcolaboradorlogado'");
   $alterar->execute();

   if(isset($_FILES["imagem_usuario"]))
   {
     $extensao = explode('.', $_FILES['imagem_usuario']['name']);
     $novo_nome = $idcolaboradorlogado. rand() . '.' . $extensao[1];
     $destino = 'upload/' . $novo_nome;
     move_uploaded_file($_FILES['imagem_usuario']['tmp_name'], $destino);
     //return $novo_nome;
     //echo "extenção: ".$extensao[1];
     if($extensao[1]!= ""){

     
     $trocafoto = $con->prepare("UPDATE usuarios SET imagem = '$novo_nome' WHERE id_identificador = '$idcolaboradorlogado'");
     $trocafoto->execute();
    }
   }


  
}

//ALTERAR DADOS FIXOS=======================================================================
$btdadosfixos = $_REQUEST["btdadosfixos"];
if($btdadosfixos=="sim")
{
  $atendimento = $_REQUEST["atendimento"];
  $endereco = $_REQUEST["endereco"];
  $tel1 = $_REQUEST["telefone1"];
  $tel2 = $_REQUEST["telefone2"];
  $wattsapp = $_REQUEST["wattsapp"];
  $facebook = $_REQUEST["facebook"];
  $instagram = $_REQUEST["instagram"];
  $desconto = $_REQUEST["desconto"];

  $atualizarfixo = $con->prepare("UPDATE variaveis SET atendimento = '$atendimento', endereco = '$endereco', telefone1 = '$tel1', telefone2 = '$tel2', wattsapp = '$wattsapp', facebook = '$facebook', instagram = '$instagram'");
  $atualizarfixo->execute();
}


//VARIAVEIS FIXAS=============================================
$selectfixas = $con->prepare("SELECT * FROM variaveis");
$selectfixas->execute();
$arrayfixa = $selectfixas->fetch();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SISTEC - SEMUS GESTÃO ADMINISTRATIVA</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Favicons -->
  <link href="icone.png" rel="icon">
  <link href="icone.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Reveal - v4.3.0
  * Template URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  
  <style type="text/css">
  .divhorizontal{
	  background:#fff;
	  transform: skewX(-20deg);
	  padding: .9rem;
	  -webkit-box-shadow: 1px 1px 9px 0px rgba(50, 50, 50, 0.32);
-moz-box-shadow:    1px 1px 9px 0px rgba(50, 50, 50, 0.32);
box-shadow:         1px 1px 9px 0px rgba(50, 50, 50, 0.32);
  }
  
  .logado{
	 
	  color:#069;
	 
	  
  }

  @media print {
    /* on modal open bootstrap adds class "modal-open" to body, so you can handle that case and hide body */
    body.modal-open {
        visibility: hidden;
    }

    body.modal-open .modal .modal-header,
    body.modal-open .modal .modal-body {
        visibility: visible; /* make visible modal body and header */
    }
}

#cartao{
  align-items: center;
  height: 220px;
  max-width: 460px;
  top: 0;
  left: 0;
  background-image: url("fundocartao500.jpg");
 background-position: right center;
  background-repeat:no-repeat;
}

#nomecartao{
  text-align:center;
  position: relative;
  top:50%;
  color:#fff;
  font-size: larger;

}
#numerocartao{
  
  text-align: right;
  position: relative;
  margin-right: 20px;
  top:120px;
  bottom:0;
  color:#fff;
  font-size: 14px;

}
</style>
 <link href="assets/css/dataTables.bootstrap5.min.css" rel="stylesheet"> 
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
 
 <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="alert/jAlert-v3.min.js"></script>
<script src="alert/jAlert-functions.min.js"></script>
<link rel="stylesheet" href="alert/jAlert-v3.css" />

<style>
.divalert{
  background: #6A0432;
  width:220px;
  border-radius: 15px;
  padding:20px;
  font-size:18px;
  color:#fff;   
}
</style>
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
       
        <i class="bi bi-telephone-fillX d-flex align-items-center ms-4"><span><marquee> Seja bem-vindo ao Sistema de Gestão Administrativa SEMUS!<br></marquee></span></i>
		 
      </div>
      
    </div>
  </section><!-- End Top Bar-->

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div id="logo" class="divhorizontal" style="padding:20px">
        <h1><a href="principal.php"><img src="idSIStec-contraste.png" width="270"></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt=""></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
              <?php 
                  //echo "tipo:".$_SESSION["USER_TIPO"];
                   
                      include($menu);
                   
                    
              
            ?>
           
           <li class="dropdown"><a href="#"><span> | Logado: <?=$_SESSION["USER_NOME"]?> </span> <i class="bi bi-person-circle"></i></a>
            <ul>
              <li><a href="#" style="color:#066" data-bs-toggle="modal" data-bs-target="#trocaSenha"><i class="bi bi-key"></i>Trocar Senha</a></li>
              
              <li style="display: <?=$mostrar?>;"><a href="#" style="color:#066" data-bs-toggle="modal" data-bs-target="#trocaPerfil"><i class="bi bi-person-bounding-box"></i>Atualizar Dados</a></li>
              <li style="display: <?=$mostrar?>;"><a href="#" style="color:#066" onClick="javascript:abrirJanela('detalhe.php?idtitular=<?=$idcolaboradorlogado?>&nome=<?=$nomelogadox?>', 1024, 700);"><i class="bi bi-people"></i>Dependentes</a></li>
              <script type="text/javascript">
						
						function abrirJanela(pagina, largura, altura) {
						// Definindo centro da tela
						var esquerda = (screen.width - largura)/2;
						var topo = (screen.height - altura)/2;
						// Abre a nova janela
						minhaJanela = window.open(pagina,'','height=' + altura + ', width=' + largura + ', top=' + topo + ', left=' + esquerda);
						}
						
						</script>
            </ul>
          </li>
           
           
           <li><a class="nav-link scrollto" href="index.php"> | Sair <i class="bi bi-unlock-fill"></i></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    

    </div>
  </header>


<!-- Modal -->
<script>
function validarSenha(){
var senha = document.getElementById('novasenha').value;
var senha2 = document.getElementById('confirmar').value;
//alert("aqui");
   if(senha!= senha2) {
        //senha2.setCustomValidity("Senhas diferentes!");
       alert("Senhas não coincidem!");
       return false; 
   }
   return true;
}




 </script> 
<form onSubmit="return validarSenha();">
 
<div class="modal fade" id="trocaSenha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar Senha</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Nova senha</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="novasenha" name="novasenha" required>
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Confirmar</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="confirmar" name="confirmar" required>
    </div>
  </div>
 
  
  



      </div>
      <div class="modal-footer">
        <input type="hidden" name="btaterasenha" value="sim">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Alterar</button>
      </div>
    </div>
  </div>
</div>
</form>


<!-- Modal Atulaizar perfil -->
<form method="POST" enctype="multipart/form-data">
<?php
  $selecionarcolaborador = $con->prepare("SELECT * FROM colaboradores WHERE id = '$idcolaboradorlogado'");
  $selecionarcolaborador->execute();
  $arraycolaborador = $selecionarcolaborador->fetch();
  $salariobd = $arraycolaborador["salario"];
  $cartao = $arraycolaborador["cartao"];
  if($salariobd>0&&$cartao=="sim")
  {
    $mostrarsalario = "none";
    $cor = '';
    $mostrarcartao = "block";
  }
  else
  {
    $mostrarsalario = "block";
    $cor = 'style="background-color: #ffca2c;"';
    $mostrarcartao = "none";
  }

?>
 
<div class="modal fade" id="trocaPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Atualizar Perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      
      <div class="col-12">
    <label for="inputEmail4" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nomex" name="nome" value="<?=$arraycolaborador['nome']?>" required>
  </div>

  <div class="col-12">
    <label for="inputEmail4" class="form-label">CPF (*Obrigatórios para desbloquear o cartão)</label>
    <input type="text" class="form-control cpf" id="cpfp" name="cpf" value="<?=$arraycolaborador['cpf']?>" <?=$cor?> required>
  </div>
  <div class="col-12">
    <label for="inputEmail4" class="form-label">RG</label>
    <input type="text" class="form-control" id="rgx" name="rg" value="<?=$arraycolaborador['rg']?>">
  </div>

  <div class="col-12" style="display:<?=$mostrarsalario?>">
    <label for="inputEmail4" class="form-label">SALÁRIO (*Obrigatórios para desbloquear o cartão)</label>
    <input type="number" min="0.00" max="6000.00" step="0.01" class="form-control moeda" id="salariox" name="salario" value="<?=$arraycolaborador['salario']?>" style="background-color: #ffca2c;">
  </div>

  <div class="col-md-12">
    <label  class="form-label">Estado Civil</label>
    <select style="font-size: 12px;" id="estadocivil_u" name="estadocivil" class="form-select" aria-label="Default select example" required>
								<option selected value="<?=$arraycolaborador['estado_civil']?>"><?=$arraycolaborador['estado_civil']?></option>
								<option value="CASADO">CASADO</option>
								<option value="SOLTEIRO">SOLTEIRO</option>
								
								</select>
  </div>
  <div class="col-md-12">
    <label for="inputPassword4cx" class="form-label">Escolaridade</label>
    <select style="font-size: 12px;" id="escolaridade_u" name="escolaridade" class="form-select" aria-label="Default select example" required >
								<option selected value="<?=$arraycolaborador['escolaridade']?>"><?=$arraycolaborador['escolaridade']?></option>
								<option value="ENSINO FUNDAMENTAL INCOMPLETO">ENSINO FUNDAMENTAL INCOMPLETO</option>
								<option value="ENSINO FUNDAMENTAL COMPLETO">ENSINO FUNDAMENTAL COMPLETO</option>
								<option value="ENSINO MÉDIO INCOMPLETO">ENSINO MÉDIO INCOMPLETO</option>
								<option value="ENSINO MÉDIO COMPLETO">ENSINO MÉDIO COMPLETO</option>
								<option value="ENSINO SUPERIOR INCOMPLETO">ENSINO SUPERIOR INCOMPLETO</option>
								<option value="ENSINO SUPERIOR COMPLETO">ENSINO SUPERIOR COMPLETO</option>
								
								</select>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Endereço</label>
    <input type="text" class="form-control" id="endereco" name="endereco" value="<?=$arraycolaborador['endereco']?>" required>
  </div>
  <div class="col-3">
    <label for="inputAddress2" class="form-label">Número</label>
    <input type="text" class="form-control" id="numero" name="numero" value="<?=$arraycolaborador['numero']?>" required>
  </div>
  <div class="col-md-6">
    <label for="bairro" class="form-label">Bairro</label>
    <input type="text" class="form-control" id="bairro" name="bairro" value="<?=$arraycolaborador['bairro']?>" required>
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">Cidade</label>
    <input type="text" class="form-control" id="inputCity" name="cidade" value="<?=$arraycolaborador['cidade']?>" required>
  </div>
  
  <div class="col-md-3">
    <label for="inputZip" class="form-label">CEP</label>
    <input type="text" class="form-control mascaracep" id="inputZip" name="cep" value="<?=$arraycolaborador['cep']?>" required>
  </div>
 <br>
  <div class="col-12">
  <label for="imagem_usuario" class="form-label">Escolha a foto</label>
  <input type="file" name="imagem_usuario" id="imagem_usuariox" />
				
  </div>
 
  
  



      </div>
      <div class="modal-footer">
        <input type="hidden" name="btperfil" value="sim">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Alterar</button>
      </div>
    </div>
  </div>
</div>
</form>

<div class="modal fade" id="meucartao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-body">
      <div align="right">  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
      
  <div class="row mb-3">
    
    <div class="col-sm-10">
      <div id="cartao">
        <div id="nomecartao"><?=$arraycolaborador["nome"]?></div>

        <div id="numerocartao">
        <?=$arraycolaborador["matricula"]?><br>
          <?=$arraycolaborador["cpf"]?><br>
          <?="Saldo: R$ ".number_format($arraycolaborador["limite"],2,",",".")?><br>
        </div>

      </div>
    </div>
  </div>
  
 
  
  



      </div>
      
    </div>
  </div>
</div>
	
	
	
<div class="modal fade" id="modalcontato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-body">
      <div align="right">  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
      
  <div class="row mb-12">
    
    <div class="col-sm-12">
		<h3>Esses são nosssos contatos!</h3>
      <div>
		  <i class="bi bi-geo-alt d-flex align-items-center ms-4"> <span><?=$arrayfixa["endereco"]?></span></i><br>
         <i class="bi bi-telephone-fill d-flex align-items-center ms-4"> <span><?=$arrayfixa["telefone1"]?></span></i><br>
		  <i class="bi bi-telephone-fill d-flex align-items-center ms-4"> <span><?=$arrayfixa["telefone2"]?></span></i><br>
		  <i class="bi bi-whatsapp d-flex align-items-center ms-4"> <span><?=$arrayfixa["wattsapp"]?></span></i><br>
		  
		  <a href="<?=$arrayfixa["facebook"]?>" target="_blank"><i class="bi bi-facebook d-flex align-items-center ms-4"><span> Nosso Facebook</span></i></a><br>
		  <a href="<?=$arrayfixa["instagram"]?>" target="_blank"><i class="bi bi-instagram d-flex align-items-center ms-4"><span> Nosso Instagram</span></i></a><br>
		  		 
      
		 
     

      </div>
    </div>
  </div>
  
 
  
  



      </div>
      
    </div>
  </div>
</div>

<!-- Modal Atulaizar dados fixos -->
<form method="POST" enctype="multipart/form-data">
<?php
  $selecionardadosfixo = $con->prepare("SELECT * FROM variaveis");
  $selecionardadosfixo->execute();
  $arrayfixa = $selecionardadosfixo->fetch();
  
 

?>
 
<div class="modal fade" id="dadosfixos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Atualizar dados fixos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      
      <div class="col-12">
    <label for="inputEmail4" class="form-label">Atendimento</label>
    <input type="text" class="form-control" id="atendimento" name="atendimento" value="<?=$arrayfixa['atendimento']?>" required>
  </div>

  <div class="col-12">
    <label for="inputEmail4" class="form-label">Endereço</label>
    <input type="text" class="form-control" id="endereco" name="endereco" value="<?=$arrayfixa['endereco']?>" required>
  </div>

  <div class="col-12">
    <label for="inputEmail4" class="form-label">Tel 1</label>
    <input type="text" class="form-control" id="telefone1" name="telefone1" value="<?=$arrayfixa['telefone1']?>" required>
  </div>

  <div class="col-12">
    <label for="inputEmail4" class="form-label">Tel 2</label>
    <input type="text" class="form-control" id="telefone2" name="telefone2" value="<?=$arrayfixa['telefone2']?>" required>
  </div>

  <div class="col-12">
    <label for="inputEmail4" class="form-label">wattsapp</label>
    <input type="text" class="form-control" id="wattsapp" name="wattsapp" value="<?=$arrayfixa['wattsapp']?>" required>
  </div>

  <div class="col-12">
    <label for="inputEmail4" class="form-label">Facebook</label>
    <input type="text" class="form-control" id="facebook" name="facebook" value="<?=$arrayfixa['facebook']?>" required>
  </div>

  <div class="col-12">
    <label for="inputEmail4" class="form-label">Instagram</label>
    <input type="text" class="form-control" id="instagram" name="instagram" value="<?=$arrayfixa['instagram']?>" required>
  </div>
  

  
  
  
 
  
  



      </div>
      <div class="modal-footer">
        <input type="hidden" name="btdadosfixos" value="sim">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Alterar</button>
      </div>
    </div>
  </div>
</div>
</form>