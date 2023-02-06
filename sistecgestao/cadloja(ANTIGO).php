<?php
include("header.php");
?>
<!-- End Header -->

  <!-- ======= hero Section ======= -->
  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <!-- End About Section -->

    <!-- ======= Services Section ========== -->
    <section id="services">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          
        </div>

        <div class="row gy-4">

          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
            
              <div class="icon"><i class="bi bi-person-badge"></i></div>
              <h4 class="title">EMPRESAS CADASTRADAS NO SISTEMA</h4>
              <p class="description">Listagem geral.</p>
              <hr>
              <div class="table-responsive">
              <div align="left"><a href="principal.php"><button type="button" class="btn btn-secondary btn-sm">
				<i class="bi bi-arrow-left-circle"></i> voltar
				</button></a></div>
			
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-bs-target="#userModal" class="btn btn-success btn-sm">Adicionar <i class="bi bi-person-plus-fill"></i></button>
				
        </div>
			<br>
		<div class="table-responsive">
              <table id="user_data" class="table table-primary table-striped">
        <thead>
            <tr>
                <th width="15%">Foto</th>
                <th width="30%">Nome</th>
                <th width="20%">CNPJ</th>
                <th width="20%">Endereço</th>
                <th width="5%">Contrato</th>
                <th width="5%">Editar</th> 
                <th width="5%">Excluir</th>
                
            </tr>
        </thead>
        
        <tfoot>
            <tr>
            <th>Foto</th>
							<th>Nome</th>
							<th>CNPJ</th>
              <th>Endereço</th>
							<th>Contrato</th>
              <th>Editar</th>
							<th>Delete</th>
                
            </tr>
        </tfoot>
    </table>
				  </div>
              </div>  
            </div>
          </div>

          

          

          

        </div>

      </div>
    </section>

    



<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="user_form" enctype="multipart/form-data">
      <div class="modal-body">
      
			<div class="modal-content">
			
				<div class="modal-body">
        <label><strong>Nome de Usuário no sistema</strong></label>
					<input type="text" name="usuarioLogista" id="usuarioLogista" class="form-control" style="background-color: #6959CD; color: #fff" />
					<br />
					<label>Nome Fantasia</label>
					<input type="text" name="nomeLogista" id="nomeLogista" class="form-control" />
					<br />
          <label>Razão Social</label>
					<input type="text" name="razaosocialLogista" id="razaosocialLogista" class="form-control" />
					<br />
					<label>CNPJ</label>
					<input type="text" name="cnpjLogista" id="cnpjLogista" class="form-control cnpj" />
          <br />
          <label>Responsável</label>
					<input type="text" name="responsavelLogista" id="responsavelLogista" class="form-control" />
          <br />
          <label>CPF Responsável</label>
					<input type="text" name="cpfresponsavelLogista" id="cpfresponsavelLogista" class="form-control cpf" />
          <br />
					<label>Endereço</label>
					<input type="text" name="enderecoLogista" id="enderecoLogista" class="form-control"/>
					<br />
          <label>Telefone</label>
					<input type="text" name="telefoneLogista" id="telefoneLogista" class="form-control telefonevarios"/>
					<br />
          <label>Email</label>
					<input type="email" name="emailLogista" id="emailLogista" class="form-control"/>
					<br />
          <label>status</label>
					<select id="statusLogista" name="statusLogista" class="form-select">
								<option selected>Selecione</option>
								<option value="ativo">ativo</option>
								<option value="bloqueado">bloqueado</option>
								
								
								</select>
					<br />
         
          <label>Desconto Logista</label>
          <input type="number" step="0.01" class="form-control" id="descontologista" name="descontologista" required>
          <br />
					<label>Escolha Sua Foto</label>
					<input type="file" name="imagem_usuario" id="imagem_usuario" />
					<span id="user_uploaded_image"></span>
				</div>
				
					<input type="hidden" name="usuario_id" id="usuario_id" />
					<input type="hidden" name="operacao" id="operacao" />
					
					
				
			</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Fechar</button>
        <input type="submit" name="action" id="action" class="btn btn-success btn-sm" value="Add" />
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
<script src="funcoesCadLoja/funcaoMestra.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(".celular").mask("(00) 00000-0000");
	$(".telefone").mask("(00) 0000-0000");
  $(".telefonevarios").mask("(00) 0000-0000 / (00) 0000-0000 / (00) 0000-0000 / (00) 0000-0000 / (00) 0000-0000 / (00) 0000-0000");
	$(".cpf").mask("000.000.000-00");
  $(".cnpj").mask("000.000.000/0000-00");
	$(".cep").mask("00000-000");

	$(".mascaracep").mask("00000-000");
    </script>

