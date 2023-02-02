<?php
include("header.php");
$idusuariocompra = $_REQUEST["codico"];
$senha = md5($_REQUEST["senha"]);
$versenha = $con->prepare("SELECT * FROM usuarios WHERE id_identificador = '$idusuariocompra' AND senha = '$senha'");
$versenha -> execute();
$arrayuser = $versenha->fetch();
$conta = $versenha->rowCount();
$fotoUser = $arrayuser["imagem"];

$selecetServidor = $con->prepare("SELECT * FROM colaboradores WHERE id = '$idusuariocompra'");
$selecetServidor->execute();
$dadosServidor = $selecetServidor->fetch(); 
$idtitular = $dadosServidor["id"];
$datachave = date("YmdHis");
$chavedavenda = $_SESSION["USER_ID"].$idtitular.$datachave;


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
       

        <div class="row gy-4">

          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            
                        <div class="box">
                          <?php
                            if($conta==0)
                            {
                             

                          ?>
                               
                                <div class="d-flex justify-content-center"><strong style="font-size: 18px; color: #f40;"><img src="erro.png">  Senha inválida!</strong></div>
                               
                                  <script>
                                      var timer = setTimeout(function() {
                                          window.location='venda_p1.php'
                                      }, 2000);
                                  </script>
                          <?php

                             // echo "<script language= 'JavaScript'>//location.href='venda_p1.php'</script>";
                                                          
                              }
                              else
                              {

                          ?>     
                          <div align="left"><a href="venda_p1.php"><button type="button" class="btn btn-secondary btn-sm">
                                  <i class="bi bi-arrow-left-circle"></i> voltar
                                  </button></a></div><br>                   
                                  <div class="icon">
                <?php
                
                $fotoUser = $arrayuser["imagem"];
                  if($fotoUser=="")
                  {
                ?>
                <i class="bi bi-cash-coin"></i>
                <?php
                  }
                  else
                  {
                ?>
              <img src="upload/<?=$fotoUser?>" width="80" height="60">
              <?php
                  }
                  
                ?>
            
            </div>
                          <h4 class="title"><?=$dadosServidor["nome"]?></h4>
                          <p class="description"><strong>LOCAL:</strong> <?=$dadosServidor["local"]?> / <strong>SETOR:</strong> <?=$dadosServidor["setor"]?> / <strong>FUNÇÃO:</strong> <?=$dadosServidor["funcao"]?></p>
                          <hr>
                          <div class="table-responsive">
                                                     
                                  <div align="right"><button type="button" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Valor máximo a parcelar por mês!">
                                  <i class="bi bi-cash-coin"></i> LIMITE: R$ <?=number_format($dadosServidor["limite"],2,",",".")?><br>STATUS: Liberado.<br>
                                  CHAVE: <?=$chavedavenda?>
                                </button>
                              
                              </div>
                                
                                
                                <div class="container">
        <div class="form">
          <form action="venda_p4.php" method="post" onsubmit="return calcular();">
            <div class="row">
            <div align="center">
                <div class="col-lg-2">
                    <label>Qual valor?</label>
                    <div class="input-group">
                      
                      <input type="number" step="0.01" class="form-control" id="valor" name="valor" placeholder="Digite o valor" style="text-align: center;" required>
                      <input type="hidden" value="<?=$idtitular?>" name="codico">
                    </div>
                </div>

                <div class="col-lg-1">
                    <label>N.º Parcelas</label>
                    <div class="input-group">
                      
                      <input type="number" class="form-control" id="parcelas" name="parcelas"  style="text-align: center;" required>
                      <input type="hidden" value="<?=$_SESSION["USER_ID"]?>" name="loja">
                      <input type="hidden" value="<?=$chavedavenda?>" name="chave">
                      <input type="hidden" id="limite" name="limite" value="<?=$dadosServidor["limite"]?>">
                      <input type="hidden" id="valorparcela" name="valorparcela" value="">
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
                          <?php
                              }
                          ?>



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
  	function calcular() {
	    var valor = Number(document.getElementById("valor").value);
	    var parcelas = Number(document.getElementById("parcelas").value);
      var limite = Number(document.getElementById("limite").value);
	    var total = parseFloat(valor/parcelas).toFixed(2);
      document.getElementById("valorparcela").value = total;
      if(total>limite)
      {
        alert("O valor de cada parcela ultrapassa o valor mensal de limite!\n A compra está sendo dividida em "+parcelas+" parcelas  de R$ "+total);
        return(false);
      }
      else
      {
        
       
		  var resultado = confirm("Com este valor a compra ficará em "+parcelas+" parcelas  de R$ "+total);
        if (resultado == true) {
            
            alert("Venda efetuada!");
			return(true);
        }
        else{
            alert("Você desistiu da venda!");
			return(false);
        }
		  
		  
		  
		  
      }

      
	    
	
	}




</script>