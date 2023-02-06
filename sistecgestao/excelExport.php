<?php
include("conexao.php");
$idtitular = $_REQUEST["idtitular"];
$nomeservidor = $_REQUEST["nome"];
$select = $con->prepare("SELECT * FROM colaboradores WHERE id = '$idtitular'");
$select->execute();
$linha =  $select->fetch();
$nomeColaborador = $linha["nome"];

 header("Content-type: application/vnd.ms-excel");
 header("Content-type: application/force-download");
 header("Content-Disposition: attachment; filename=$nomeColaborador.xls");
 header("Pragma: no-cache");

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

 
</head>

<body>
<!-- End Header -->

  <!-- ======= hero Section ======= -->
  <!-- End Hero Section -->



    <!-- ======= About Section ======= -->
    <!-- End About Section -->

    <!-- ======= Services Section ======= -->
   
              
			
			
		<table border="1" cellpadding="5" cellspacing="5">
					
        
  <tbody>
    <tr>
      <td colspan="6" align="center"><h4><?=$linha["nome"]?></h4></td>
      </tr>
    <tr>
      <td colspan="2"><span ><strong>Matrícula</strong><br>
        <?=$linha["matricula"]?> </span></td>
      <td><span><strong>Data de Nascimento</strong><br>
	  <?=$linha["data_nascimento"]?> </span></td>
      <td><span><strong>Estado Civil</strong><br>
	  <?=$linha["estado_civil"]?> </span></td>
      <td colspan="2"><span><strong>Sexo</strong><br>
	  <?=$linha["sexo"]?> </span></td>
    </tr>
    <tr>
      <td height="56" colspan="3"><span><strong>Escolaridade</strong><br>
	  <?=$linha["escolaridade"]?> </span></td>
      <td width="18%"><span><strong>RG.</strong><br>
	  <?=$linha["rg"]?> </span></td>
      <td colspan="2"><span><strong>CPF</strong><br>
      <?=$linha["cpf"]?> </span></td>
    </tr>
    <tr>
      <td width="36%"><span><strong>Endereço</strong><br>
	  <?=$linha["endereco"]?> </span></td>
      <td width="9%"><span><strong>Número</strong><br>
	  <?=$linha["numero"]?> </span></td>
      <td width="21%"><span><strong>Bairro</strong><br>
	  <?=$linha["bairro"]?> </span></td>
      <td colspan="2"><span><strong>Cidade</strong><br>
        <?=$linha["cidade"]?> </span></td>
      <td width="15%"><span><strong>CEP</strong><br>
        <?=$linha["cep"]?> </span></td>
    </tr>
    <tr>
      <td><span><strong>Local de Trabalho</strong><br>
	  <?=$linha["local"]?> </span></td>
      <td colspan="2"><span><strong>Setor</strong><br>
	  <?=$linha["setor"]?> </span></td>
      <td colspan="3"><span><strong>Função</strong><br>
      <?=$linha["funcao"]?> </span></td>
    </tr>
    <tr>
      <td><span><strong>Email</strong><br>
	  <?=$linha["email"]?> </span></td>
      <td colspan="2"><span><strong>Telefone</strong><br>
	  <?=$linha["telefone"]?> </span></td>
      <td><span><strong>Celular</strong><br>
	  <?=$linha["celular"]?> </span></td>
      <td colspan="2"><span><strong>Wattsap</strong><br>
	  <?=$linha["wattsap"]?> </span></td>
    </tr>
    <tr>
      <td><span><strong>Tipo</strong><br>
	  <?=$linha["tipo"]?> </span></td>
      <td colspan="2"><span><strong>Data Admissão</strong><br>
	  <?=$linha["data1"]?> </span></td>
      <td colspan="2"><span><strong>Fim contrato</strong><br>
	  <?=$linha["data2"]?> </span></td>
      <td><span><strong>Limite Cartão</strong><br>
	  <?=$linha["limite"]?> </span></td>
    </tr>
   
  </tbody>
