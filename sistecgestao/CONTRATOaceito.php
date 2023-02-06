<?php
include("conexao.php");
$idtitular = $_REQUEST["idtitular"];
$nomeservidor = $_REQUEST["nome"];
$select = $con->prepare("SELECT * FROM colaboradores WHERE id = '$idtitular'");
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

  <main id="main">

    <!-- ======= About Section ======= -->
    <!-- End About Section -->

    <!-- ======= Services Section ======= -->
    
      <div class="container">
        
        
              
              <br>
			
				<div align="right">
				<button type="button" class="btn btn-primary btn-sm" onclick="print();">
				<i class="bi bi-printer"></i> Imprimir
				</button>
				
				
        </div>
			<br>
		
	
	<div id="conteudo" class="printable">
  <p style="text-align: center"><img src="logohorizontal.png" width="220" height="50" alt=""/></p>
  
  <h3 style="text-align: center">CONTRATO PARTICULAR DE ADESÃO AO CARTÃO SINDCARD.
</h3>
	<div style="text-align: justify">
	<p>Pelo presente instrumento particular, de um lado SINDSERVA – SINDICATO DOS SERVIDORES PÚBLICOS MUNICIPAIS DE VARGINHA, pessoa jurídica de direito privado, com sede na Rua
	    Argentina, nº245, inscrito no CNPJ sob o nº 25.659.442/0001-75, neste ato representado por
	    seu presidente MILLER FAGUNDES JORGE, doravante denominado SINDSERVA ou
	    CONTRATADO; e, de outro lado, na qualidade de CONTRATANTE, o signatário deste
	    instrumento, devidamente qualificado no cadastro de titular do sistema SINDCARD.</p>
	  <p> Nos termos estabelecem as seguintes cláusulas e condições para a utilização dos benefícios a
	    serem prestados e administrados pela CONTRATADA, através do respectivo cartão SINDCARD.</p>
	  <p><strong>1. DO OBJETO</strong><br>
	    1.1. Através do presente instrumento o SINDSERVA fornecerá ao BENEFICIÁRIO TITULAR, o
	    direito de usar sua Rede cadastrada e conveniada o cartão SindCARD no comércio.<br>
	    1.2. Obedecidas as normas de atendimento adiante fixadas, o TITULAR poderá se utilizar dos
	    benefícios do cartão SindCARD.<br>
	    1.3. O SindCARD é um cartão que visa possibilitar o parcelamento das compras ou
	    contratações efetuadas na rede cadastrada e conveniada pelo sistema do cartão sindCARD.<br>
	    1.4. A disponibilidade do número de parcelas para efetuar as compras bem como os preços
	    dos produtos e os descontos oferecidos, ficarão à critério do estabelecimento conveniado.</p>
	  <p><strong>2. DAS FORMAS DE ADESÃO</strong><br>
	    2.1. A adesão ao cartão SindCARD será sempre efetivada pelo BENEFICIÁRIO TITULAR, por
	    meio de assinatura digital ou confirmação ao Termo de Adesão ao respectivo CARTÃO.</p>
	  <p><strong>3. DA UTILIZAÇÃO DO CARTÃO SindCARD</strong><br>
	    3.1. Mediante apresentação de seu cartão pessoal SindCARD, número do CPF ou número da
	    matrícula, e também de documento com foto que comprove sua identidade, à rede cadastrada
	    e conveniada pelo sistema do cartão SindCARD, o BENEFICIÁRIO TITULAR poderá obter descontos que irão variar de acordo com o convênio firmado previamente entre o
	    estabelecimento/prestador e o SINDSERVA.<br>
	    3.2. A utilização da rede credenciada será imediata a partir da assinatura do contrato.</p>
	  <p><strong>4. DA FORMA DE PAGAMENTO DOS CARTÕES SindCARD</strong><br>
	    4.1. O BENEFICIÁRIO TITULAR desde, logo, fica ciente que toda compra efetivada com o cartão
	    SINDCARD será descontada em folha de pagamento exatamente da forma acordada junto ao estabelecimento escolhido pelo beneficiário, sendo lançadas conforme a data da compra
	    realizada.<br>
	    4.2. O SINDSERVA não possui qualquer responsabilidade quanto à data dos descontos em folha
	    de pagamento, os quais obedecerão diretamente à dinâmica de trabalho do departamento de
	    Recursos Humanos de cada seção pública ao qual se vincula o associado.</p>
	  <p><strong>5. DO LIMITE DE CRÉDITO DO CARTÃO</strong><br>
	    5.1. O limite do valor de compra do cartão será definido pelo SINDSERVA conforme a base
	    salarial do BENEFICIÁRIO e ainda mediante apresentação do holerite deste.<br>
	    5.2. Caso não haja margem para desconto dos débitos em folha de pagamento do
	    BENEFICIÁRIO o SINDSERVA poderá a qualquer tempo, independente de aviso prévio,
	    restringir ou suprimir o limite do valor de compra do cartão SindCARD do BENEFICIÁRIO
	    TITULAR.<br>
	    5.3. Cabe ao BENEFICIÁRIO do cartão consultar seus limites antes de tentar utilizar o cartão na
	    rede de conveniados, ficando assim inteiramente responsável pelo fato de se deparar com
	    eventual ausência de limite para efetuar suas compras ou contratações.</p>
	  <p><strong>6. DA VIGÊNCIA</strong><br>
	    6. Este contrato tem prazo de vigência de 12 (doze) meses e será renovado automaticamente,
	    após o período inicial de vigência, salvo manifestação em contrário por escrito de qualquer das
	    partes, com 30 (trinta) dias de antecedência.<br>
	    6.1. Mesmo após a comunicação de rescisão do contrato, os descontos em folha continuarão
	    sendo efetuados até que ocorra o efetivo pagamento total da dívida oriunda da compra ou
	    contratação pelo BENEFICIÁRIO.</p>
	  <p><strong>7. DAS DISPOSIÇÕES GERAIS</strong><br>
	    7.1. O SINDSERVA não se responsabiliza por qualquer informação ou promessa que não esteja
	    expressamente prevista neste contrato, exceto se previamente acordados entre as partes por
	    instrumento escrito.<br>
	    7.2. Qualquer solicitação, sugestão ou reclamação do BENEFICIÁRIO correspondente ao
	    convencionado neste contrato ou em relação aos benefícios aqui oferecidos pela
	    CONTRATADA, seja a que título for, deverá ser realizada por escrito e protocolada na
	    administração do SINDSERVA, não se conhecendo a validade com ações verbais.<br>
	    7.3. O TITULAR declara perante a lei serem verdadeiros os dados pessoais seus fornecidos à
	    CONTRATADA para celebrar a presente contratação.</p>
	  <p><strong>8. DO FORO</strong></p>
	  <p>6.1. As partes desde já elegem o Foro da Comarca de Varginha, com expressa renúncia de
	    qualquer outro, por mais privilegiado que seja para dirimir as questões decorrentes deste
	    instrumento.</p>
	  <p><br>
	    E assim, por estarem justos e contratados, declara o BENEFICIÁRIO TITULAR que leu,
	    compreendeu e concordou com todo o conteúdo do presente instrumento, responsabilizando
	    se por todos os dados informados.</p>
	  <br>
		<div align="center">
			Varginha, <?=date("d")?>, <?=date("m")?> de <?=date("Y")?>.
			<br><br>
			<strong><u><?=$linha["nome"]?></u></strong><br>			
			PROPONENTE/CONTRATANTE<br><br>
			<img src="assmillertraco.png" style="max-width: 600px; width: 100%"><br>
MILLER FAGUNDES JORGE<br>
<strong>SINDSERVA</strong><br><br>


	</div>
	
  </div>
        
          

          

          

        </div>

      </div>
  

	


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 
