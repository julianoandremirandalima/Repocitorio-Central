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
              <h4 class="title">CADASTRO DE COLABORADORES NO SISTEMA</h4>
              <p class="description">Lista dos servidores cadastrados no sistema.</p>
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
            <th>Foto</th>
							<th>Nome</th>
							<th>Matricula</th>
              <th>Local</th>
              <th>Setor</th>
			  <th>Contrato</th>
			  <th>LGPD</th>
							<th width="5%">Editar</th>
              <th width="5%">Dep.</th>
              <th width="5%">Resumo</th>
							<th width="5%">Delete</th>
                
            </tr>
        </thead>
        
        <tfoot>
            <tr>
            <th>Foto</th>
							<th>Nome</th>
							<th>Matricula</th>
              <th>Local</th>
              <th>Setor</th>
			  <th>Contrato</th>
			  <th>LGPD</th>
							<th>Editar</th>
              <th>Dep.</th>
              <th width="5%">Resumo</th>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="user_form" enctype="multipart/form-data">
      <div class="modal-body">
      
			<div class="row">
							<div class="form-group col-md-12">
							<label>NOME</label>
											
								<input style="font-size: 12px;" type="text" name="nome" class="form-control" id="nome">
							</div>
							
						</div>


						<div class="row">
						<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>MATRÍCULA</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="matricula" id="matricula"  >
							</div>

							<div class="form-group col-md-4">
							<label>DATA NASCIMENTO</label>
											
								<input style="font-size: 12px;" type="date" name="data_nascimento" class="form-control" id="data_nascimento"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>ESTADO CIVIL</label>
											
							<select style="font-size: 12px;" id="estado_civil" name="estado_civil" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="CASADO">CASADO</option>
								<option value="SOLTEIRO">SOLTEIRO</option>
								<option value="SOLTEIRO">DIVORCIADO</option>
								
								</select>

							</div>
						</div>


						<div class="row">
							<div class="form-group col-md-6">
							<label>SEXO</label>
							<select style="font-size: 12px;" id="sexo" name="sexo" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="MASCULINO">MASCULINO</option>
								<option value="FEMININO">FEMININO</option>
								
								</select>

								
							</div>
							<div class="form-group col-md-6 mt-3 mt-md-0">
							<label>ESCOLARIDADE</label>
											
							<select style="font-size: 12px;" id="escolaridade" name="escolaridade" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="ENSINO FUNDAMENTAL INCOMPLETO">ENSINO FUNDAMENTAL INCOMPLETO</option>
								<option value="ENSINO FUNDAMENTAL COMPLETO">ENSINO FUNDAMENTAL COMPLETO</option>
								<option value="ENSINO MÉDIO INCOMPLETO">ENSINO MÉDIO INCOMPLETO</option>
								<option value="ENSINO MÉDIO COMPLETO">ENSINO MÉDIO COMPLETO</option>
								<option value="ENSINO SUPERIOR INCOMPLETO">ENSINO SUPERIOR INCOMPLETO</option>
								<option value="ENSINO SUPERIOR COMPLETO">ENSINO SUPERIOR COMPLETO</option>
								
								</select>

							</div>
						</div>


						<div class="row">
							<div class="form-group col-md-6">
							<label>RG</label>
											
								<input style="font-size: 12px;" type="text" name="rg" class="form-control" id="rg"  >
							</div>
							<div class="form-group col-md-6 mt-3 mt-md-0">
							<label>CPF</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="cpf" id="cpf"  >
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-8">
							<label>ENDEREÇO</label>
											
								<input style="font-size: 12px;" type="text" name="endereco" class="form-control" id="enderecox"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>NÚMERO</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="numero" id="numerox"  >
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-4">
							<label>BAIRRO</label>
											
								<input style="font-size: 12px;" type="text" name="bairro" class="form-control" id="bairrox"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>CIDADE</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="cidade" id="cidade"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>CEP</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="cep" id="cepx"  >
							</div>
						</div>


						<div class="row">
							<div class="form-group col-md-4">
								<label>LOCAL</label>
							<select style="font-size: 12px;" id="local" name="local" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<?php
									$selectlocais = $con->prepare("SELECT DISTINCT(local) AS locaisbd FROM colaboradores ORDER BY local");
									$selectlocais->execute();
									while($linhalocal = $selectlocais->fetch())
									{
								?>
								<option value="<?=$linhalocal["locaisbd"]?>"><?=$linhalocal["locaisbd"]?></option>
								<?php
									}
								?>

								<option value="Prefeitura Municipal">Prefeitura Municipal</option>
								<option value="Câmara Municipal">Câmara Municipal</option>
								<option value="Guarda Municipal">Guarda Municipal</option>
								<option value="Fundação Cultural">Fundação Cultural</option>
								<option value="Fhomuv">Fhomuv</option>
								<option value="SEMUL">SEMUL</option>
								<option value="INPREV">INPREV</option>
								</select>
											
							</div>

							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>SETOR</label>
											
								<input style="font-size: 12px;" type="text" name="setor" class="form-control" id="setor"  >
							</div>

							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>FUNÇÃO</label>
											
								<input style="font-size: 12px;" type="text" name="funcao" class="form-control" id="funcao"  >
							</div>


						</div>

						<div class="row">
							<div class="form-group col-md-3">
							<label>TELEFONE</label>
											
								<input style="font-size: 12px;" type="text" name="telefone" class="form-control" id="telefone"  >
							</div>
							<div class="form-group col-md-3 mt-3 mt-md-0">
							<label>CELULAR</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="celular" id="celular"  >
							</div>
							<div class="form-group col-md-3 mt-3 mt-md-0">
							<label>WATTSAP</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="wattsap" id="wattsap"  >
							</div>
							<div class="form-group col-md-3 mt-3 mt-md-0">
							<label>EMAIL</label>
											
								<input style="font-size: 12px;" type="email" class="form-control" name="email" id="email"  >
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-4">
								<label>TIPO</label>
							<select style="font-size: 12px;" id="tipo" name="tipo" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="CONTRATADO">CONTRATADO</option>
								<option value="EFETIVO">EFETIVO</option>
								
								</select>
											
							</div>

							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>DATA ADMISSÃO</label>
											
								<input style="font-size: 12px;" type="date" name="data1" class="form-control" id="data1"  >
							</div>

							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>DATA FIM (Somente para contrato)</label>
											
								<input style="font-size: 12px;" type="date" name="data2" class="form-control" id="data2"  >
							</div>

							<div class="form-group col-md-3 mt-3 mt-md-0">
							<label>LIMITE DO CARTÃO (R$)</label>
											
								<input style="font-size: 12px;" type="number" step="any" min="0"  name="limite" class="form-control" id="limite" style="background-color: #066; color: #fff">
							</div>

      
			
				
					<br />
					<label>Escolha Sua Foto</label>
					<input type="file" name="imagem_usuario" id="imagem_usuario" />
					<span id="user_uploaded_image"></span>
				
				
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
<script src="funcoesCadServidor/funcaoMestra.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(".celular").mask("(00) 00000-0000");
	$(".telefone").mask("(00) 0000-0000");
	$(".cpf").mask("000.000.000-00");
  $(".cnpj").mask("000.000.000/0000-00");
	$(".cep").mask("00000-000");

	$(".mascaracep").mask("00000-000");
    </script>

<script type="text/javascript">
						
						function abrirJanela(pagina, largura, altura) {
						// Definindo centro da tela
						var esquerda = (screen.width - largura)/2;
						var topo = (screen.height - altura)/2;
						// Abre a nova janela
						minhaJanela = window.open(pagina,'','height=' + altura + ', width=' + largura + ', top=' + topo + ', left=' + esquerda);
						}
						
						</script>