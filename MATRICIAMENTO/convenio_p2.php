<?php
include("header.php");

$iduserlogistalogado = $_SESSION["USER_ID"];

$datahoje = date("Y-m-d H:i:s");

$idLogista = $_REQUEST["convenio"];
$btcadastrar = $_REQUEST["btcadastrar"];
if($btcadastrar=="sim")
{
 	$matricula = $_REQUEST["servidor"];
	$valor = $_REQUEST["valor"];
	$responsavel = $_REQUEST["responsavel"];
	$obs = $_REQUEST["obs"];
	
	$cadastrar = $con->prepare("INSERT INTO empresasconveniadas_colaborador (id_empresa_cadastrada, matricula_colaborador_cadastrado, valor_contratado, responsavel, obs, data_cadastro) VALUES ('$idLogista', '$matricula', '$valor', '$responsavel', '$obs', '$datahoje')");
	$cadastrar->execute();
	
}

$btdeletar = $_REQUEST["deletar"];
if($btdeletar=="sim")
{
	$id = $_REQUEST["id"];
	$acao = $con->prepare("DELETE FROM empresasconveniadas_colaborador WHERE id_emp_conv = '$id'");
	$acao->execute();
	
}

$btresetar = $_REQUEST["resetar"];
if($btresetar=="sim")
{
	$senha = md5("123456");
	$id = $_REQUEST["id"];
	$acao = $con->prepare("UPDATE usuarios SET senha = '$senha' WHERE id = '$id'");
	$acao->execute();
}


//echo($_SESSION["USER_ID"]);
$select1 = $con->prepare("SELECT * FROM lojas WHERE idLogista = '$idLogista'");
$select1->execute();
$array1 = $select1->fetch();

?>
<script>
  	function confirmar() {
	         
       
		  var resultado = confirm("Deseja mesmo fazer isto?");
        if (resultado == true) {
            
            alert("Operação feita com sucesso!");
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
              <h4 class="title">CADASTRO DE SERVIDORES PARA O CONVÊNIO <span style="color:#00A9AC"><?=$array1["nomeLogista"]?></span></h4>
              <p class="description">Sistema SINDSERVA.</p>
              <hr>
			  <p id="success"></p>
              <div class="table-responsive">
              
			  <div align="left"><a href="convenio_p1.php"><button type="button" class="btn btn-secondary btn-sm">
				<i class="bi bi-arrow-left-circle"></i> voltar
				</button></a><br><br>
        <form class="row gy-2 gx-3 align-items-center" method="POST">
			
   
			<div class="col-4">
    <label for="autoSizingSelect">Servidor</label>
    <div class="input-group">
      
    <select class="form-select servidorx" id="servidor" name="servidor" required>
     <option value="">Selecione</option>
	<?php
		$selecColab = $con->prepare("SELECT * FROM colaboradores ORDER BY nome");
		$selecColab->execute();
		while($arrayColab = $selecColab->fetch())
		{
	?>
      <option value="<?=$arrayColab["matricula"]?>"><?=$arrayColab["nome"]?> (<?=$arrayColab["matricula"]?>)</option>
     <?php
		}
	?> 
      
    </select>
	
    </div>
  </div>

        <div class="col-1">
    <label for="autoSizingSelect">Valor</label>
    <div class="input-group">
     
    	 <input type="number" step="0.01" class="form-control" id="valor" name="valor" placeholder="valor" required>
    </div>
  </div>
  
  <div class="col-2">
    <label for="autoSizingInputGroup">Responsável</label>
    <div class="input-group">
     
      <input type="text" class="form-control" id="responsavel" name="responsavel" placeholder="Repita o nome do convênio ou o a pessoal responsável" value="<?=$array1["nomeLogista"]?>" required>
    </div>
  </div>
			
<div class="col-2">
    <label for="autoSizingInputGroup">Obs</label>
    <div class="input-group">
     
      <input type="text" class="form-control" id="obs" name="obs" placeholder="Coloque aqui o que julgar necessário">
    </div>
  </div>
			
		<input type="hidden" name="convenio" value="<?=$idLogista?>">	
  
  
  <div class="col-2">
    <button type="submit" class="btn btn-primary" name="btcadastrar" value="sim">CADASTRAR</button>
  </div>
</form>
      
      </div>
				
			 	
			<br>
              <table id="myTable" class="table">
        <thead>
        <tr>
						
						
                        <th width="30%">NOME</th>
                        <th width="10%">MATRÍCULA</th>
						<th width="15%">VALOR</th>
            <th width="5%" align="center">RESPONSÁVEL</th>
			 <th width="5%" align="center">OBS</th>
                        <th width="5%" align="center"> DELETAR</th>
						                 </tr>
        </thead>
        <tbody>
				
				<?php
                //include("conexao.php");
               
                $result = $con->prepare("SELECT empresasconveniadas_colaborador.*, colaboradores.* FROM empresasconveniadas_colaborador
                INNER JOIN colaboradores ON colaboradores.matricula = empresasconveniadas_colaborador.matricula_colaborador_cadastrado
                WHERE id_empresa_cadastrada = '$idLogista'  ORDER BY nome               
                ");
                $result->execute();
			  
					$i=1;
					while($row = $result->fetch()) {
						$idbdx = $row["id_emp_conv"];
				?>
				<tr id="<?php echo $row["id_emp_conv"]; ?>">
				
					
					<td><?php echo $row["nome"]; ?></td>
					<td><?php echo $row["matricula"]; ?></td>   
					<td><?php echo $row["valor_contratado"]; ?></td>
         			 <td><?php echo $row["responsavel"]; ?></td>
					<td><?php echo $row["obs"]; ?></td>
					<td align="center">
					<a href="convenio_p2.php?deletar=sim&id=<?=$idbdx?>&convenio=<?=$idLogista?>" class="btn btn-outline-danger btn-sm" onClick="return confirmar();"> Deletar </a>
		            </td>

				
				</tr>
				<?php
				$i++;
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
