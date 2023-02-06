<?php
include("header.php");

$iduserlogistalogado = $_SESSION["USER_ID"];

$idLogista = $_SESSION["USER_ID_IDENTIFICADOR"];
$btcadastrar = $_REQUEST["btcadastrar"];
if($btcadastrar=="sim")
{
 	$nome = $_REQUEST["nome"];
	$usuario = $_REQUEST["usuario"];
	$tipo = $_REQUEST["tipo"];
	$senha = md5("123456");
	
	$cadastrar = $con->prepare("INSERT INTO usuarios (nome, imagem, usuario, senha, tipo_user, status_user, id_identificador_logista) VALUES ('$nome', 'padrao.png', '$usuario', '$senha', '$tipo', 'ativo', '$idLogista')");
	$cadastrar->execute();
	
}

$btdeletar = $_REQUEST["deletar"];
if($btdeletar=="sim")
{
	$id = $_REQUEST["id"];
	$acao = $con->prepare("DELETE FROM usuarios WHERE id = '$id' AND id != '$iduserlogistalogado'");
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
              <h4 class="title">CADASTRO OPERADOR LOGISTA</h4>
              <p class="description">Sistema SINDSERVA.</p>
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
      <div class="input-group-text">Nome</div>
    	 <input type="text" class="form-control" id="usuario" name="nome" placeholder="Nome" required>
    </div>
  </div>
  
  <div class="col-auto">
    <label class="visually-hidden" for="autoSizingInputGroup">Usuário</label>
    <div class="input-group">
      <div class="input-group-text">Usuário</div>
      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="username" required>
    </div>
  </div>
			
			<div class="col-auto">
    <label class="visually-hidden" for="autoSizingSelect">Tipo</label>
    <div class="input-group">
      <div class="input-group-text">Tipo</div>
    <select class="form-select" id="autoSizingSelect" name="tipo" required>
     <option value="">Selecione</option>
      <option value="logista">Logista</option>
      <option value="operadorlogista">Operador Logista</option>
      
    </select>
    </div>
  </div>
  
  
  <div class="col-auto">
    <button type="submit" class="btn btn-primary" name="btcadastrar" value="sim">CADASTRAR</button>
  </div>
</form>
      
      </div>
				
			 	
			<br>
              <table id="myTable" class="table">
        <thead>
        <tr>
						
						<th width="5%">N°</th>
                        <th width="30%">NOME</th>
                        <th width="10%">USUÁRIO</th>
						<th width="15%">TIPO</th>
            <th width="5%" align="center">RESETAR SENHA</th>
                        <th width="5%" align="center"> DELETAR</th>
						                 </tr>
        </thead>
        <tbody>
				
				<?php
                //include("conexao.php");
                $idLogista = $_SESSION["USER_ID_IDENTIFICADOR"];
                $result = $con->prepare("SELECT * FROM usuarios
               
                WHERE id_identificador_logista = '$idLogista'                 
                ");
                $result->execute();
					$i=1;
					while($row = $result->fetch()) {
						$idbdx = $row["id"];
				?>
				<tr id="<?php echo $row["id"]; ?>">
				
					<td><?php echo $i; ?></td>
					<td><?php echo $row["nome"]; ?></td>
					<td><?php echo $row["usuario"]; ?></td>   
					<td><?php echo $row["tipo_user"]; ?></td>
          <td align="center"><a href="cadastro-operador-logista.php?resetar=sim&id=<?=$idbdx?>" class="btn btn-outline-success btn-sm" onClick="return confirmar();"> Resetar </a></td>
					<td align="center">
					<a href="cadastro-operador-logista.php?deletar=sim&id=<?=$idbdx?>" class="btn btn-outline-danger btn-sm" onClick="return confirmar();"> Deletar </a>
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
			<?php
                $resultotal = $con->prepare("SELECT * FROM usuarios
				
                WHERE id_identificador_logista = '$idLogista'           
                
                ");
                $resultotal->execute();
                $rowx = $resultotal->fetch();
            ?>
                        <th width="5%" align="center"></th>
                        <th width="5%" align="center"> </th>
						                 </tr>
			
			
			<tr bgcolor="#009999" style="color: #FFFFFF">
						
						<th></th>
                        <th ></th>
                        <th></th>
						<th></th>
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
