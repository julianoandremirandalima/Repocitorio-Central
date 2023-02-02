<?php
include("conexao.php");
$idtitular = $_REQUEST["idtitular"];

$select = $con->prepare("SELECT * FROM lojas WHERE idLogista = '$idtitular'");
$select->execute();
//print_r($select);
$linha =  $select->fetch();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sindserva - Sindicato dos Servidores Públicos
Municipais de Varginha </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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

.cabecatabela {
	text-align: center;
}

@media print {
  body * {
    visibility: hidden;
  }
  .printable, .printable * {
    visibility: visible;
  }
 
}
  </style>
 <link href="assets/css/dataTables.bootstrap5.min.css" rel="stylesheet"> 
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	
	

</head>

<body>
<!-- End Header -->

  <!-- ======= hero Section ======= -->
  <!-- End Hero Section -->

  

    <!-- ======= About Section ======= -->
    <!-- End About Section -->

    <!-- ======= Services Section ======= -->
  
      <div class="container">
       
     
				<div align="right">
				<button type="button" class="btn btn-primary btn-sm" onclick="print();">
				<i class="bi bi-printer"></i> Imprimir
				</button>
				
				
				
        </div>
	
<div id="conteudo" class="printable">
  <p style="text-align: center"><img src="logohorizontal.png" width="220" height="50" alt=""/></p>
 
  <h5 style="text-align: center">CONTRATO DE PERMISSÃO PARA REALIZAÇÃO DE ATENDIMENTO E CONCESSÃO DE DESCONTOS PARA TERCEIROS PORTADORES CARTÃO SINDCARD</h5>

  
<div style="text-align: justify;">
Pelo presente instrumento particular, as partes

<strong> SINDSERVA – SINDICATO DOS SERVIDORES PÚBLICOS MUNICIPAIS DE VARGINHA</strong>, pessoa jurídica de direito privado, com sede na Rua Argentina, nº 245, inscrita no <strong>CNPJ sob o nº 25.659.442/0001-75</strong>, neste ato representada por seu presidente <strong>MILLER FAGUNDES JORGE</strong>, brasileiro, casado, servidor público municipal de Varginha-MG, matrícula nº 2.5392-6, inscrito no CPF sob o n. 039.786.186-99, residente e domiciliado na Alameda das Acácias, nº 184, bairro Pinheiros, em Varginha, Estado de Minas Gerais;

e de outro lado <strong> <?=$linha["nomeLogista"]?></strong>, inscrito no CNPJ sob n° <strong><?=$linha["cnpjLogista"]?></strong>, situado <strong><?=$linha["enderecoLogista"]?></strong> ,  ora representado por  <strong><?=$linha["responsavelLogista"]?></strong>,inscrito no CPF nº <strong><?=$linha["cpfresponsavelLogista"]?></strong>, doravante denominado <strong>CREDENCIADO</strong> têm entre si, justo e acordado o presente contrato, regido pelas seguintes cláusulas:<br>



<strong>CLÁUSULA PRIMEIRA - DO OBJETO</strong><br>

O presente contrato tem por objeto atendimento aos <strong> BENEFICIÁRIOS TITULARES DO CARTÃO SINDCARD</strong> mediante a concessão de desconto sobre o valor da compra efetuada, na proporção de <strong> <?=$linha["descontologista"]?>%</strong>.

