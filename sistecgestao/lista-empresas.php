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
            
              <div class="icon"><i class="bi bi-shop"></i></div>
              <h4 class="title">EMPRESAS PARCEIRAS</h4>
              <p class="description">Confira abaixo a lista de Empresas que aderiram nosso sistema!</p>
              <hr>
              <div class="table-responsive">
              <div align="left"><a href="principal.php"><button type="button" class="btn btn-secondary btn-sm">
				<i class="bi bi-arrow-left-circle"></i> voltar
				</button></a></div>
			
				
			<br>
      <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
			<?php
				
				$selectempresas = $con->prepare("SELECT * FROM lojas WHERE idLogista != '6' AND statusLogista = 'ativo' ORDER BY nomeLogista");
				$selectempresas->execute();
				while($arrayloj = $selectempresas->fetch())
				{
					$imagem = $arrayloj["imagem"];
					
					if($imagem=="")
					{
						$imagem = "sem-foto.jpg";					}
			?>
			
  <div class="col">
    <div class="card">
      <img src="upload/<?=$imagem?>" class="card-img-top" alt="..." style="height: 150px">
      <div class="card-body">
        <h5 class="card-title"><?=strtoupper($arrayloj["nomeLogista"])?></h5>
        <h6 class="card-title">Endereço: <?=$arrayloj["enderecoLogista"]?></h6>
		  <h6 class="card-title">Contato: <?=$arrayloj["telefoneLogista"]?></h6>
      </div>
    </div>
  </div>
 
  <?php
				}
			?>
 
</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(".celular").mask("(00) 00000-0000");
	$(".telefone").mask("(00) 0000-0000");
	$(".cpf").mask("000.000.000-00");
  $(".cnpj").mask("000.000.000/0000-00");
	$(".cep").mask("00000-000");

	$(".mascaracep").mask("00000-000");
    </script>