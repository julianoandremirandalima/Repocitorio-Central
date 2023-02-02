<?php
include("header.php");
$cor = "info";

//variaveis======================
$btalterar = $_REQUEST["btalterar"];
$data = $_REQUEST["data"];
$unidaderequisitante = $_REQUEST["unidaderequisitante"];
$protuariorequisitante = $_REQUEST["protuariorequisitante"];
$datanascimento = $_REQUEST["datanascimento"];
$requisitado = $_REQUEST["requisitado"];
$prontuariorequisitado = $_REQUEST["prontuariorequisitado"];
$nomepaciente = $_REQUEST["nomepaciente"];
$obs = $_REQUEST["obs"];
$planoterapeutico = $_REQUEST["planoterapeutico"];
$quadrante = $_REQUEST["quadrante"];
$local = $_REQUEST["local"];
$status = $_REQUEST["status"];
$id = $_REQUEST["id"];

//alterar============================
if($btalterar=="ALTERAR")
{
      
        //$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE matriciamento  set data = ?, unidaderequisitante = ?, protuariorequisitante = ?, datanascimento = ?, requisitado = ?, prontuariorequisitado = ?, nomepaciente = ?, obs = ?, planoterapeutico = ?, quadrante = ?, local = ?, status = ?  WHERE id = '$id'";
       
		$q = $con->prepare($sql);
        $q->execute(array($data, $unidaderequisitante, $protuariorequisitante, $datanascimento, $requisitado, $prontuariorequisitado, $nomepaciente, $obs, $planoterapeutico, $quadrante, $local, $status));
        
}

//ADICIONAR============================
$btadicionar = $_REQUEST["btadicionar"];
if($btadicionar=="ADICIONAR")
{
      $senha = md5(123456);
        //$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO matriciamento (data, unidaderequisitante, protuariorequisitante, datanascimento, requisitado, prontuariorequisitado, nomepaciente , obs, planoterapeutico, quadrante, local, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $con->prepare($sql);
        $q->execute(array($data, $unidaderequisitante, $protuariorequisitante, $datanascimento, $requisitado, $prontuariorequisitado, $nomepaciente, $obs, $planoterapeutico, $quadrante, $local,"NOVO"));
        
}

//DELETAR============================
$btdeletar = $_REQUEST["btdeletar"];
if($btdeletar=="DELETAR")
{
      
        //$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM usuario WHERE idusuario = '$id'";
        $q = $con->prepare($sql);
        $q->execute();
        
}


?>
<link rel="stylesheet" href="LOAD_INDEX/css/style.css" media="screen"/>
	<script src="LOAD_INDEX/js/jquery-2.1.3.js"></script>
<!-- End Header -->
<script type="text/javascript">
		// Este evendo � acionado ap�s o carregamento da p�gina
		jQuery(window).load(function() {
			//Ap�s a leitura da pagina o evento fadeOut do loader � acionado, esta com delay para ser perceptivo em ambiente fora do servidor.
			jQuery("#loader").delay(000).fadeOut("slow");
		});
	</script>
  <!-- ======= hero Section ======= -->
  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <!-- End About Section -->

    <!-- ======= Services Section ======= -->
	
    <section id="services">
      <div class="container" style="margin-top:100px">
        <div class="section-header">
		
		
          
        </div>

        <div class="row gy-4">

          <div class="col-lg-12">
            <div class="box">
            
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title">MATRICIAMENTO FINALIZADO</h4>
              <p class="description">LISTAGEM COMPLETA.</p>
              <hr>
			
			  <p id="success"></p>
              <div class="table-responsive">
              
			  <div align="left"><a href="principal.php"><button type="button" class="btn btn-secondary btn-sm">
				<i class="bi bi-arrow-left-circle"></i> voltar
				</button></a>
				
				 <?php include("matriciamento-menu.html");?>
				 <br><br>
       
  			 	
			<br><div id="loader"></div>
             
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead style="background-color:#006633;color:#FFFFFF">
                                                        <tr>
                                                            <th width="2%">#</th>
                                                            <th width="4%">DATA</th>
                                                            <th width="11%">UNIDADE<br /> 
                                                            REQUISITANTE</th>
                                                            <th width="11%">PRONTU&Aacute;RIO <br />
                                                            REQUISITANTE</th>
															<th width="10%">DATA <br />
														    NASCIMENTO</th>
															<th width="11%">REQUISITADO</th>
															<th width="11%">PRONTU&Aacute;RIO <br />
														    REQUISITADO</th>
															<th width="8%">NOME <br />
														    PACIENTE</th>
															<th width="3%">OBS</th>
															<th width="11%">PLANO <br />
														    TERAPEUTICO</th>
															<th width="5%">LOCAL</th>
															<th width="7%">STATUS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?php
													   if($tipologado=='administrador')
													   {
													   		$tabela = "viewmatriciamentolocais";
															$query = "SELECT * FROM $tabela WHERE status = 'FINALIZADO'";
													   }
													   else
													   {
													   	    $tabela = "viewmatriciamentoequipes";
															$query = "SELECT * FROM $tabela WHERE status = 'FINALIZADO' AND idprofissional = '$usuariologado'";
													   }
													   $select = $con->prepare($query);
													  // print_r($query);
														$select->execute();
														while($array = $select->fetch())
														{
														$status = $array["status"];
														
															
														
													   ?>
                                                        <tr class="table-success">
                                                            <th scope="row"><?=$array["id"]?>                                                           														</th>
                                                            <td><?=$array["data"]?></td>
                                                            <td><?=$array["unidaderequisitante"]?></td>
															 <td><?=$array["protuariorequisitante"]?></td>
															  <td><?=$array["datanascimento"]?></td>
															  
															    <td><?=$array["requisitado"]?></td>
																 <td><?=$array["prontuariorequisitado"]?></td>
																  <td><?=$array["nomepaciente"]?></td>
																   <td><?=$array["obs"]?></td>
																    <td><?=$array["planoterapeutico"]?></td>
																	 <td><?=$array["nomelocal"]?></td>
																	 <td><?=$array["status"]?></td>
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

      </div>
    </section>


   







  </main><!-- End #main -->
  
  

  <!-- ======= Footer ======= -->
  <?php
  include("footer.php");
  ?>
  
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
	<style type="text/css" class="init">
	
	</style>
	<script type="text/javascript" src="/media/js/site.js?_=1d5abd169416a09a2b389885211721dd" data-domain="datatables.net" data-api="https://plausible.sprymedia.co.uk/api/event"></script>
	<script src="https://media.ethicalads.io/media/client/ethicalads.min.js"></script>
	<script type="text/javascript" src="/media/js/dynamic.php?comments-page=extensions%2Fbuttons%2Fexamples%2Finitialisation%2Fsimple.html" async></script>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
	
	<script type="text/javascript" class="init">
	


$(document).ready(function() {
	$('#example').DataTable( {
	dom: 'Bfrtip',
		buttons: [
			'copy', 'excel', 'pdf', 'print'
		]
	} );
} );



	</script>

