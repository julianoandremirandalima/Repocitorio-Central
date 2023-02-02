<?php
include("header.php");
?>
<!-- End Header -->

  <!-- ======= hero Section ======= -->
  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          
        </div>

        <div class="row gy-4">

          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
            
              <div class="icon"><i class="bi bi-person-badge"></i></div>
              <h4 class="title">CADASTRO DE USUÁRIO DO SISTEMA</h4>
              <p class="description">Lista dos usuários cadastrados no sistema.</p>
              <hr>
              <div class="table-responsive">
              <div align="left"><a href="principal.php"><button type="button" class="btn btn-secondary btn-sm">
				<i class="bi bi-arrow-left-circle"></i> voltar
				</button></a></div>
			
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-bs-target="#userModal" class="btn btn-success btn-sm">Adicionar <i class="bi bi-person-plus-fill"></i></button>
				
        </div>
			<br>
              <table id="user_data" class="table table-success table-striped">
        <thead>
            <tr>
                <th width="15%">Foto</th>
                <th width="30%">Nome</th>
                <th width="20%">Usuário</th>
                <th width="20%">Tipo</th>
                <th width="5%">Editar</th>
                <th width="5%"> Locais </th>
                <th width="5%">Excluir</th>
            </tr>
        </thead>
        
        <tfoot>
            <tr>
            <th>Foto</th>
							<th>Nome</th>
							<th>Usuário</th>
              <th>Tipo</th>
							<th>Editar</th>
					<th>Locais </th>
							<th>Delete</th>
            </tr>
        </tfoot>
    </table>
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
					<label>Nome Completo</label>
					<input type="text" name="nome" id="nome" class="form-control" required/>
					<br />
					<label>Usuário - E-mail</label>
					<input type="text" name="usuario" id="usuario" class="form-control" required/>
          <br />
					
					<label>Tipo</label>
					<select name="tipo" size="1" id="tipo" name="tipo" class="form-control" required>
					  <option value="" selected="selected">Selecione</option>
					  <option value="administrador">administrador</option>
					  <option value="colaborador">colaborador</option>
					  <option value="gestor">gestor</option>
				    </select>
					
				  <br />
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
<script src="funcoesCadUser/funcaoMestra.js"></script>
<script type="text/javascript">
						
						function abrirJanela(pagina, largura, altura) {
						// Definindo centro da tela
						var esquerda = (screen.width - largura)/2;
						var topo = (screen.height - altura)/2;
						// Abre a nova janela
						minhaJanela = window.open(pagina,'','height=' + altura + ', width=' + largura + ', top=' + topo + ', left=' + esquerda);
						}
						
						</script>
