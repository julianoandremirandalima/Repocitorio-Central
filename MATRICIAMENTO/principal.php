<?php
include("header.php");
?>
<!-- End Header -->

  <!-- ======= hero Section ======= -->
  <!-- End Hero Section -->

  <main id="main">

    

    <!-- ======= Services Section ======= -->
    <section id="services">
      <div class="container" data-aos="fade-up">
      <div class="section-header" align="center">
          <h2  style="font-size: 20px; margin-top:100px"><?=$nomelogadox?>, Bem vindo ao Sistema SISTEC - MATRICIAMENTO</h2>
		 <div> <strong>MEUS LOCAIS: </strong>
		  <?php
					$smeuslocais = $con->prepare("SELECT * FROM viewequivelocal WHERE idprofissional = '$usuariologado'");
					$smeuslocais->execute();
					while($arraymeuslocais = $smeuslocais->fetch())
					{
						$icone = '<i class="bi bi-bookmark-fill"></i>';
						$meuslocais = $arraymeuslocais["localequipe"].",";
						$nomemeuslocais = $icone." ".$arraymeuslocais["nomelocal"]." ";
						echo($nomemeuslocais);
					
					}
				?>
           </div>
        </div>

        <?php
          include($conteudoprincipal);
        ?>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Clients Section ======= -->
    <!-- End Clients Section -->

    <!-- ======= Portfolio Section ======= -->
    <!-- End Portfolio Section -->

    <!-- ======= Testimonials Section ======= -->
    <!-- End Testimonials Section -->

    <!-- ======= Call To Action Section ======= -->
    <!-- End Call To Action Section -->

    <!-- ======= Team Section ======= -->
    <!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    <!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include("footer.php");
  ?>