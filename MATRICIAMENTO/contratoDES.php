<?php
session_start();
error_reporting(0);
include("conexao.php");
$filtrar = $_REQUEST["filtrar"];
if($filtrar=="sim")
{
  $ano = $_REQUEST["ano"];
  $mes = $_REQUEST["mes"];
}
else
{
  $ano = date("Y");
  $mes = date("m");
}
/*

header("Content-type: application/msword");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=detalhado-$mes-$ano.doc");
header("Pragma: no-cache");


*/
 
?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <title>Sindserva - Sindicato dos Servidores Públicos
Municipais de Varginha </title>
</head>

<body style="align-content: center">
<div id="conteudo">
  <p style="text-align: center"><img src="logohorizontal.png" width="220" height="50" alt=""/></p>
  <h2 style="text-align: center">TERMO DE ADESÃO</h2>
	<p style="text-align: justify">Pelo presente, o <strong>SINDICATO DAS EMPRESAS DE SEGURANÇA PRIVADA, DE  TRANSPORTE DE VALORES, DE CURSOS DE FORMAÇÃO E DE SEGURANÇA  ELETRÔNICA DO <span style="text-align: left">ESTADO</span> DE GOIÁS - SINDESP/GO</strong>, <strong>CNPJ nº</strong> 33.376.906/0001-64, com sede  na Rua dos Bombeiros nº 128, Qd. 248, Lts.: 12,14 e 15 – Parque Amazônia – CEP: 74.835-210 –  Goiânia - Goiás, declara, para os devidos fins, que está ciente e conforme com todos os termos,  condições Edital de Chamamento Público cujo objeto é o credenciamento de entidades representativas  para implantação, junto a esta Secretaria, de projeto de vídeo vigilância de vias urbanas com envio de  imagens ao sistema do Centro Integrado de Comando e Controle da SSP.</p>
	<p style="text-align: justify">Ao firmar o presente, o representante da instituição atesta perante a Secretaria de  Segurança Pública e Administração Penitenciária, para todos os fins e efeitos, ter os poderes  necessários e suficientes para validamente vinculá-la nos termos da declaração dada neste documento,  conforme documentação societária pertinente da instituição, e que tais documentos estão regularmente  em vigor e entregues neste ato à SSP/GO.  Das obrigações do <strong>SINDICATO DAS EMPRESAS DE SEGURANÇA PRIVADA, DE  TRANSPORTE DE VALORES, DE CURSOS DE FORMAÇÃO E DE SEGURANÇA  ELETRÔNICA DO ESTADO DE GOIÁS - SINDESP/GO</strong>: </p>
	<p style="text-align: justify">a) Manter, durante todo o período de habilitação, as condições de habilitação e qualificação exigidas  no Ato Convocatório e no Anexo I.  </p>
  <p style="text-align: justify">b) Assegurar à SSP o direito de fiscalizar, sustar, mandar refazer qualquer fornecimento que não  esteja de acordo com as normas ou especificações técnicas, sem ônus para a SSP; e,</p>
	<p style="text-align: justify">c) Responsabilizar-se, todas as despesas em sua totalidade, e ainda as despesas com tributos, débitos  trabalhistas e sociais, que eventualmente incidam, diretamente ou indiretamente sobre a execução do  objeto.  </p>
	<p style="text-align: justify">d) Providenciar toda a infraestrutura local para permitir a integração com o CICC, incluindo  equipamentos, solução de &ldquo;pânico&rdquo;, manutenção, adequações no software de monitoramento,  comunicação com a Internet, etc. Bem como, a ligação entre a entidade representativa e seus  associados finais.  </p>
	<p style="text-align: justify">O presente termo é firmado em 02 (duas) duas vias de igual teor e forma, para que produza os devidos  efeitos de fato e de direito.  </p>
	<p style="text-align: center"><span style="text-align: center"></span>Varginha, 01 de setembro de 2021. </p>
	<p style="text-align: center">&nbsp;</p>
	<p style="text-align: center">Leonardo Ottoni Vieira</p>
	<p style="text-align: center"><strong>Presidente do SINDSERVA</strong></p>
  </div>
</body>
</html>
<script>
var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#btGerarPDF').click(function () {
    doc.fromHTML($('#conteudo').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('exemplo-pdf.pdf');
});




</script>