<br>
<p><strong>CLÁUSULA SEGUNDA – DA IDENTIFICAÇÃO DO BENEFICIÁRIO<br>
</strong>A correta identificação do beneficiário é de total responsabilidade do <strong>CREDENCIADO</strong> que, para tanto exigirá do usuário/beneficiário o número do CPF ou matrícula e documento oficial apto a identificá-lo (RG, CNH, CTPS).<strong><br>
CLÁUSULA TERCEIRA – DO ATENDIMENTO</strong><br>
Não será de responsabilidade doSINDSERVA os atendimentos prestados aos usuários do cartão SINDCARD dentro dos estabelecimentos dos CREDENCIADOS.<strong><br>
</strong>O <strong>CREDENCIADO</strong>, em nenhuma hipótese e sob nenhum pretexto ou alegação poderá discriminar os beneficiários do<strong>SINDCARD</strong> ou atendê-los de forma distinta.<strong><br>
</strong>O<strong> CREDENCIADO</strong>deverá prestar os serviços/vendas em suas próprias instalações.<strong><br>
</strong>O <strong>CREDENCIADO</strong>não poderá delegar ou transferir a terceiro a prestação de serviços ora pactuada.<strong><br>
CLÁUSULA QUARTA - DOS MECANISMOS DE REGULAÇÃO</strong><br>
Com a finalidade de regular a utilização dos benefícios oferecidos, o <strong>SINDSERVA</strong>poderá adotar, a qualquer tempo, os mecanismos de regulação que se fizerem necessários.<br>
<strong>CLÁUSULA QUINTA – DA ÉPOCA DO PAGAMENTO<br>
</strong>O valor dos serviços  prestados ou das vendas realizadas pelo <strong>CREDENCIADO</strong> serão descontados da folha de pagamento do servidor público beneficiário  do cartão e depositados em favor do <strong>SINDSERVA </strong>para posterior repasse  ao vendedor/prestador de serviçosno  mesmo número de parcelasconcedido pelo credenciado ao beneficiário do cartão,  descontada a taxa acordada na cláusula primeira, firmados entre o CREDENCIADO e  SINDSERVA.<br>
<strong>Parágrafo  Primeiro  </strong>- As  informações das vendas ou contratações realizadas serão encaminhadas pelo  SindServa ao departamento de recursos humanos da Prefeitura Municipal no dia 10  de cada mês.<br>
<strong>Parágrafo  Segundo  </strong>- A data de pagamento das parcelas ao <strong>CREDENCIADO</strong> é vinculada à data  de pagamento da folha de salários da Prefeitura.<br>
<strong>Parágrafo Terceiro</strong> - O repasse do valor das vendas ou contratações ao conveniado será  realizado pelo SindServa no prazo de 05 dias úteis após receber da Prefeitura o  valor do desconto efetuado.<br>
<strong>Parágrafo Quarto</strong> - As compras ou contratações informadas entre os dias 1º e 10º serão  repassadas à Prefeitura visando serem incluídas no pagamento de salário do  mesmo mês.<br>
<strong>Parágrafo Quinto</strong> - As compras ou contratações informadas entre os dias 11 e 31 serão  repassadas à Prefeitura visando serem incluídas no pagamento de salário do mês  seguinte.<br>
  <strong>CLÁUSULA SEXTA -  VALOR DOS SERVIÇOS PRESTADOS</strong><br>
  Pela intermediação do negócio o SINDSERVA fará jus a remuneração consistente d<a name="_GoBack"></a>o percentual <strong> <?=$linha["descontologista"]?>%</strong> sobre o valor total da venda efetuada mediante desconto na primeira parcela.<br>
  <strong>Parágrafo único:</strong> A época do pagamento dessa comissão estatuída na cláusula sexta, será a mesma data do pagamento que dispõe a cláusula quinta.<br>
  <strong>CLÁUSULA SÉTIMA - DOS ENCARGOS</strong><br>
  O <strong>CREDENCIADO</strong> é responsável por todos os encargos de natureza tributária ou outras que venham a incidir sobre os valores dos serviços prestados.<br>
  <strong>CLÁUSULA OITAVA – DA RESCISÃO IMOTIVADA</strong><br>
  Este contrato poderá ser rescindido a qualquer tempo, por iniciativa de qualquer das partes, sem nenhum ônus, mediante comunicação por escrito, com antecedência mínima de 60 (sessenta) dias.<br>
  <strong>CLÁUSULA NONA - DA MANUTENÇÃO DAS CONDIÇÕES DE CREDENCIAMENTO</strong><br>
  O <strong>CREDENCIADO</strong> compromete-se a manter, durante a vigência contratual, todas as condições que o habilitaram para o credenciamento junto ao <strong>SINDSERVA</strong>, especialmente à manutenção de suas instalações em perfeitas condições de funcionamento e o oferecimento de serviços de boa qualidade.<br>
  <strong>CLÁUSULA DÉCIMA -  DA VIGÊNCIA<br>
  </strong>O presente contrato, após sua assinatura, terá vigência de 12 (doze) meses, renovando-se automaticamente, caso não haja manifestação expressa ao contrário, com antecedência mínima de 60 (sessenta) dias do seu vencimento.<br>
  <strong>CLÁUSULA DÉCIMA PRIMEIRA – DA INEXISTÊNCIA DE VÍNCULO EMPREGATÍCIO</strong><br>
  Este instrumento contratual não implica em vínculo empregatício de qualquer espécie visto que a prestação de serviços ora ajustada possui caráter autônomo, eventual e profissional liberal.<br>
  <strong>CLÁUSULA DÉCIMA SEGUNDA - DOS CASOS OMISSOS</strong><br>
  Os casos omissos serão resolvidos pela partes, mediante lavratura de termo aditivo.<br>
  <strong>CLÁUSULA DÉCIMA TERCEIRA  - DO FORO</strong><br>
  As partes elegem o foro da cidade de Varginha MG, para dirimir quaisquer dúvidas decorrentes deste contrato.</p>
</div>

<br>


<div style="text-align: center">
	Assim, justas e contratadas, celebram o presente instrumento.<br><br>
Varginha, <?=date("d/m/Y", strtotime($linha["dataLogista"]))?>. 
<br><br>
<img src="assmillertraco.png" style="max-width: 600px; width: 100%"><br>
MILLER FAGUNDES JORGE<br>
<strong>SINDSERVA</strong><br><br>

_____________________________________________________________________________<br>
<?=$linha["responsavelLogista"]?><br>
<strong> CREDENCIADO</strong><br>
<img src="upload/<?=$linha["imagem"]?>" width="146" alt=""/><br>

</div>
	
 <br>
 <br>
 <br> 
 