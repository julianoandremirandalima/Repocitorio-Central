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
      <div class="container">
        <div class="section-header">
          
        </div>

        <div class="row gy-4">

          <div class="col-lg-12">
            <div class="box">
            
              <div class="icon"><i class="bi bi-people"></i></div>
              <h4 class="title">CADASTRO SERVIDORES</h4>
              <p class="description">Lista dos Servidores cadastrados no sistema.</p>
              <hr>
			  <p id="success"></p>
              <div class="table-responsive">
              
			  <div align="left"><a href="principal.php"><button type="button" class="btn btn-secondary btn-sm">
				<i class="bi bi-arrow-left-circle"></i> voltar
				</button></a></div>
				
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
              <table id="myTable" class="table table-success table-striped">
        <thead>
        <tr>
						<th width="5%">
							<span class="custom-checkbox">
								<input style="font-size: 12px;" type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th width="5%">N°</th>
                        <th width="30%">NOME</th>
                        <th width="10%">MATRÍCULA</th>
						<th width="20%">LOCAL</th>
                        <th width="15%">SETOR</th>
                        <th width="5%" align="center"> EDITAR</th>
						<th width="5%" align="center"> DEPENDENTES</th>
						<th width="5%" align="center"> RESUMO</th>
                    </tr>
        </thead>
        <tbody>
				
				<?php
                include("conexao.php");
                $result = $con->prepare("SELECT * FROM colaboradores");
                $result->execute();
					$i=1;
					while($row = $result->fetch()) {
						$idbdx = $row["id"];
				?>
				<tr id="<?php echo $row["id"]; ?>">
				<td>
							<span class="custom-checkbox">
								<input style="font-size: 12px;" type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id"]; ?>">
								<label for="checkbox2"></label>
							</span>
						</td>
					<td><?php echo $i; ?></td>
					<td><?php echo $row["nome"]; ?></td>
					<td><?php echo $row["matricula"]; ?></td>
					<td><?php echo $row["local"]; ?></td>
					<td><?php echo $row["setor"]; ?></td>
					<td align="center">
					<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editEmployeeModal">
						
						<i class="bi bi-pen update" data-toggle="tooltip" 
							data-id="<?php echo $row["id"]; ?>"
							data-nome="<?php echo $row["nome"]; ?>"
							data-matricula="<?php echo $row["matricula"]; ?>"
							data-local="<?php echo $row["local"]; ?>"
							data-setor="<?php echo $row["setor"]; ?>"
							data-data="<?php echo $row["data_nascimento"]; ?>"
							data-estadocivil="<?php echo $row["estado_civil"]; ?>"
							data-sexo="<?php echo $row["sexo"]; ?>"
							data-escolaridade="<?php echo $row["escolaridade"]; ?>"
							data-rg="<?php echo $row["rg"]; ?>"
							data-cpf="<?php echo $row["cpf"]; ?>"
							data-endereco="<?php echo $row["endereco"]; ?>"
							data-numero="<?php echo $row["numero"]; ?>"
							data-bairro="<?php echo $row["bairro"]; ?>"
							data-cidade="<?php echo $row["cidade"]; ?>"
							data-cep="<?php echo $row["cep"]; ?>"
							data-funcao="<?php echo $row["funcao"]; ?>"
							data-tipo="<?php echo $row["tipo"]; ?>"
							data-data1="<?php echo $row["data1"]; ?>"
							data-data2="<?php echo $row["data2"]; ?>"
							data-telefone="<?php echo $row["telefone"]; ?>"
							data-celular="<?php echo $row["celular"]; ?>"
							data-wattsap="<?php echo $row["wattsap"]; ?>"
							data-email="<?php echo $row["email"]; ?>"
							data-limite="<?php echo $row["limite"]; ?>"
							title="Editar">
						</i>
					</button>	
		            </td>

					<td align="center">
					<button type="button" class="btn btn-info btn-sm"  onclick="javascript:abrirJanela('detalhe.php?idtitular=<?=$row["id"]?>&nome=<?=$row["nome"]?>', 1024, 700);">
					<script type="text/javascript">
						
						function abrirJanela(pagina, largura, altura) {
						// Definindo centro da tela
						var esquerda = (screen.width - largura)/2;
						var topo = (screen.height - altura)/2;
						// Abre a nova janela
						minhaJanela = window.open(pagina,'','height=' + altura + ', width=' + largura + ', top=' + topo + ', left=' + esquerda);
						}
						
						</script>
						
						<i class="bi bi-person-plus dependente" data-toggle="tooltip" 
							
							title="Dependentes">
						</i>
					</button>	
		            </td>






					<td align="center">
					<a href="#" onclick="javascript:abrirJanela('resumo.php?idtitular=<?=$row["id"]?>&nome=<?=$row["nome"]?>', 1024, 700);"><button type="button" name="baixar" class="btn btn-warning btn-sm baixar"><i class="bi bi-eye"></i></button></a>
					
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
<div id="addEmployeeModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" style="font-size: 10px;">
				<form id="user_form">
					<div class="modal-header" style="background-color: #066; color:#fff">						
						<h4 class="modal-title">ADICIONAR</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">					
						
					
						<div class="row">
							<div class="form-group col-md-12">
							<label>NOME</label>
											
								<input style="font-size: 12px;" type="text" name="nome" class="form-control" id="nome"  >
							</div>
							
						</div>


						<div class="row">
						<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>MATRÍCULA</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="matricula" id="matricula"  >
							</div>

							<div class="form-group col-md-4">
							<label>DATA NASCIMENTO</label>
											
								<input style="font-size: 12px;" type="date" name="data" class="form-control" id="data"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>ESTADO CIVIL</label>
											
							<select style="font-size: 12px;" id="estadocivil" name="estadocivil" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="CASADO">CASADO</option>
								<option value="SOLTEIRO">SOLTEIRO</option>
								
								</select>

							</div>
						</div>


						<div class="row">
							<div class="form-group col-md-6">
							<label>SEXO</label>
							<select style="font-size: 12px;" id="sexo" name="sexo" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="CASADO">MASCULINO</option>
								<option value="SOLTEIRO">FEMININO</option>
								
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
											
								<input style="font-size: 12px;" type="text" name="endereco" class="form-control" id="endereco"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>NÚMERO</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="numero" id="numero"  >
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-4">
							<label>BAIRRO</label>
											
								<input style="font-size: 12px;" type="text" name="bairro" class="form-control" id="bairro"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>CIDADE</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="cidade" id="cidade"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>CEP</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="cep" id="cep"  >
							</div>
						</div>


						<div class="row">
							<div class="form-group col-md-4">
								<label>LOCAL</label>
							<select style="font-size: 12px;" id="local" name="local" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
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
											
								<input style="font-size: 12px;" type="number" step="any" min="0" lang="en" name="limite" class="form-control" id="limite" style="background-color: #066; color: #fff">
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
						<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>MATRÍCULA</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="matricula" id="matricula_u"  >
							</div>

							<div class="form-group col-md-4">
							<label>DATA NASCIMENTO</label>
											
								<input style="font-size: 12px;" type="date" name="data" class="form-control" id="data_u"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>ESTADO CIVIL</label>
											
							<select style="font-size: 12px;" id="estadocivil_u" name="estadocivil" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="CASADO">CASADO</option>
								<option value="SOLTEIRO">SOLTEIRO</option>
								
								</select>

							</div>
						</div>


						<div class="row">
							<div class="form-group col-md-6">
							<label>SEXO</label>
							<select style="font-size: 12px;" id="sexo_u" name="sexo" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="MASCULINO">MASCULINO</option>
								<option value="FEMININO">FEMININO</option>
								
								</select>

								
							</div>
							<div class="form-group col-md-6 mt-3 mt-md-0">
							<label>ESCOLARIDADE</label>
											
							<select style="font-size: 12px;" id="escolaridade_u" name="escolaridade" class="form-select" aria-label="Default select example" >
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
											
								<input style="font-size: 12px;" type="text" name="rg" class="form-control" id="rg_u"  >
							</div>
							<div class="form-group col-md-6 mt-3 mt-md-0">
							<label>CPF</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="cpf" id="cpf_u"  >
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-8">
							<label>ENDEREÇO</label>
											
								<input style="font-size: 12px;" type="text" name="endereco" class="form-control" id="endereco_u"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>NÚMERO</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="numero" id="numero_u"  >
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-4">
							<label>BAIRRO</label>
											
								<input style="font-size: 12px;" type="text" name="bairro" class="form-control" id="bairro_u"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>CIDADE</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="cidade" id="cidade_u"  >
							</div>
							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>CEP</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="cep" id="cep_u"  >
							</div>
						</div>


						<div class="row">
							<div class="form-group col-md-4">
								<label>LOCAL</label>
							<select style="font-size: 12px;" id="local_u" name="local" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
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
											
								<input style="font-size: 12px;" type="text" name="setor" class="form-control" id="setor_u"  >
							</div>

							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>FUNÇÃO</label>
											
								<input style="font-size: 12px;" type="text" name="funcao" class="form-control" id="funcao_u"  >
							</div>


						</div>

						<div class="row">
							<div class="form-group col-md-3">
							<label>TELEFONE</label>
											
								<input style="font-size: 12px;" type="text" name="telefone" class="form-control" id="telefone_u"  >
							</div>
							<div class="form-group col-md-3 mt-3 mt-md-0">
							<label>CELULAR</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="celular" id="celular_u"  >
							</div>
							<div class="form-group col-md-3 mt-3 mt-md-0">
							<label>WATTSAP</label>
											
								<input style="font-size: 12px;" type="text" class="form-control" name="wattsap" id="wattsap_u"  >
							</div>
							<div class="form-group col-md-3 mt-3 mt-md-0">
							<label>EMAIL</label>
											
								<input style="font-size: 12px;" type="email" class="form-control" name="email" id="email_u"  >
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-4">
								<label>TIPO</label>
							<select style="font-size: 12px;" id="tipo_u" name="tipo" class="form-select" aria-label="Default select example" >
								<option selected>Selecione</option>
								<option value="CONTRATADO">CONTRATADO</option>
								<option value="EFETIVO">EFETIVO</option>
								
								</select>
											
							</div>

							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>DATA ADMISSÃO</label>
											
								<input style="font-size: 12px;" type="date" name="data1" class="form-control" id="data1_u"  >
							</div>

							<div class="form-group col-md-4 mt-3 mt-md-0">
							<label>DATA FIM (Somente para contrato)</label>
											
								<input style="font-size: 12px;" type="date" name="data2" class="form-control" id="data2_u"  >
							</div>

							<div class="form-group col-md-3 mt-3 mt-md-0">
							<label>LIMITE DO CARTÃO (R$)</label>
											
								<input style="font-size: 12px;" type="number" step="any" min="0" lang="en"  name="limite" class="form-control" id="limite_u" style="background-color: #066; color: #fff">
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

<script src="funcoesCadServ/ajax.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
    $("#celular, #telefone_u, #celular_u, #wattsap, #wattsap_u").mask("(00) 00000-0000");
	$("#telefone").mask("(00) 0000-0000");
	$("#cpf, #cpf_u").mask("000.000.000-00");
	$("#cep, #cep_u").mask("00000-000");

	$(".mascaracep").mask("00000-000");
    </script>
