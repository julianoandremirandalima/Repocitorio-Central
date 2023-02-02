<?php
include("header.php");
$id = $_REQUEST["id"];
$idlocal = $_REQUEST["idlocal"];


  if($tipologado=='administrador')
 {
	$tabela = "viewmatriciamentolocais";
	$query = "SELECT * FROM $tabela WHERE id = '$id'";
 }
 else
{
    $tabela = "viewmatriciamentoequipes";
	$query = "SELECT * FROM $tabela WHERE id = '$id'";
}
   $select = $con->prepare($query);
   
	$select->execute();
	$array = $select->fetch();
$pagina = $_REQUEST["pagina"]."?idlocal=$idlocal";	

?>

 <script type="text/javascript">

function confirmar() {

    if (confirm("Deseja confirmar?")) {

        return true;

    } else {

        return false;

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
      <div class="container" style="margin-top:100px">
        <div class="section-header">
		
		
          
        </div>

        <div class="row gy-4">

          <div class="col-lg-12">
            <div class="box">
            
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title">MATRICIAMENTO <?=$array["id"]?></h4>
              <p class="description">EDITANDO MATRICIAMENTO.</p>
              <hr>
			
			  <p id="success"></p>
              <div class="table-responsive">
              
			  <div align="left"><a href="<?=$pagina?>"><button type="button" class="btn btn-secondary btn-sm">
				<i class="bi bi-arrow-left-circle"></i> voltar
				</button></a>
				
				 
				 <br><br>
        	
			<br>
           
                                            <div class="card-block">
                                                          
                                                             <form action="<?=$pagina?>" method="post">
  <div class="row">
    <div class="form-group col-sm-4">
      <label for="inputEmail4">DATA</label>
      <input type="date" class="form-control" id="data"  name="data" value="<?=$array["data"]?>">
    </div>
    <div class="form-group col-sm-4">
      <label for="inputPassword4">UNIDADE REQUISITANTE</label>
      <input type="text" class="form-control" id="unidaderequisitante" name="unidaderequisitante" value="<?=$array["unidaderequisitante"]?>">
    </div>
	
	 <div class="form-group col-sm-4">
      <label for="inputPassword4">PRONTU&Aacute;RIO REQUISITANTE</label>
      <input type="text" class="form-control" id="protuariorequisitante" name="protuariorequisitante" value="<?=$array["protuariorequisitante"]?>">
    </div>
	
	 <div class="form-group col-sm-4">
      <label for="inputPassword4">DATA NASCIMENTO</label>
      <input type="date" class="form-control" id="datanascimento" name="datanascimento" value="<?=$array["datanascimento"]?>">
    </div>
	
	<div class="form-group col-sm-4">
      <label for="inputPassword4">REQUISITADO</label>
      <input type="text" class="form-control" id="requisitado" name="requisitado" value="<?=$array["requisitado"]?>">
    </div>
	
	<div class="form-group col-sm-4">
      <label for="inputPassword4">PRONTU&Aacute;RIO REQUISITADO</label>
      <input type="text" class="form-control" id="prontuariorequisitado" name="prontuariorequisitado" value="<?=$array["prontuariorequisitado"]?>">
    </div>
	
	<div class="form-group col-sm-4">
      <label for="inputPassword4">NOME PACIENTE</label>
      <input type="text" class="form-control" id="nomepaciente" name="nomepaciente" value="<?=$array["nomepaciente"]?>">
    </div>
	
 
  <div class="form-group col-sm-4">
    <label for="inputAddress">OBS</label>
    <input type="text" class="form-control" id="obs" name="obs" value="<?=$array["obs"]?>">
   </div>
  <div class="form-group col-sm-4">
    <label for="inputAddress2">PLANO TERAP&Ecirc;UTICO </label>
    <textarea name="planoterapeutico" class="form-control"><?=$array["planoterapeutico"]?></textarea>
  </div>
 
   
    
    
	 <div class="form-group col-sm-4">
      <label for="inputState">LOCAL</label>
       <select name="local" class="form-control">
                                                                                <option value="<?=$array["idlocal"]?>" selected="selected"><?=$array["nomelocal"]?></option>
                                                                                <?php
                                                                                     if($tipologado=='administrador')
													   							{
																					$querylocal = "SELECT * FROM local ORDER BY nomelocal";
																				}
																				else
																				{
																					$querylocal = "SELECT * FROM viewequivelocal WHERE idprofissional = '$usuariologado' ORDER BY nomelocal";
																				}
                                                                                    $select2 = $con->prepare($querylocal);
                                                                                    $select2->execute();
                                                                                    while($array2 = $select2->fetch())
                                                                                    {
                                                                                ?>
                                                                                         <option value="<?=$array2['idlocal']?>"><?=$array2['nomelocal']?></option>
                                                                                <?php
                                                                                    }
                                                                                 ?>
                      </select>
    </div>
	
	 <div class="form-group col-sm-4">
      <label for="inputState">STATUS</label>
       <select name="status" class="form-control" required> 
                                                                                <option value="" selected="selected"></option>
                                                                                <option value="EM ANDAMENTO">EM ANDAMENTO</option>
                                                                                <option value="FINALIZADO">FINALIZADO</option>
                                                                                
                      </select>
    </div>
	
	<div class="form-group col-sm-4">
   <input type="hidden"  name="id" value="<?=$array["id"]?>"><br>
  <div> 
  <button type="submit" class="btn btn-primary" name="btalterar" value="ALTERAR" style="display:<?=$escondebt?>">ALTERAR</button>
  </div>
	
	<br/>
	<br/><br/><br/><br/><br/><br/>
	
</form>
                                                                        
                                                
                                                                        
                                                                        
                                                                   
                                                               
			  
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

