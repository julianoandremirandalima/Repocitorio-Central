<?php
include("header.php");
$idtitular = $_REQUEST["codico"];
$chave = $_REQUEST["chave"];
$valor = $_REQUEST["valor"];
$parcelas = $_REQUEST["parcelas"] - 1;//tenho que tirar isso depois;
$valorparcela = $_REQUEST["valorparcela"];
$loja = $_REQUEST["loja"];
$limite = $_REQUEST["limite"];

$idLogista = $_SESSION["USER_ID_IDENTIFICADOR"];

$saldo = $limite - $valorparcela;

//$datahoje = date("Y-m-d");
$datahoje = "2021-09-01";

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
    
    if($datainteira>$datahoje)
    {
      $indicev = $iv++;
      $datarealvenda = date("Y-m-d H:i:s");
      $inserirvenda = $con->prepare("INSERT INTO vendas (id_loja, id_usuario, chave_venda, data_venda, mes_venda, ano_venda, valortotal, valorparcela, quantasparcelas, status_venda, datarealvenda, numeroparcela)
      VALUES
      ('$idLogista', '$idtitular', '$chave', '$datainteira', '$mes', '$ano', '$valor', '$valorparcela', '$parcelas', 'EFETIVADA', '$datarealvenda', '$indicev')
      ");
      $inserirvenda->execute();
      //echo $indicev. "<br>\n";

    }
}

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
        <?=$datahoje?> </span></td>
      <td width="15%"><span><strong>Chave</strong><br>
        <?=$chave?> </span></td>
    </tr>
    <tr>
      <td colspan="2"><strong>Loja</strong><br>
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