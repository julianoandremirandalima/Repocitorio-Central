<?php
include("header.php");
$filtrar = $_REQUEST["filtrar"];

$local = $_REQUEST["local"];
if($local=="FHOMUV")
{
  $localfiltro = " AND local = 'FHOMUV'";
  $seletadofhomuv = "selected";
  $seletadofc = "";
  $seletadoinprev = "";
  $seletadosemul = "";
  $seletadoprefeitura = "";
  $seletadoguarda = "";
}
else if ($local=="FUNDAÇÃO CULTURAL") {
  $localfiltro = " AND local = 'FUNDAÇÃO CULTURAL'";
  $seletadofhomuv = "";
  $seletadofc = "selected";
  $seletadoinprev = "";
  $seletadosemul = "";
  $seletadoprefeitura = "";
  $seletadoguarda = "";
}
else if ($local=="INPREV") {
  $localfiltro = " AND local = 'INPREV'";
  $seletadofhomuv = "";
  $seletadofc = "";
  $seletadoinprev = "selected";
  $seletadosemul = "";
  $seletadoprefeitura = "";
  $seletadoguarda = "";
}
else if ($local=="SEMUL") {
  $localfiltro = " AND local = 'SEMUL'";
  $seletadofhomuv = "";
  $seletadofc = "";
  $seletadoinprev = "";
  $seletadosemul = "selected";
  $seletadoprefeitura = "";
  $seletadoguarda = "";
}
else if ($local=="Guarda Municipal") {
  $localfiltro = " AND local = 'Guarda Municipal'";
  $seletadofhomuv = "";
  $seletadofc = "";
  $seletadoinprev = "";
  $seletadosemul = "";
  $seletadoprefeitura = "";
  $seletadoguarda = "selected";
}
else {
  $localfiltro = "AND local != 'FHOMUV' AND local != 'FUNDAÇÃO CULTURAL'  AND local != 'INPREV' AND local != 'SEMUL' AND local != 'Guarda Municipal'";
  $local = "PREFEITURA";
  $seletadofhomuv = "";
  $seletadofc = "";
  $seletadoinprev = "";
  $seletadosemul = "";
  $seletadoprefeitura = "selected";
  $seletadoguarda = "";
}

if($filtrar=="sim")
{
  $ano = $_REQUEST["ano"];
  $mes = $_REQUEST["mes"];
  $mostrardiv = "block";
}
else
{
  $ano = date("Y");
  $mes = date("m");
  $mostrardiv = "none";
}
?>

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
              <p class="description">AGRUPADO PARA <?=$local?></p>
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
    <label class="visually-hidden" for="autoSizingSelect">Preference</label>
    <div class="input-group">
      <div class="input-group-text">Local</div>
    <select class="form-select" id="autoSizingSelectXX" name="local" onchange="submit();">
     
      <option value="FHOMUV" <?=$seletadofhomuv?>>FHOMUV</option>
      <option value="FUNDAÇÃO CULTURAL" <?=$seletadofc?>>FUNDAÇÃO CULTURAL</option>
      <option value="Guarda Municipal" <?=$seletadoguarda?>>GUARDA MUNICIPAL</option>
      <option value="INPREV" <?=$seletadoinprev?>>INPREV</option>
      <option value="PREFEITURA" <?=$seletadoprefeitura?>>PREFEITURA</option>
      <option value="SEMUL" <?=$seletadosemul?>>SEMUL</option>
    </select>
    </div>
  </div>
  
  
  <div class="col-auto">
    <button type="submit" class="btn btn-primary" name="filtrar" value="sim">Filtrar</button>
        
  </div>
  <div class="col-auto" style="display: <?=$mostrardiv?>;">
   
    <a href="relatorio_sindcard.php?mes=<?=$mes?>&ano=<?=$ano?>&filtrar=sim" class="btn btn-secondary">Detalhada</a>
   
  </div>
  <div class="col-auto" style="display: <?=$mostrardiv?>;">
  
   <a href="relatorio_sindcard_loja.php?mes=<?=$mes?>&ano=<?=$ano?>&filtrar=sim" class="btn btn-secondary">Por Empresas</a>
 
 </div>
 
 <div class="col-auto" style="display: <?=$mostrardiv?>;">   
   
  <a  href="relatorio_sindcard_servidor_excel.php?mes=<?=$mes?>&ano=<?=$ano?>&filtrar=sim&local=<?=$local?>" target="_blanck"> <button type="button" class="btn btn-warning btn-sm" >
				<i class="bi bi-file-earmark-spreadsheet"></i> Exportar
				</button></a>
    
  </div>
