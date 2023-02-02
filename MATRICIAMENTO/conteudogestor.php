<div class="row gy-4">

<?php
					$smeuslocais = $con->prepare("SELECT * FROM viewequivelocal WHERE idprofissional = '$usuariologado' ORDER BY nomelocal");
					$smeuslocais->execute();
					while($arraymeuslocais = $smeuslocais->fetch())
					{
						$icone = '<i class="bi bi-bookmark-fill"></i>';
						$meuslocais = $arraymeuslocais["localequipe"].",";
						$nomemeuslocais = $icone." ".$arraymeuslocais["nomelocal"]." ";
						
					
			
				?>
          
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
            <a href="matriciamento-local.php?idlocal=<?=$arraymeuslocais['idlocal']?>">
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title"><?=strtoupper($arraymeuslocais["nomelocal"])?></h4>
              <p class="description">MATRICIAMENTO</p>
              </a>
            </div>
          </div>
	
<?php
          }
?>            
<div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
            <a href="matriciamento.php">
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title">TODOS</h4>
              <p class="description">Acesse aqui!</p>
              </a>
            </div>
          </div>
        </div>

        