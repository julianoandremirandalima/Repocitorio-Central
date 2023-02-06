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
            
              <div class="icon"><i class="bi bi-cash-coin"></i></div>
              <h4 class="title">EFETUAR VENDAS</h4>
              <p class="description">Identifique o servidor abaixo.</p>
              <hr>
              <div class="table-responsive">
              <div align="left"><a href="principal.php"><button type="button" class="btn btn-secondary btn-sm">
				<i class="bi bi-arrow-left-circle"></i> voltar
				</button></a></div>
			
				
			<br>
      <div class="container">
        <div class="form">
          <form action="venda_p2.php" method="post">
            <div class="row">
            <div align="center">
                <div class="col-lg-3">
                    <label>INFORME CPF:</label>
                    <div class="input-group">
                      
                      <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="CPF" style="text-align: center;">
                    </div>
                </div>

                <div class="col-lg-3">
                    <label>OU A MATRÍCULA:</label>
                    <div class="input-group">
                      
                      <input type="text" class="form-control" id="codico" name="codico" placeholder="0000" style="text-align: center;">
                    </div>
                </div>



            </div>
            </div>
           
           <br>

            

            <div class="text-center"><button type="submit" class="btn btn-primary">PROSSEGUIR <i class="bi bi-arrow-right-circle"></i></button></div>
          </form>
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