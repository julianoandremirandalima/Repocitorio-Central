<?php
include("header.php");
$NOMELOGADO = $_SESSION["USER_NOME"];
if($NOMELOGADO=="")
{
  echo "<script language= 'JavaScript'>location.href='index.php?error=Conexão expirada! Faça novamente o Login!'</script>";
  Header("Location: index.php?error=Conexão expirada! Faça novamente o Login!");
}
$iduserlogistalogado = $_SESSION["USER_ID"];
$idtitular = $_REQUEST["codico"];
$chave = $_REQUEST["chave"];
$valor = $_REQUEST["valor"];

//ALTERAÇÃO PARA COMPRAS ATÉ O DIA 9 DO MÊS, JOGAR NO MÊS VIGENTE=========================================
$diahoje = date("d");
//echo $diahoje;



//$parcelas = $_REQUEST["parcelas"] - 1;tenho que tirar isso depois isso é para jogar as vendas no mesmo mes;
//$parcelas = $_REQUEST["parcelas"];
$valorparcela = $_REQUEST["valorparcela"];
$loja = $_REQUEST["loja"];
$limite = $_REQUEST["limite"];

$idLogista = $_SESSION["USER_ID_IDENTIFICADOR"];

if($idLogista=="" || $idLogista==0)
{
  echo "<script language= 'JavaScript'>location.href='index.php?error=Conexão expirada! Faça novamente o Login!'</script>";
  Header("Location: index.php?error=Conexão expirada! Faça novamente o Login!");
  exit();
}

$saldo = $limite - $valorparcela;

if($diahoje<="09")
{
  $mesantes = date("m")-1;
  $mesantes = date($mesantes);
  //echo $mesantes."<br>";
  $datahoje = date("Y-$mesantes-d");
  $parcelas = $_REQUEST["parcelas"]-1;
  $parcelareal = $_REQUEST["parcelas"];
  //echo $datahoje;
}
else {
  $datahoje = date("Y-m-d");
  $parcelas = $_REQUEST["parcelas"];
  $parcelareal = $parcelas;
}

/*$datahoje = date("Y-m-d");
$parcelas = $_REQUEST["parcelas"];
$parcelareal = $parcelas;*/

//$datahoje = "2021-09-01";

//echo $chave."<br>";
function somar_datas( $numero, $tipo ){
  switch ($tipo) {
    case 'd':
    	$tipo = ' day';
    	break;
    case 'm':
    	$tipo = ' month';
    	break;
    case 'y':
    	$tipo = ' year';
    	break;
    }	
    return "+".$numero.$tipo;
}
$data = somar_datas( $parcelas, 'm'); // adiciona x meses a sua data

$datafim = date("Y-m-d", strtotime($data));

//echo $data."até".$datafim;

