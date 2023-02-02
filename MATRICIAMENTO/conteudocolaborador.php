<div align="center" style="display:<?=$mostrarsalario?>"><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#trocaPerfil">Para usar o cartão SindCard, clique aqui e complete seus dados!</button><br><br></div>
<div align="center" style="display:<?=$mostrarcartao?>"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#meucartao" style="background-color: #099;">Acesse aqui seu cartão SindCard!</button><br><br></div>

<?php
//ATUALIZAR OS CRÉDITOS SE O NUMERO DE PARCELAS BATER O NUMERO DE QUANTIDADE=====
//echo($idcolaboradorlogado);
$mesagora = date("m");
$anoagora = date("Y");
$selectCompras = $con->prepare("SELECT * FROM vendas WHERE id_usuario = '$idcolaboradorlogado' AND mes_venda = '$mesagora' AND ano_venda = '$anoagora' AND statusparcela = 'aberta' GROUP BY chave_venda");
$selectCompras->execute();
//print_r($selectCompras);
while($arrayCompras = $selectCompras->fetch())
{
  $chavebdvenda = $arrayCompras["chave_venda"];
  $parcelavenda = $arrayCompras["numeroparcela"];
  $qtasparcelas = $arrayCompras["quantasparcelas"];
  $valortotal = $arrayCompras["valorparcela"];
  //echo "CHAVE: ".$chavebdvenda." PARCELA: ".$parcelavenda." DE: ".$qtasparcelas."VALOR PARCELA: ".$valortotal."<br>";
  if($parcelavenda==$qtasparcelas)
  {
  $pegarolimite = $con->prepare("SELECT * FROM colaboradores WHERE id = '$idcolaboradorlogado'");
  $pegarolimite->execute();
  $arraylimite = $pegarolimite->fetch();
  $limiteatual = $arraylimite["limite"];
  $nomecolaborador = $arraylimite["nome"];
  $matriculacolaborador = $arraylimite["matricula"];
  $totalizar = $limiteatual + $valortotal; 
    
    //print_r($atualizalimite);

    $atualizavenda = $con->prepare("UPDATE vendas SET statusparcela = 'fechada' WHERE chave_venda = '$chavebdvenda'");
    $atualizavenda->execute();

    //GRAVAR NA TABELA ALTERACAO LIMITE============================================================================
    $enderecoip = $_SERVER["REMOTE_ADDR"];
    $datahj = date("Y-m-d H:i:s");
    $message = "ACESSO SERVIDOR - VOLTA AUTOMÁTICA DO LIMITE\n";
    $message .= "LIMITE ALTERADO DE $limiteatual PARA $totalizar PARA O SERVIDOR $nomecolaborador - $matriculacolaborador, FEITA QUANDO O SERVIDOR $NOMELOGADO ACESSOU O SISTEMA NA DATA DE $datahj \n";
    $message .= "ESTA OPERAÇÃO ACONTECE TODA VEZ QUE O SERVIDOR ACESSA O SISTEMA. \n NESTE MOMENTO O SISTEMA VARRE O BANCO DE DADOS PARA VER SE TEM PARCELA EM ABERTO E SE COINCIDE COM A ULTIMA PARCELA VOLTANDO ASSIM O VALOR PARA O LIMITE ATUAL!\n O IP QUE DISPAROU A AÇÃO FOI $enderecoip";
    
    $loglimite = $con->prepare("INSERT INTO alteracaolimite (
      data_alteracao, para_quem_matricula, para_quem_nome, para_quem_id, quem_fez_id, quem_fez_nome, novovalor, limiteantigo, obs)
      VALUES
      ('$datahj', '$matriculacolaborador', '$nomecolaborador', '$idcolaboradorlogado', '$idcolaboradorlogado', '$NOMELOGADO', '$totalizar', '$limiteatual', '$message')
      ");
    //$loglimite->execute();

    //ENVIAR E-MAIL-------------------------------------------
    $selectLogista = $con->prepare("SELECT * FROM lojas WHERE idLogista = '$idlogistalogado'");
    $selectLogista->execute();
    $arraylogista = $selectLogista->fetch();
    $emailLogista = $arraylogista["emailLogista"];
          
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $from = " $NOMELOGADO <$emailLogista>";
			$to = "controlesindserva@gmail.com,alteracaolimite@sindserva.esferasistemadigital.com.br,liviasindserva@gmail.com";
			$subject = "ACESSO SERVIDOR - VOLTA AUTOMÁTICA DO LIMITE";
		
			$headers = "From:" . $from;
			//mail($to,$subject,$message, $headers);

      $atualizalimite = $con->prepare("UPDATE colaboradores SET limite = '$totalizar' WHERE id = '$idcolaboradorlogado' AND cartao != 'bloqueado'");
      //$atualizalimite->execute();

  }
  
}

?>


<div class="row gy-4">

         <?php
          $idcolaboradorlogado = $_SESSION["USER_ID_COLABORADOR"];
            $selectColaborador = $con->prepare("SELECT * FROM colaboradores WHERE id = '$idcolaboradorlogado'");
            $selectColaborador->execute();
            $linhacolaborador = $selectColaborador->fetch();
         ?>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
            <a href="relatorio_compras.php">
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title">MEU SINDCARD (R$ <?=number_format($linhacolaborador["limite"],2,",",".")?>)</h4>
              <p class="description">SENHA ATUAL PARA COMPRAS: <?=$linhacolaborador["senhaparacompra"]?></p>
              </a>
            </div>
          </div>
	
		 <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box"><a href="lista-empresas.php">
              <div class="icon"><i class="bi bi-shop"></i></div>
              <h4 class="title">EMPRESAS PARCEIRAS</h4>
              <p class="description">Acesse aqui a lista de Empresas que aderiram nosso sistema!</p></a>
            </div>
          </div>

	

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="box"><a href="contratoServidor.php">
              <div class="icon"><i class="bi bi-clipboard-check"></i></div>
              <h4 class="title">CONTRATO</h4>
              <p class="description">ACESSE AQUI O CONTRATO DE PRESTAÇÃO DE SERVIÇOS.</p></a>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="box"><a href="leiLGPD.php">
              <div class="icon"><i class="bi bi-clipboard-data"></i></div>
              <h4 class="title">LEI LGPD</h4>
              <p class="description">ACESSE AQUI PARA LER A LEI DE PROTEÇÃO DE DADOS.</p></a>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
            <a href="help-suporte.php">
              <div class="icon"><i class="bi bi-question-diamond"></i></div>
              <h4 class="title">CENTRAL SINDSERVA - DÚVIDAS</h4>
              <p class="description">QUALQUER DÚVIDA, ENTRE EM CONTATO AQUI!</p>
              </a>
            </div>
          </div>
        </div>

        