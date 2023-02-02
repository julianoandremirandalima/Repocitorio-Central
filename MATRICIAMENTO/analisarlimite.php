<?php
include("conexao.php");
error_reporting(0);

$mesatual = date("m/Y");
$mes = date("m");
$ano = date("Y");
$idtitular = $_REQUEST["id"];

$btpagar = $_REQUEST["btpagar"];
if($btpagar=="sim")
{
	$limite = $_REQUEST["limite"];
	$valormes = $_REQUEST["valormes"];
	$totalimite = $limite + $valormes;
	
	$update = $con->prepare("UPDATE colaboradores SET limite = '$totalimite' WHERE id = '$idtitular'");
	$update->execute();
	
	$updatevendas = $con->prepare("UPDATE vendas SET statusparcela = 'pago' WHERE id_usuario = '$idtitular' AND mes_venda = '$mes' AND ano_venda = '$ano'");
	$updatevendas->execute();
}





$selectcolaborador = $con->prepare("SELECT * FROM colaboradores WHERE id = '$idtitular'");
$selectcolaborador->execute();
$arraycolaborador = $selectcolaborador->fetch();

$selectotames = $con->prepare("SELECT SUM(valorparcela) AS valortotalmes FROM vendas WHERE id_usuario = '$idtitular' AND mes_venda = '$mes' AND ano_venda = '$ano' AND statusparcela = 'aberta'");
$selectotames->execute();
$arraytotames =  $selectotames->fetch();
$total = $arraytotames["valortotalmes"];

if($total==0)
{
	$mensagem = "";
	$corvenda = "#000";
	$esconde = "none";
}
else
{
	$mensagem = "";
	$corvenda = "#fff";
	$esconde = "block";
}
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
              <h4 class="title"><?=$arraycolaborador["nome"]?></h4>
			  <form>
              <p class="description">LIMITE ATUAL: <strong>R$
<?=number_format($arraycolaborador["limite"],2,",",".")?>
              </strong>  <label style="color: <?=$corvenda?>"><?=$mensagem?></label>
              <label for="textfield" style="display: <?=$escondeX?>"> + Parcela do mês <?=$mesatual?>: R$</label> 
              
              <input name="valormes" type="text" id="textfield" size="5" value="<?=number_format($total,2,".","")?>" style="background: #DC0003; color: #FFFFFF; display: <?=$escondeX?>">
              <input type="submit" name="submit" id="submit" value="Enviar" style="display: <?=$escondeX?>">
				  <input type="hidden" name="id" value="<?=$idtitular?>">
				  <input type="hidden" name="limite" value="<?=$arraycolaborador["limite"]?>">
				  <input type="hidden" name="btpagar" value="sim">
              </p></form>
              <hr>
			  <p id="success"></p>
              <div class="table-responsive">
              
			
				
			<br>
              <table id="myTable" class="table table-striped">
        <thead>
        <tr>
						<th width="40%">NOME LOJA</th>
                        <th width="20%">CHAVE</th>
                        <th width="25%">PARCELA</th>
                        <th width="25%">VALOR DA PARCELA</th>
						<th width="25%">MÊS/ANO</th>
                        
                    </tr>
        </thead>
        <tbody>
				
				<?php
					$mesano = date("mY");
				
               
                $result = $con->prepare("SELECT * FROM visao_vendas WHERE id_usuario = '$idtitular' AND mes_venda >= '$mes' AND ano_venda >= '$ano'");
                $result->execute();
					$i=1;
					while($row = $result->fetch()) {
						$idbvenda = $row["id_venda"];
						$mesanobd = $row["mes_venda"].$row["ano_venda"];
						$status = $row["statusparcela"];
						
						if($mesanobd==$mesano AND $status=="aberta")
						{
							$cor = "#DC0003";
							$cortext = "#fff";
						}
						else if($mesanobd==$mesano AND $status=="pago")
						{
							$cor = "#32CD32";
							$cortext = "fff";
						}
						else
						{
							$cor = "";
							$cortext = "000";
						}
				?>
				<tr bgcolor="<?=$cor?>" style="color: <?=$cortext?>">
				<td><?=$row["nomeLogista"]?></td>
					<td><?=$row["chave_venda"]?></td>
					<td>Parcela <?=$row["numeroparcela"]?> de <?=$row["quantasparcelas"]?></td>
					<td align="right">R$ <?=number_format($row["valorparcela"],2,",",".")?></td>
					<td><?=$row["mes_venda"]?> / <?=$row["ano_venda"]?></td>
					
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