</table>
		<span class="title">
		<?=$linha["nome"]?>
		</span> <br>


              <table border="1" cellpadding="5" cellspacing="5">
        <thead>
			
        <tr class="cabecatabela" align="center">
          <th colspan="4">DEPENDENTES</th>
          </tr>
        <tr>
						
						<th width="5%">N°</th>
                        <th width="50%">NOME</th>
                        <th width="15%">DATA NASC.</th>
						<th width="20%">PARENTESCO</th>
                        
                       
						
                    </tr>
        </thead>
        <tbody>
				
				<?php
                include("conexao.php");
                $result = $con->prepare("SELECT * FROM dependentes WHERE id_titular = '$idtitular'");
                $result->execute();
					$i=1;
					while($row = $result->fetch()) {
						$idbdx = $row["id_dependentes"];
				?>
				<tr id="<?php echo $row["id_dependentes"]; ?>">
				
					<td><?php echo $i; ?></td>
					<td><?php echo $row["nome_dependente"]; ?></td>
					<td><?php echo $row["data_nascimento_dependente"]; ?></td>
					<td><?php echo $row["parentesco_dependente"]; ?></td>
					
					

					






				
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
        
        
    </table>
          
    <div id="conteudo" class="printable">
  
  <p style="text-align: center">&nbsp;</p>
  <p></p>
  <h3 style="text-align: center">LEI GERAL DE PROTEÇÃO DE DADOS PESSOAIS – LGPD
</h3>
	<div style="text-align: justify">
	Através do presente instrumento, eu <strong><?=$nomeColaborador?></strong>, inscrito (a) no CPF sob n° <strong><?=$linha["cpf"]?></strong>, matrícula n° <strong><?=$linha["matricula"]?></strong>, aqui denominado (a) como TITULAR, venho por meio deste, autorizar que SINDSERVA – SINDICATO DOS SERVIDORES PÚBLICOS MUNICIPAIS DE VARGINHA, pessoa jurídica de direito privado, com sede na Av. Brasil, nº 50, inscrita no CNPJ sob o nº 25.659.442/0001-75, neste ato representada por seu presidente MILLER FAGUNDES JORGE, brasileiro, casado, servidor público municipal de Varginha-MG, matrícula nº 2.5392-6, inscrito no CPF sob o n. 039.786.186-99, aqui denominada como CONTROLADOR, em razão de ato de associação sindical, disponha dos meus dados pessoais e dados pessoais sensíveis, de acordo com os artigos 7° e 11 da Lei n° 13.709/2018, conforme disposto neste termo:<br>

<strong>CLÁUSULA PRIMEIRA</strong><br>

<strong>Dados Pessoais</strong><br>

O Titular autoriza a Controladora a realizar o tratamento, ou seja, a utilizar os seguintes dados pessoais, para os fins que serão relacionados na cláusula segunda:
<ul>
<li> Nome completo</li>

<li> Data de nascimento;</li>

<li>Número e imagem da Carteira de Identidade (RG);</li>

<li> Número e imagem do Cadastro de Pessoas Físicas (CPF);</li>

<li> Número e imagem do Título de Eleitor;</li>

<li> Número e imagem do Certificado de Reservista;</li>

<li> Número e imagem da Carteira Nacional de Habilitação (CNH) (quando necessário para a função contratada);</li>

<li> Número e Imagem do cartão de vale transporte (quando utilizado pelo empregado);</li>

<li> Número e imagem do Programa de Integração Social (PIS);</li>

<li> CTPS física e/ou digital;</li>

<li> Fotografia 3×4;</li>

<li> Imagem da Certidão de Casamento ou Declaração de União Estável;</li>

<li>Imagem do Diploma de ___ (Nível de instrução ou escolaridade);</li>

<li> Endereço completo;</li>

<li> Números de telefone, WhatsApp e endereços de e-mail;</li>

<li> Banco, agência e número de contas bancárias;</li>

<li> Nome de usuário e senha específicos para uso dos serviços da Controladora;</li>

<li> Comunicação, verbal e escrita, mantida entre o Titular e o Controlador;</li>

<li> Exames e atestados médicos, especialmente admissionais, periódicos, incluídos de retorno por afastamento superior a 30 dias em caso de doença, acidente ou parto, de mudança de função, demissionais e ainda aqueles que atestem doença ou acidente;</li>

<li> Certidão de nascimento dos filhos menores de 14 anos, Carteira de vacinação dos menores de 7 anos, e atestado de matrícula e frequência escolar semestral dos maiores de 4 anos;</li>

<li> Documento de filiação ao Sindicato, ato de nomeação para o serviço público, exoneração e aposentadoria.</li>
</ul>

<strong>CLÁUSULA SEGUNDA</strong><br>

Finalidade do Tratamento dos Dados<br>

O Titular autoriza que a Controladora utilize os dados pessoais e dados pessoais sensíveis listados neste termo para as seguintes finalidades:

– Permitir que a Controladora identifique e entre em contato com o titular, em razão da condição de servidor público e ato de associação ao Sindicato.

– Para cumprimento de obrigações decorrentes da legislação.

– Para procedimentos de admissão, exoneração e aposentadoria do serviço público, assim como para permitir o exercício de direitos de associado.

– Para cumprimento, pela Controladora, de obrigações impostas por órgãos de fiscalização.

– Quando necessário para a executar um contrato, no qual seja parte o titular.

– A pedido do titular dos dados.

– Para o exercício regular de direitos em processo judicial, administrativo ou arbitral.

– Para a proteção da vida ou da incolumidade física do titular ou de terceiros.

– Para a tutela da saúde, exclusivamente, em procedimento realizado por profissionais de saúde, serviços de saúde ou autoridade sanitária.

– Quando necessário para atender aos interesses legítimos do controlador ou de terceiros, exceto no caso de prevalecerem direitos e liberdades fundamentais do titular que exijam a proteção dos dados pessoais.

– Para contratar e prestar serviços de em geral.

– Permitir que a Controladora utilize esses dados para a contratação e prestação de serviços diversos dos inicialmente ajustados, desde que o Titular também demonstre interesse em contratar novos serviços.

Parágrafo Primeiro: Caso seja necessário o compartilhamento de dados com terceiros que não tenham sido relacionados nesse termo ou qualquer alteração contratual posterior, será ajustado novo termo de consentimento para este fim (§ 6° do artigo 8° e § 2° do artigo 9° da Lei n° 13.709/2018).

Parágrafo Segundo: Em caso de alteração na finalidade, que esteja em desacordo com o consentimento original, a Controladora deverá comunicar o Titular, que poderá revogar o consentimento, conforme previsto na cláusula sexta.
<br>
<strong>CLÁUSULA TERCEIRA</strong>
<br>
Compartilhamento de Dados<br>

A Controladora fica autorizada a compartilhar os dados pessoais do Titular com outros agentes de tratamento de dados, caso seja necessário para as finalidades listadas neste instrumento, desde que, sejam respeitados os princípios da boa-fé, finalidade, adequação, necessidade, livre acesso, qualidade dos dados, transparência, segurança, prevenção, não discriminação e responsabilização e prestação de contas.
<br>
<strong>CLÁUSULA QUARTA</strong><br>

Responsabilidade pela Segurança dos Dados<br>

A Controladora se responsabiliza por manter medidas de segurança, técnicas e administrativas suficientes a proteger os dados pessoais do Titular e à Autoridade Nacional de Proteção de Dados (ANPD), comunicando ao Titular, caso ocorra algum incidente de segurança que possa acarretar risco ou dano relevante, conforme artigo 48 da Lei n° 13.709/2020.
<br>
<strong>CLÁUSULA QUINTA</strong><br>

Término do Tratamento dos Dados<br>

À Controladora, é permitido manter e utilizar os dados pessoais do Titular durante todo o período contratualmente firmado para as finalidades relacionadas nesse termo e ainda após o término da contratação para cumprimento de obrigação legal ou impostas por órgãos de fiscalização, nos termos do artigo 16 da Lei n° 13.709/2018.
<br>
<strong> CLÁUSULA SEXTA</strong><br>

Direito de Revogação do Consentimento<br>

O Titular poderá revogar seu consentimento, a qualquer tempo, por e-mail ou por carta escrita, conforme o artigo 8°, § 5°, da Lei n° 13.709/2020.

O Titular fica ciente de que a Controladora poderá permanecer utilizando os dados para as seguintes finalidades:

– Para cumprimento de obrigações decorrentes da legislação;

– Para procedimentos de admissão e execução do contrato de trabalho, inclusive após seu término;

– Para cumprimento, pela Controladora, de obrigações impostas por órgãos de fiscalização;

– Para o exercício regular de direitos em processo judicial, administrativo ou arbitral;

– Para a proteção da vida ou da incolumidade física do titular ou de terceiros;

– Para a tutela da saúde, exclusivamente, em procedimento realizado por profissionais de saúde, serviços de saúde ou autoridade sanitária;

– Quando necessário para atender aos interesses legítimos do controlador ou de terceiros, exceto no caso de prevalecerem direitos e liberdades fundamentais do titular que exijam a proteção dos dados pessoais.
<br>
<strong> CLÁUSULA SÉTIMA</strong><br>

Tempo de Permanência dos Dados Recolhidos<br>

O titular fica ciente de que a Controladora deverá permanecer com os seus dados pelo período mínimo de guarda de documentos trabalhistas, previdenciários, bem como os relacionados à segurança e saúde no trabalho, mesmo após o encerramento do vínculo empregatício.
<br>
<strong>CLÁUSULA OITAVA</strong>

Vazamento de Dados ou Acessos Não Autorizados – Penalidades

As partes poderão entrar em acordo, quanto aos eventuais danos causados, caso exista o vazamento de dados pessoais ou acessos não autorizados, e caso não haja acordo, a Controladora tem ciência que estará sujeita às penalidades previstas no artigo 52 da Lei n° 13.709/2018:
<br>
Varginha, <?=date("d")?>, <?=date("m")?> e <?=date("Y")?>.
<br><br>
<div style="text-align: center;">Assinatura:___________________________________________________________________________<br>

					<?=$nomeColaborador?> (Titular)</div>



	</div>
	
  </div>
 