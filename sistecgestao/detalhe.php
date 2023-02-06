<?php
$idtitular = $_REQUEST["idtitular"];
$nomeservidor = $_REQUEST["nome"];
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
	  /*transform: skewX(-20deg);
	  padding: .9rem;*/
	  -webkit-box-shadow: 1px 1px 9px 0px rgba(50, 50, 50, 0.32);
-moz-box-shadow:    1px 1px 9px 0px rgba(50, 50, 50, 0.32);
box-shadow:         1px 1px 9px 0px rgba(50, 50, 50, 0.32);
  }
  
  .logado{
	 
	  color:#069;
	 
	  
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
    <section id="services">
      <div class="container">
        <div class="section-header">
			
          
        </div>

        <div class="row gy-4">

            <div class="box">
          <div class="col-lg-12">
            
              <div class="icon"><i class="bi bi-people"></i></div>
              <h4 class="title"><?=$nomeservidor?></h4>
              <p class="description">Lista dos Dependentes.</p>
              <hr>
			  <p id="success"></p>
              <div class="table-responsive">
              
			
				<div align="right">
				<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
				<i class="bi bi-plus-circle"></i> Adicionar
				</button>
				<a href="JavaScript:void(0);" id="delete_multiple"> 
				<button type="button" class="btn btn-danger btn-sm">
				<i class="bi bi-dash-circle"></i> Excluir
				</button></a>
				
        </div>
			<br>
              <table id="myTable" class="table table-striped">
        <thead>
        <tr>
						<th width="5%">
							<span class="custom-checkbox">
								<input style="font-size: 12px;" type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th width="5%">N°</th>
                        <th width="40%">NOME</th>
                        <th width="20%">DATA NASC.</th>
						<th width="25%">PARENTESCO</th>
                        
                        <th width="5%">EDITAR</th>
						
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
				<td>
							<span class="custom-checkbox">
								<input style="font-size: 12px;" type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id_dependentes"]; ?>">
								<label for="checkbox2"></label>
							</span>
						</td>
					<td><?php echo $i; ?></td>
					<td><?php echo $row["nome_dependente"]; ?></td>
					<td><?php echo $row["data_nascimento_dependente"]; ?></td>
					<td><?php echo $row["parentesco_dependente"]; ?></td>
					
					<td>
					<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editEmployeeModal">
						
						<i class="bi bi-pen update" data-toggle="tooltip" 
							data-id="<?php echo $row["id_dependentes"]; ?>"
							data-nome="<?php echo $row["nome_dependente"]; ?>"
							data-data="<?php echo $row["data_nascimento_dependente"]; ?>"
							data-parentesco="<?php echo $row["parentesco_dependente"]; ?>"
							
							title="Editar"> 
						</i>
					</button>	
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
<div id="addEmployeeModal" class="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" style="font-size: 10px;">
				<form id="user_form">
					<div class="modal-header" style="background-color: #066; color:#fff">						
						<h4 class="modal-title">ADICIONAR</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">					
						
					<input style="font-size: 12px;" type="hidden" value="<?=$idtitular?>" name="idtitular">
						<div class="row">
							<div class="form-group col-md-12">
							<label>NOME</label>
											
								<input style="font-size: 12px;" type="text" name="nome" class="form-control" id="nome"  >
							</div>
							
						</div>


						<div class="row">
						

							<div class="form-group col-md-4">
							<label>DATA NASCIMENTO</label>
											
								<input style="font-size: 12px;" type="date" name="data" class="form-control" id="data"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>PARENTESCO</label>
											
							<select style="font-size: 12px;" id="parentesco" name="parentesco" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="CÔNJUGE (ESPOSO - ESPOSA)">CÔNJUGE (ESPOSO - ESPOSA)</option>
								<option value="FILHO(A)">FILHO(A)</option>
								<option value="PAIS">PAIS</option>
								<option value="AVÓS">AVÓS</option>
								<option value="PESSOA INCAPAZ (SEJA O TUTOR)">PESSOA INCAPAZ (SEJA O TUTOR)</option>
								
								</select>

							</div>
						</div>

					</div>
					<div class="modal-footer">
					    <input style="font-size: 12px;" type="hidden" value="1" name="type">
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
						<button type="button" class="btn btn-success btn-sm" style="background-color: #066;" id="btn-add">Adicionar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog modal-lg" style="font-size: 10px;">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header" style="background-color: #066; color:#fff">						
						<h4 class="modal-title">EDITAR</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">					
					<input style="font-size: 12px;" type="hidden" id="id_u" name="id" class="form-control" >	
					
						<div class="row">
							<div class="form-group col-md-12">
							<label>NOME</label>
											
								<input style="font-size: 12px;" type="text" name="nome" class="form-control" id="nome_u">
							</div>
							
						</div>


						<div class="row">
						

							<div class="form-group col-md-4">
							<label>DATA NASCIMENTO</label>
											
								<input style="font-size: 12px;" type="date" name="data" class="form-control" id="data_u"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>PARENTESCO</label>
											
							<select style="font-size: 12px;" id="parentesco_u" name="parentesco" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="CÔNJUGE (ESPOSO - ESPOSA)">CÔNJUGE (ESPOSO - ESPOSA)</option>
								<option value="FILHO(A)">FILHO(A)</option>
								<option value="PAIS">PAIS</option>
								<option value="AVÓS">AVÓS</option>
								<option value="PESSOA INCAPAZ (SEJA O TUTOR)">PESSOA INCAPAZ (SEJA O TUTOR)</option>
								</select>

							</div>
						</div>



					</div>
					
					<div class="modal-footer">
					<input style="font-size: 12px;" type="hidden" value="2" name="type">
					<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
						<button type="button" class="btn btn-primary btn-sm" style="background-color: #066;" id="update">Alterar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Deletar Usuário</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input style="font-size: 12px;" type="hidden" id="id_d" name="id" class="form-control">					
						<p>Tem certeza de que deseja excluir este registro?</p>
						<p class="text-warning"><small>Essa ação não pode ser desfeita.</small></p>
					</div>
					<div class="modal-footer">
						<input style="font-size: 12px;" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<!-- MODAL DEPENDETE -->
<div id="modaldependente" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" style="font-size: 10px;">
				<form id="user_form">
					<div class="modal-header" style="background-color: #066; color:#fff">						
						<h4 class="modal-title">ADICONAR DEPENTE</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">					
						
					
						<div class="row">
							<div class="form-group col-md-12">
							<label>NOME</label>
											
								<input style="font-size: 12px;" type="text" name="nome_d" class="form-control" id="nome_d"  >
							</div>
							
						</div>


						<div class="row">
						<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>DATA NASCIMENTO</label>
											
								<input style="font-size: 12px;" type="date" class="form-control" name="data_d" id="data_d"  >
							</div>

							
							<div class="form-group col-md-8 mt-3 mt-md-0">
							<label>GRAU DE PARENTESCO</label>
											
							<select style="font-size: 12px;" id="parentesco_d" name="parentesco_d" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="CÔNJUGE (ESPOSO - ESPOSA)">CÔNJUGE (ESPOSO - ESPOSA)</option>
								<option value="FILHO(A)">FILHO(A)</option>
								<option value="PAIS">PAIS</option>
								<option value="AVÓS">AVÓS</option>
								<option value="PESSOA INCAPAZ (SEJA O TUTOR)">PESSOA INCAPAZ (SEJA O TUTOR)</option>
								
								</select>

							</div>
						</div>


					</div>
					<div class="modal-footer">
					    <input style="font-size: 12px;" type="hidden" value="5" name="type">
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
						<button type="button" class="btn btn-success btn-sm" style="background-color: #066;" id="btn-add">Adicionar</button>
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
} );
</script>

<script src="funcoesCadDependente/ajax.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
    $("#telefone, #celular, #telefone_u, #celular_u, #wattsap, #wattsap_u").mask("(00) 00000-0000");
	$("#cpf, #cpf_u").mask("000.000.000-00");
	$("#cep, #cep_u").mask("00000-000");
    </script>
