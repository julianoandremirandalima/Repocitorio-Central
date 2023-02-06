<?php
include("conexao.php");
$idcolaboradorlogado = $_REQUEST["idusuario"];
$nome = $_REQUEST["nome"];


  $ano = $_REQUEST["ano"];
  $mes = $_REQUEST["mes"];

?>
<body onLoad="print();">
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

          <div class="col-lg-12">
            <div class="box">
            
              <div class="icon"><i class="bi bi-people"></i></div>
              <h4 class="title"><span class="modal-title"><img src="logohorizontal.png"></span><br>            
              MINHAS COMPRAS<br>
              Servidor:

                <?=$nome?>.<br>
                Data da Emissão: <?=date("d/m/Y H:i:s")?>
              </h4>
            
              <div class="table-responsive">
              <table border="0" cellspacing="3" id="myTable">
        <thead>
        <tr>
						
						<th bgcolor="#11847F" style="font-size: 14px; color: #FFFFFF;">N°</th>
                        <th bgcolor="#11847F" style="color: #FFFFFF">LOJA</th>
                        <th bgcolor="#11847F" style="color: #FFFFFF">CNPJ</th>
						<th bgcolor="#11847F" style="color: #FFFFFF">DATA</th>
            <th bgcolor="#11847F" style="color: #FFFFFF">PARCELA</th>
            <th bgcolor="#11847F" style="color: #FFFFFF">CHAVE VENDA</th>
                        <th bgcolor="#11847F" style="color: #FFFFFF">VALOR</th>
                        </tr>
        </thead>
        <tbody>
				
				<?php
                //include("conexao.php");
                $idLogista = $_SESSION["USER_ID_IDENTIFICADOR"];
                $result = $con->prepare("SELECT SUM(valorparcela) AS total, lojas.nomeLogista, lojas.cnpjLogista, vendas.datarealvenda, chave_venda, numeroparcela, quantasparcelas FROM vendas
                INNER JOIN lojas ON vendas.id_loja = lojas.idLogista
                WHERE id_usuario = '$idcolaboradorlogado' AND mes_venda = '$mes' AND ano_venda = '$ano'
                GROUP BY chave_venda
                
                ");
                $result->execute();
					$i=1;
					while($row = $result->fetch()) {
						//$idbdx = $row["id"];
				?>
				<tr id="<?php echo $row["id"]; ?>">
				
					<td bgcolor="#F5F5F5"><?php echo $i; ?></td>
					<td bgcolor="#F5F5F5"><?php echo $row["nomeLogista"]; ?></td>
					<td bgcolor="#F5F5F5"><?php echo $row["cnpjLogista"]; ?></td>   
					<td bgcolor="#F5F5F5"><?php echo $row["datarealvenda"]; ?></td>
          <td bgcolor="#F5F5F5"><?php echo str_pad($row["numeroparcela"],2,'0', STR_PAD_LEFT)."/".str_pad($row["quantasparcelas"],2,'0',STR_PAD_LEFT); ?></td>
          <td bgcolor="#F5F5F5"><?php echo $row["chave_venda"]; ?></td>
					<td align="right" bgcolor="#F5F5F5">R$ <?php echo number_format($row["total"],2,",","."); ?></td>
				  </tr>
				<?php
				$i++;
				}
				?>
				</tbody>
        
        <tfoot>
        <tr>
						
						<td colspan="5"></td>
                    <th bgcolor="#11847F" style="color: #FFFFFF">TOTAL</th>
            <?php
                $resultotal = $con->prepare("SELECT SUM(valorparcela) AS totalx FROM vendas
                WHERE id_usuario = '$idcolaboradorlogado' AND mes_venda = '$mes' AND ano_venda = '$ano'
                
                
                ");
                $resultotal->execute();
                $rowx = $resultotal->fetch();
            ?>
                        <td  align="right" bgcolor="#11847F" style="color: #FFFFFF"><strong>R$ <?php echo number_format($rowx["totalx"],2,",","."); ?></strong></td>
                        </tr>
        </tfoot>
        
    </table>
              </div>  
            </div>
          </div>

          

          

          

        </div>

      </div>
    </section>


  <!-- Add Modal HTML --></main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include("footer.php");
  ?>
  
 

