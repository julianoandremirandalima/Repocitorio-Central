<?php
error_reporting(E_ERROR | E_PARSE);
include("conexao.php");
$idtitular = $_REQUEST["idtitular"];

$nomeservidor = $_REQUEST["nome"];


//variaveis======================
$btalterar = $_REQUEST["btalterar"];
$nome = $_REQUEST["nome"];
$email = $_REQUEST["email"];
$contato = $_REQUEST["contato"];
$tipo = $_REQUEST["tipo"];
$quadrante = $_REQUEST["quadrante"];
$local = $_REQUEST["local"];
$id = $_REQUEST["id"];
$contratoi = $_REQUEST["contratoi"];
$contratof = $_REQUEST["contratof"];
$datahoje =  date("Y-m-d");

//alterar============================
if($btalterar=="sim")
{

$delete = $con->prepare("DELETE FROM equipes WHERE idprofissional = '$id'");
$delete->execute();
      //Declaramos a variável que vai receber o conteúdo da lista
$locais = null;

//Verificamos se o índice existe

    //Atribuimos a variável todo conteúdo do índice
    $locais = $_POST['local'];

//Verificamos se a variável não é nula

if ($_POST && isset($_POST['local'])){
  $ativo = $_POST['local'];
 
  foreach($ativo as $valor){
  
	
	$sql = "INSERT INTO equipes (localequipe, idprofissional) VALUES (?, ?)";
        $q = $con->prepare($sql);
        $q->execute(array($valor, $id));
  }
}	
    //Percorremos todos os conteúdos do array
   


/**
 * Recebe um parâmetro e exibe o seu conteúdo
 *
 * @param  mixed $param
 * @return void
 */

	  
	  
	  
       
}






//SELECT GERAL=======================================
$select = $con->prepare("SELECT * FROM usuarios WHERE id = '$idtitular'");
$select->execute();
$array = $select->fetch();





?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

 <title>SISTEC SEMUS VARGINHA - MATRICIAMENTO </title>
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
              <h4 class="title"><?=$nomeservidor?> </h4>
			  <div align="right"><button class="btn btn-danger" onclick="return closeWindow();">
       fechar
    </button>
      
    <script type="text/javascript">
        function closeWindow() {
  
            // Open the new window 
            // with the URL replacing the
            // current page using the
            // _self value
            let new_window =
                open(location, '_self');
  
            // Close this window
            new_window.close();
  
            return false;
        }
    </script></div>
             
			  <p id="success"></p>
              <div class="table-responsive">
              
			
				
				
        </div>
			<br>
              <div class="table-responsive">
                                               <table id="exampleDESLIGADO" class="display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>LOCAIS ATRIBUÍDOS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       
                                                        <tr>
                                                            <td>
                                                              <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
															  <?php
															  	$selectlocal = $con->prepare("SELECT * FROM local ORDER BY nomelocal");
                                                                $selectlocal->execute();
                                                                while($arraylocal = $selectlocal->fetch())
                                                                {
																	$localbd = $arraylocal['idlocal'];
																	$selectequipes = $con->prepare("SELECT * FROM equipes WHERE idprofissional = '$idtitular' AND localequipe = '$localbd'");
																	$selectequipes->execute();
																	$arrayequioeslocal = $selectequipes->fetch();
																	$localequipes = $arrayequioeslocal["localequipe"];
																	
																	if($localbd==$localequipes)
																	{
																		$checado = "checked";
																	}
																	else
																	{
																		$checado = "";
																	}
															  ?>
                                                               <input type="checkbox" id="local" name="local[]" value="<?=$arraylocal["idlocal"]?>" <?=$checado?>>
																<label for="<?=strtoupper($arraylocal["nomelocal"])?>"><?=strtoupper($arraylocal["nomelocal"])?></label>
																<br>
																 <?php
															  	}
															  ?>
																
                                                            <p align="right">
                                                              <label>
                                                              <input type="submit" name="Submit" value="ALTERAR" class="form-control btn btn-primary" />
															  <input name="btalterar" type="hidden" value="sim" />
															  <input name="id" type="hidden" value="<?=$idtitular?>" />
                                                              </label>
                                                            </p>
                                                              </form></td>
                                                        </tr>
														
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