</form>
      
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script>
        var total = 0;
        $(document).ready(function() {
            $('table tbody tr').each(function() {
                total += parseFloat(this.children[4].innerHTML);
                totaldecimal = total.toFixed(2);
            });
            $('#ttt').text('Total: ' + totaldecimal);
        });
    </script>

			<br>
              <table id="myTable" class="table">
        <thead>
        <tr>
						
						<th>NOME</th>
                        <th>MATRÍCULA</th>
                        <th>LOCAL</th>
                        <th>ANÁLISE</th>
					
                        <th>VALOR</th>
                        
						                 </tr>
        </thead>
        <tbody>
				<script type="text/javascript">
						
						function abrirJanela(pagina, largura, altura) {
						// Definindo centro da tela
						var esquerda = (screen.width - largura)/2;
						var topo = (screen.height - altura)/2;
						// Abre a nova janela
						minhaJanela = window.open(pagina,'','height=' + altura + ', width=' + largura + ', top=' + topo + ', left=' + esquerda);
						}
						
						</script>
				<?php
                //include("conexao.php");
                
                $result = $con->prepare("SELECT SUM(valorparcela) AS total, colaboradores.*, lojas.*, vendas.* FROM vendas
                INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
                INNER JOIN lojas ON vendas.id_loja = lojas.idLogista
                
                WHERE mes_venda = '$mes' AND ano_venda = '$ano' $localfiltro
                GROUP BY id
                ORDER BY nome
                ");
                $result->execute();
                //print_r($result);
					$i=1;
					while($row = $result->fetch()) {
						$idbdx = $row["id"];
				?>
				<tr id="<?php echo $row["id"]; ?>">
				
					<td><?php echo $row["nome"]; ?></td>
					<td><?php echo $row["matricula"]; ?></td>
					<td><?php echo $row["local"]; ?></td>
					<td><button type="button" class="btn btn-primary btn-sm"  onclick="javascript:abrirJanela('analisarlimite.php?id=<?=$idbdx?>', 1024, 700);">Analisar <i class="bi bi-person-plus dependente" data-toggle="tooltip" title="Dependentes"></i></button></td>   
					<?php
              $matriculabd =  $row["matricula"];
              $totalcompra =  $row["total"];
              $selectconvenios = $con->prepare("SELECT SUM(valor_contratado) AS totalconvenio, matricula_colaborador_cadastrado FROM empresasconveniadas_colaborador WHERE matricula_colaborador_cadastrado = '$matriculabd'");
              $selectconvenios->execute();
              $arrayconvenios = $selectconvenios->fetch();
              $totalconvenios = $arrayconvenios["totalconvenio"];

              //$totais = $totalcompra + $totalconvenios;
              $totais = $totalcompra;
          ?>
					<td align="right"> <?php echo number_format($totais,2,".",""); ?></td>
				

				
				</tr>
				<?php
				$i++;
				}

        //SELECIONAR OS QUE NÃO FIZERAM COMPRA MAS ESTÃO NOS CONVENIOS===================================
        $ib=1;
         $selecsoconvenios= $con->prepare("SELECT empresasconveniadas_colaborador.*, colaboradores.* FROM colaboradores
         INNER JOIN empresasconveniadas_colaborador ON empresasconveniadas_colaborador.matricula_colaborador_cadastrado = colaboradores.matricula
         WHERE id != '' $localfiltro
         ");
         $selecsoconvenios->execute();
         while($rowx =  $selecsoconvenios->fetch())
         {
           $idconvenios = $rowx["id"];
           $selectvendasfeitas = $con->prepare("SELECT SUM(valorparcela) AS total, colaboradores.*, lojas.*, vendas.* FROM vendas
           INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
           INNER JOIN lojas ON vendas.id_loja = lojas.idLogista
           
           WHERE mes_venda = '$mes' AND ano_venda = '$ano' $localfiltro");
           $selectvendasfeitas->execute();
           $arrayfeitos = $selectvendasfeitas->fetch();
           $idfeitas = $arrayfeitos["id_usuario"];
           
           if($idconvenios!=$idfeitas)
           { 
				?>

<tr id="<?php echo $rowx["id"]; ?>">
				
        <td><?php echo $rowx["nome"]; ?></td>
        <td><?php echo $rowx["matricula"]; ?></td>
        <td><?php echo $rowx["local"]; ?></td>
        <td><button type="button" class="btn btn-warning btn-sm"  onclick="javascript:abrirJanelax('analisarlimite.php?id=<?=$ib?>', 1024, 700);">Convenio <i class="bi bi-person-plus dependente" data-toggle="tooltip" title="Dependentes"></i></button><br><?php echo $rowx["responsavel"]; ?></td>   
        <td align="right"> <?php echo number_format($rowx["valor_contratado"],2,".",""); ?></td>
      

      
      </tr>

        <?php
        $ib++;
         }
        }
        ?>
       
				</tbody>
        
        <tfoot>
        <tr>
						
       <td></td>
       <td></td>
            <td  align="right">&nbsp;</td>
            <td  align="right">&nbsp;</td>
           
                        <td id="ttt" align="right"><strong></strong></td>
                        
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