$start    = (new DateTime($datahoje))->modify('first day of this month');
$end      = (new DateTime($datafim))->modify('first day of next month');
$interval = DateInterval::createFromDateString('1 month');
$period   = new DatePeriod($start, $interval, $end);
$iv = 1;
foreach ($period as $dt) {
    //echo $dt->format("Y-m") . "<br>\n";
    $mes = $dt->format("m");
    $ano = $dt->format("Y");
    $datainteira = $dt->format("Y-m-d");
    //echo "Mês: ".$mes." Ano: ".$ano."<br>";
    $datahoje = date("Y-m-d", strtotime($datahoje));
    if($datainteira>$datahoje)
    {
      $indicev = $iv++;
      $datarealvenda = date("Y-m-d H:i:s");
      $inserirvenda = $con->prepare("INSERT INTO vendas (id_loja, id_usuario, chave_venda, data_venda, mes_venda, ano_venda, valortotal, valorparcela, quantasparcelas, status_venda, datarealvenda, numeroparcela, quemvendeu)
      VALUES
      ('$idLogista', '$idtitular', '$chave', '$datainteira', '$mes', '$ano', '$valor', '$valorparcela', '$parcelareal', 'EFETIVADA', '$datarealvenda', '$indicev', '$iduserlogistalogado')
      ");

if($idLogista=="" || $idLogista==0)
{
  echo "<script language= 'JavaScript'>location.href='index.php?error=Conexão expirada! Faça novamente o Login!'</script>";
  Header("Location: index.php?error=Conexão expirada! Faça novamente o Login!");
  exit();
}
else {
  $inserirvenda->execute();

  $selecetServidor = $con->prepare("SELECT * FROM colaboradores WHERE id = '$idtitular'");
  $selecetServidor->execute();
  $linha = $selecetServidor->fetch(); 
  $nomeservidor = $linha["nome"];
  $matriculaservidor = $linha["matricula"];
  $idcolaborador = $linha["id"];
  $limitebd = $linha["limite"];

  



}
     
      //echo $indicev. "<br>\n";

    }
}

//GRAVAR NA TABELA ALTERACAO LIMITE============================================================================
$enderecoip = $_SERVER["REMOTE_ADDR"];
$datahj = date("Y-m-d H:i:s");
$message = "VENDA EFETUADA NA DATA DE $datahj! - CHAVE: $chave\n";
$message .= "LIMITE ALTERADO DE $limitebd PARA $saldo \n";
$message .= "PARA O SERVIDOR $nomeservidor - $matriculaservidor \n";
$message .= "FEITA POR $NOMELOGADO \n";
$message .= "O IP QUE DISPAROU A AÇÃO FOI $enderecoip \n";
$message .= "VALOR TOTAL DA VENDA: $valor \n";
$message .= "EM $parcelareal PARCELA(S) DE: $valorparcela \n";

$loglimite = $con->prepare("INSERT INTO alteracaolimite (
  data_alteracao, para_quem_matricula, para_quem_nome, para_quem_id, quem_fez_id, quem_fez_nome, novovalor, limiteantigo, obs)
  VALUES
  ('$datahj', '$matriculaservidor', '$nomeservidor', '$idcolaborador', '$idLogista', '$NOMELOGADO', '$saldo', '$limitebd', '$message')
  ");
$loglimite->execute();

//ENVIAR E-MAIL-------------------------------------------
$selectLogista = $con->prepare("SELECT * FROM lojas WHERE idLogista = '$idLogista'");
$selectLogista->execute();
$arraylogista = $selectLogista->fetch();
$emailLogista = $arraylogista["emailLogista"];
      
  ini_set( 'display_errors', 1 );
  error_reporting( E_ALL );
  $from = " $NOMELOGADO <$emailLogista>";
  $to = "alteracaolimite@sindserva.esferasistemadigital.com.br,controlesindserva@gmail.com";
  $subject = "VENDA EFETUADA";
  
  $headers = "From:" . $from;
  mail($to,$subject,$message, $headers);
//ATUALIZAR O LIMITE=====
$novasenhacompra = rand(124569,999999);
$atualizarlimite = $con->prepare("UPDATE colaboradores SET limite = '$saldo', senhaparacompra = '$novasenhacompra' WHERE id = '$idtitular'");
$atualizarlimite->execute();






$selecetServidor = $con->prepare("SELECT * FROM colaboradores WHERE id = '$idtitular'");
$selecetServidor->execute();
$linha = $selecetServidor->fetch(); 
$nomeservidor = $linha["nome"];

$datachave = date("YmdHis");
$chavedavenda = $_SESSION["USER_ID"].$idtitular.$datachave;


?>
<!-- End Header -->

  <!-- ======= hero Section ======= -->
  <!-- End Hero Section -->

  <main id="main">

      

  <section id="services">
      <div class="container">
        <div class="section-header">
          
        </div>

        <div class="row gy-4">

          <div class="col-lg-12">
            <div class="box">
            
              <div class="icon"><i class="bi bi-people"></i></div>
              <h4 class="title printable"><?=$nomeservidor?></h4>
              <p class="description printable">Resumo da venda.</p>
              <hr>
			  <p id="success"></p>
              <div class="table-responsive">
              <div align="left"><a href="principal.php"><button type="button" class="btn btn-secondary btn-sm">
				<i class="bi bi-arrow-left-circle"></i> voltar
				</button></a></div>
              
			
				<div align="right">
        <button type="button" class="btn btn-outline-primary btn-sm view_data" data-bs-toggle="modal" data-bs-target="#editEmployeeModal" id="<?=$chave?>">
					Imprimir	
					
					</button>	
        </div>
			<br>
			<table border="0" cellpadding="5" cellspacing="5" class="table table-bordered printable">
  <tbody>
    <tr>
      <td width="36"><span ><strong>Nome</strong><br>
        <?=$linha["nome"]?> </span></td>
      <td width="21%"><span><strong>Matrícula</strong><br>
        <?=$linha["matricula"]?> </span></td>
      <td width="18%"><span><strong>Data</strong><br>
        <?=date("Y-m-d H:i:s")?> </span></td>
      <td width="15%"><span><strong>Chave</strong><br>
        <?=$chave?> </span></td>
    </tr>
    <tr>
      <td colspan="2"><strong>Vendendor</strong><br>
      <?=$_SESSION["USER_NOME"]?></td>
      <td colspan="2"><span><strong>Total da Venda</strong><br>
        R$ <?=number_format($valor,2,",",".")?> </span></td>
    </tr>
   
  </tbody>
</table>
<br>


              <table class="table table-bordered printable">
        <thead>
			
        <tr class="cabecatabela" align="center">
          <th colspan="3" bgcolor="#CCCCCC">PARCELAS</th>
          </tr>
        <tr>
						
						<th width="5%">N°</th>
                        <th width="15%">DATA </th>
						<th width="20%">VALOR</th>
                        
                       
						
                    </tr>
        </thead>
        <tbody>
				
				<?php
        $indice = 1;
        
      $selectparcelas = $con->prepare("SELECT * FROM vendas WHERE chave_venda = '$chave'");
      $selectparcelas->execute();
      while($linhaparcelas = $selectparcelas->fetch())
      {
        $dataparcela = $linhaparcelas["mes_venda"]."/".$linhaparcelas["ano_venda"];
        $i = $indice++;
				?>
				<tr id="<?php echo $row["id_dependentes"]; ?>">
				
					<td><?php echo $i; ?></td>
					<td><?php echo $dataparcela; ?></td>
					<td>R$ <?php echo number_format($valorparcela,2,",","."); ?></td>
				</tr>
				<?php
			
				}
				?>
				</tbody>
        
        
    </table>
              </div>  
            </div>
          </div>

          

          

          

        </div>

      </div>
    </section>

         <!-- Add Modal HTML -->
<div id="ModalVendas" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form">
					<div class="modal-header">						
						<h5 class="modal-title"><img src="icone.png"> SINDSERVA</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">					
					<span id="conteudo_venda"></span>
					
					</div>
					<div class="modal-footer">
					    
						<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
						<button type="button" class="btn btn-outline-success btn-sm" id="btn-add" onclick="js:window.print()">Imprimir</button>
					</div>
				</form>
			</div>
		</div>
	</div>



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include("footer.php");
  ?>

<script>
$(document).ready( function () {
    $('#myTable').DataTable({

      "oLanguage": {
                    "sProcessing":   "Processando...",
                    "sLengthMenu":   "Mostrar _MENU_ registros",
                    "sZeroRecords":  "Não foram encontrados resultados",
                    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                    "sInfoFiltered": "",
                    "sInfoPostFix":  "",
                    "sSearch":       "Buscar:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext":     "Seguinte",
                        "sLast":     "Último"
                    }
                },


    });


    $(document).on('click', '.view_data', function(){

      var chave_compra = $(this).attr("id");
      //alert(chave_compra);
      
      if(chave_compra !== ''){

        var dados = {
          chave_compra: chave_compra
        };
        $.post('visualizar2via.php', dados, function(retorna){
          $("#conteudo_venda").html(retorna);
          $("#ModalVendas").modal('show');

        });
      }



    });



} );
</script>

<script src="funcoesCadServ/ajax.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
    $("#celular, #telefone_u, #celular_u, #wattsap, #wattsap_u").mask("(00) 00000-0000");
	$("#telefone").mask("(00) 0000-0000");
	$("#cpf, #cpf_u").mask("000.000.000-00");
	$("#cep, #cep_u").mask("00000-000");
    </script>