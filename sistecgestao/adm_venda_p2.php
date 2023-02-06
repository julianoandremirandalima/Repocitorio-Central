<?php
include("header.php");
$NOMELOGADO = $_SESSION["USER_NOME"];
$loja = $_REQUEST["loja"];
if($NOMELOGADO=="")
{
  echo "<script language= 'JavaScript'>location.href='index.php?error=Conexão expirada! Faça novamente o Login!'</script>";
  Header("Location: index.php?error=Conexão expirada! Faça novamente o Login!");
}
$idtitular = $_REQUEST["codico"];
$cpf = $_REQUEST["cpf"];
if($idtitular=="")
{
  $idtitular = "vazio";
}

if($cpf=="")
{
  $cpf = "vazio";
}
$selecetServidor = $con->prepare("SELECT * FROM colaboradores WHERE (matricula = '$idtitular' OR cpf = '$cpf')");
$selecetServidor->execute();
$dadosServidor = $selecetServidor->fetch();
$idUserbd = $dadosServidor["id"];
$limitebd = $dadosServidor["limite"]; 
$conta = $selecetServidor->rowCount();
//print_r($selecetServidor);

//ATUALIZAR OS CRÉDITOS SE O NUMERO DE PARCELAS BATER O NUMERO DE QUANTIDADE=====
$mesagora = date("m");
$anoagora = date("Y");
$selectCompras = $con->prepare("SELECT * FROM vendas WHERE id_usuario = '$idUserbd' AND mes_venda = '$mesagora' AND ano_venda = '$anoagora' AND statusparcela = 'aberta' GROUP BY chave_venda");
$selectCompras->execute();
//print_r($selectCompras);
while($arrayCompras = $selectCompras->fetch())
{
  $chavebdvenda = $arrayCompras["chave_venda"];
  $parcelavenda = $arrayCompras["numeroparcela"];
  $qtasparcelas = $arrayCompras["quantasparcelas"];
  $valortotal = $arrayCompras["valorparcela"];
  //echo "CHAVE: ".$chavebdvenda." PARCELA: ".$parcelavenda." DE: ".$qtasparcelas."VALOR PARCELA: ".$valortotal."<br>";
  if($parcelavenda==$qtasparcelas)
  {
  $pegarolimite = $con->prepare("SELECT * FROM colaboradores WHERE matricula = '$idtitular'");
  $pegarolimite->execute();
  $arraylimite = $pegarolimite->fetch();
  $limiteatual = $arraylimite["limite"];
  $nomecolaborador = $arraylimite["nome"];
  $totalizar = $limiteatual + $valortotal; 
    $atualizalimite = $con->prepare("UPDATE colaboradores SET limite = '$totalizar' WHERE id = '$idUserbd' AND cartao != 'bloqueado'");
    //$atualizalimite->execute();
    //print_r($atualizalimite);

    $atualizavenda = $con->prepare("UPDATE vendas SET statusparcela = 'fechada' WHERE chave_venda = '$chavebdvenda'");
    $atualizavenda->execute();

    //GRAVAR NA TABELA ALTERACAO LIMITE============================================================================
    $enderecoip = $_SERVER["REMOTE_ADDR"];
    $datahj = date("Y-m-d H:i:s");
    $message = "LIMITE ALTERADO DE $limitebd PARA $totalizar PARA O SERVIDOR $nomecolaborador - $idtitular, FEITA POR $NOMELOGADO NA DATA DE $datahj \n";
    $message .= "ESTA OPERAÇÃO ACONTECE TODA VEZ QUE O LOGISTA VAI EFETUAR UMA VENDA PARA UM SERVIDOR. \n NESTE MOMENTO O SISTEMA VARRE O BANCO DE DADOS PARA VER SE TEM PARCELA EM ABERTO E SE COINCIDE COM A ULTIMA PARCELA VOLTANDO ASSIM O VALOR PARA O LIMITE ATUAL! O IP QUE DISPAROU A AÇÃO FOI $enderecoip";
    
    $loglimite = $con->prepare("INSERT INTO alteracaolimite (
      data_alteracao, para_quem_matricula, para_quem_nome, para_quem_id, quem_fez_id, quem_fez_nome, novovalor, limiteantigo, obs)
      VALUES
      ('$datahj', '$idtitular', '$nomecolaborador', '$idUserbd', '$idlogistalogado', '$NOMELOGADO', '$totalizar', '$limitebd', '$message')
      ");
    $loglimite->execute();

    //ENVIAR E-MAIL-------------------------------------------
    $selectLogista = $con->prepare("SELECT * FROM lojas WHERE idLogista = '$idlogistalogado'");
    $selectLogista->execute();
    $arraylogista = $selectLogista->fetch();
    $emailLogista = $arraylogista["emailLogista"];
          
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $from = " $NOMELOGADO <$emailLogista>";
			$to = "controlesindserva@gmail.com,alteracaolimite@sindserva.esferasistemadigital.com.br,liviasindserva@gmail.com";
			$subject = "VOLTA AUTOMÁTICA DO LIMITE";
		
			$headers = "From:" . $from;
			//mail($to,$subject,$message, $headers);

  }
  
}



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
            <?php
                            if($conta==0)
                            {
                             

                          ?>
                               
                               
                                <div class="d-flex justify-content-center"><strong style="font-size: 18px; color: #f40;"><img src="erro.png"> Servidor não encontrato!</strong></div>
                               
                                  <script>
                                      var timer = setTimeout(function() {
                                          window.location='adm_venda_p1.php'
                                      }, 2000);
                                  </script>
                          <?php

                             // echo "<script language= 'JavaScript'>//location.href='adm_venda_p1.php'</script>";
                                                          
                              }
                              else
                              {

                          ?>  
            
              <div class="icon">
                <?php
                $selecUserbd = $con->prepare("SELECT * FROM usuarios WHERE id_identificador = '$idUserbd'");
                $selecUserbd->execute();
                $arrayuser = $selecUserbd->fetch();
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
              <h4 class="title">EFETUAR VENDAS PARA <?=$dadosServidor["nome"]?></h4>
              <p class="description">Solicite ao servidor digitar sua senha abaixo!</p>
              <hr>
              <div class="table-responsive">
              <div align="left"><a href="principal.php"><button type="button" class="btn btn-secondary btn-sm">
				<i class="bi bi-arrow-left-circle"></i> voltar
				</button></a></div>
        <?php
          $selecetServidor = $con->prepare("SELECT * FROM colaboradores WHERE (matricula = '$idtitular' OR cpf = '$cpf')");
          $selecetServidor->execute();
          $dadosServidor = $selecetServidor->fetch();
          $idUserbd = $dadosServidor["id"];
          $limiteatualizado = $dadosServidor["limite"]; 
        ?>
        <div align="right"><button type="button" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Valor máximo a parcelar por mês!">
                                  <i class="bi bi-cash-coin"></i> LIMITE: R$ <?=number_format($limiteatualizado,2,",",".")?><br>STATUS: Liberado.<br>
                                 
                                </button>
                              
                              </div>
				
			<br>
      <div class="container">
        <div class="form">
          <form action="adm_venda_p3.php" method="post">
            <div class="row">
            <div align="center">
                <div class="col-lg-4">
                    <label>Agora solicite o Servidor para digitar sua senha:</label>
                    <div class="input-group">
                      
                      <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha!" style="text-align: center;" required>
                      <input type="hidden" value="<?=$idUserbd?>" name="codico">
                    </div>
                </div>
            </div>
            </div>
           
           <br>

            

            <div class="text-center"><button type="submit" class="btn btn-primary">PROSSEGUIR <i class="bi bi-arrow-right-circle"></i></button>  <input name="loja" type="hidden" id="loja" value="<?=$loja?>"></div>
          </form>
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
    </section>

    


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include("footer.php");
  ?>
