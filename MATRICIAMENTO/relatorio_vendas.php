<?php
include("header.php");
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

//EXTORNO=======
$extornar = $_REQUEST["extornar"];
$chave = $_REQUEST["chave"];
if($extornar=="sim")
{
	$sle = $con->prepare("SELECT vendas.*, colaboradores.* FROM vendas
	INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
	WHERE chave_venda = '$chave'");
	$sle -> execute();
	
	$arr = $sle->fetch();
	$total = $arr["valorparcela"];
	$idusu = $arr["id_usuario"];
	$limite = $arr["limite"];
  $nomeservidor = $arr["nome"];
  $matriculaservidor = $arr["matricula"];
  $idcolaborador = $idusu;
  $idLogista = $idlogistalogado;
	
	$novolimite = $limite + $total;
  $saldo = $novolimite;
  $limitebd = $limite;

  //GRAVAR NA TABELA ALTERACAO LIMITE============================================================================
  $enderecoip = $_SERVER["REMOTE_ADDR"];
  $datahj = date("Y-m-d H:i:s");
  $message = "EXTORNO NA DATA DE $datahj! - CHAVE: $chave\n";
  $message .= "LIMITE ALTERADO DE $limite PARA $saldo \n";
  $message .= "PARA O SERVIDOR $nomeservidor - $novolimite \n";
  $message .= "FEITA POR $NOMELOGADO \n";
  $message .= "O IP QUE DISPAROU A AÇÃO FOI $enderecoip \n";
  

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
    $subject = "EXTORNO EFETUADO";
    
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
	
	//DEVOLVER O LIMITE========
	$uplimite = $con->prepare("UPDATE colaboradores SET limite = '$novolimite' WHERE id = '$idusu'");
	$uplimite->execute();
	
	//DELETAR A VENDA
	$deletevenda = $con->prepare("DELETE FROM vendas WHERE chave_venda = '$chave'");
	$deletevenda->execute();
}
?>
<script>
  	function confirmar() {
	         
       
		  var resultado = confirm("Deseja mesmo extornar essa venda? Ao fazer isto o valor total será creditado ao Servidor!");
        if (resultado == true) {
            
            alert("Venda cancelada");
			return(true);
        }
        else{
            //alert("Você desistiu da venda!");
			return(false);
        }
		  
		  
		  
	
      
	    
	
	}




</script>

<!-- End Header -->

  <!-- ======= hero Section ======= -->
  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services">
      <div class="container">
        <div class="section-header">
          
        </div>

        <div class="row gy-4">

          <div class="col-lg-12">
            <div class="box">
            
              <div class="icon"><i class="bi bi-people"></i></div>
              <h4 class="title">RELATÓRIO DE VENDAS</h4>
              <p class="description">Servidores SINDSERVA.</p>
              <hr>
			  <p id="success"></p>
              <div class="table-responsive">
              
			  <div align="left"><a href="principal.php"><button type="button" class="btn btn-secondary btn-sm">
				<i class="bi bi-arrow-left-circle"></i> voltar
				</button></a><br><br>
        <form class="row gy-2 gx-3 align-items-center" method="POST">

        <div class="col-auto">
    <label class="visually-hidden" for="autoSizingSelect">Preference</label>
    <div class="input-group">
      <div class="input-group-text">Mês</div>
    <select class="form-select" id="autoSizingSelect" name="mes">
      <option <?=$mes?>><?=$mes?></option>
      <option value="01">01</option>
      <option value="02">02</option>
      <option value="03">03</option>
      <option value="04">04</option>
      <option value="05">05</option>
      <option value="06">06</option>
      <option value="07">07</option>
      <option value="08">08</option>
      <option value="09">09</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
    </select>
    </div>
  </div>
  
  <div class="col-auto">
    <label class="visually-hidden" for="autoSizingInputGroup">Ano</label>
    <div class="input-group">
      <div class="input-group-text">Ano</div>
      <input type="text" class="form-control" id="autoSizingInputGroup" name="ano" placeholder="ano" value="<?=$ano?>" maxlength="4">
    </div>
  </div>
  
  
  <div class="col-auto">
    <button type="submit" class="btn btn-primary" name="filtrar" value="sim">Filtrar</button>
	   <a href="relatorio_vendas_imprimir.php?ano=<?=$ano?>&mes=<?=$mes?>&idlogista=<?=$idlogistalogado?>" target="_blank" class="btn btn-warning">Imprimir</a>
  </div>
</form>
      
      </div>
				
			 	
			<br>
              <table id="myTable" class="table">
        <thead>
        <tr>
						
						<th width="5%">N°</th>
                        <th width="30%">NOME</th>
                        <th width="10%">MATRÍCULA</th>
                        <th width="15%">VENDEDOR</th>
						<th width="15%">DATA</th>
            <th>PARCELA</th>
            <th width="20%">CHAVE VENDA</th>
                        <th width="15%">VALOR</th>
                        <th width="5%" align="center">EXTORNAR</th>
                        <th width="5%" align="center"> DETALHE</th>
						                 </tr>
        </thead>
        <tbody>
				
				<?php
                //include("conexao.php");
                $idLogista = $_SESSION["USER_ID_IDENTIFICADOR"];
                $result = $con->prepare("SELECT SUM(valorparcela) AS total, colaboradores.matricula, colaboradores.nome, vendas.datarealvenda, chave_venda, numeroparcela, quantasparcelas, quemvendeu FROM vendas
                INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
                WHERE id_loja = '$idLogista' AND mes_venda = '$mes' AND ano_venda = '$ano'
                GROUP BY matricula, chave_venda
                
                ");
                $result->execute();
					$i=1;
					while($row = $result->fetch()) {
						//$idbdx = $row["id"];
				?>
				<tr id="<?php echo $row["id"]; ?>">
				
					<td><?php echo $i; ?></td>
					<td><?php echo $row["nome"]; ?></td>
					<td><?php echo $row["matricula"]; ?></td>
					<td>
					<?php
						
						$quemvendeu = $row["quemvendeu"];
						$selectqv = $con->prepare("SELECT * FROM usuarios WHERE id = '$quemvendeu'");
						$selectqv->execute();
						$arrayqv = $selectqv->fetch();
						echo($arrayqv["nome"]);
					?>
					</td>   
					<td><?php echo $row["datarealvenda"]; ?></td>
          <td><?php echo str_pad($row["numeroparcela"],2,'0', STR_PAD_LEFT)."/".str_pad($row["quantasparcelas"],2,'0',STR_PAD_LEFT); ?></td>
          <td><?php echo $row["chave_venda"]; ?></td>
					<td align="right">R$ <?php echo number_format($row["total"],2,",","."); ?></td>
					<td align="center"><a href="relatorio_vendas.php?ano=<?=$ano?>&mes=<?=$mes?>&chave=<?=$row["chave_venda"]?>&extornar=sim&filtrar=sim" class="btn btn-outline-danger btn-sm" onClick="return confirmar();"> Extorno </a></td>
					<td align="center">
					<button type="button" class="btn btn-outline-primary btn-sm view_data" data-bs-toggle="modal" data-bs-target="#editEmployeeModal" id="<?=$row["chave_venda"];?>">
					2.ª via	
					
					</button>	
		            </td>

				
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
        
        <tfoot>
        <tr>
						
						<td width="5%"></td>
                        <th width="30%"></th>
                        <th width="10%"></th>
                        <th width="15%"></th>
						<th width="15%"></th>
			<th width="15%"></th>
            <th width="20%">TOTAL</th>
            <?php
                $resultotal = $con->prepare("SELECT SUM(valorparcela) AS totalx, SUM(valorparcela - (valorparcela * descontologista/100)) AS totaldescontox, vendas.*, lojas.* FROM vendas
				INNER JOIN lojas ON vendas.id_loja = lojas.idLogista
                WHERE id_loja = '$idLogista' AND mes_venda = '$mes' AND ano_venda = '$ano'
                
                
                ");
                $resultotal->execute();
                $rowx = $resultotal->fetch();
            ?>
                        <td  align="right"><strong>R$ <?php echo number_format($rowx["totalx"],2,",","."); ?></strong></td>
                        <th width="5%" align="center"></th>
                        <th width="5%" align="center"> </th>
						                 </tr>
			
			
			<tr bgcolor="#009999" style="color: #FFFFFF">
						
						<td width="5%"></td>
                        <th width="30%"></th>
                        <th width="10%"></th>
                        <th width="15%"></th>
						<th width="15%"></th>
			<th width="15%"></th>
            <th width="20%">TOTAL A RECEBER (DESC.: <?=$rowx["descontologista"]?>%)</th>
          
                        <td  align="right"><strong>R$ <?php echo number_format($rowx["totaldescontox"],2,",","."); ?></strong></td>
                        <th width="5%" align="center"></th>
                        <th width="5%" align="center"> </th>
						                 </tr>
			
			
			
        </tfoot>
        
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
