<?php
session_start();
error_reporting(0);
date_default_timezone_set ("America/Sao_Paulo");
include("conexao.php");

//TESTAR SE CONTINUA LOGADO E SE CASO NÃO, CHAMAR A TELA DE LOGIN======

$NOMELOGADO = $_SESSION["USER_NOME"];
if($NOMELOGADO=="")
{
  echo "<script language= 'JavaScript'>location.href='index.php?error=Conexão expirada! Faça novamente o Login!'</script>";
  Header("Location: index.php?error=Conexão expirada! Faça novamente o Login!");
}

$tipologado = $_SESSION["USER_TIPO"];
if($tipologado=="administrador")
{
  $menu = 'menuadmin.php';
  $conteudoprincipal = "conteudoadm.php";
  $mostrar = "none";
}
else if($tipologado=="logista")
{
  $menu = 'menulogista.php';
  $conteudoprincipal = "conteudologista.php";
  $mostrar = "none";
}
else if($tipologado=="operadorlogista")
{
  $menu = 'menulogista.php';
  $conteudoprincipal = "conteudologistaoperador.php";
  $mostrar = "none";
}
else if($tipologado=="operador")
{
  $menu = 'menuoperador.php';
  $conteudoprincipal = "conteudooperador.php";
  $mostrar = "none";
}
else
{
  $menu = 'menucolaborador.php';
  $conteudoprincipal = "conteudocolaborador.php";
  $mostrar = "block";
}
$idcolaboradorlogado = $_SESSION["USER_ID_COLABORADOR"];
$idlogistalogado = $_SESSION["USER_ID_IDENTIFICADOR_LOGISTA"];
$nomelogadox = $_SESSION["USER_NOME"];




  $ano = $_REQUEST["ano"];
  $mes = $_REQUEST["mes"];

//EXTORNO=======
$extornar = $_REQUEST["extornar"];
$chave = $_REQUEST["chave"];

?>


<!-- End Header -->

  <!-- ======= hero Section ======= -->
  <!-- End Hero Section -->
<body onLoad="print();">

 
              <h4 class="title"><img src="logohorizontal.png" width="220" height="50" alt=""/></h4>
              <h4 class="title">RELATÓRIO DE VENDAS - <?=strtoupper($NOMELOGADO)?></h4>
<h5>Mês: <?=$mes?> / Ano: <?=$ano?></h5>
       <span style="font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; font-size: 14px;">Relatório impresso na data de
<?=date("d/m/Y H:i:s")?>.      <br>
</span>
<table border="1" cellspacing="0" class="table" id="myTable">
  <thead>
        <tr>
						
						<th width="5%">N°</th>
                        <th width="30%">NOME</th>
                        <th width="10%">MATRÍCULA</th>
                        <th width="15%">VENDEDOR</th>
						<th width="15%">DATA</th>
            <th width="15%">PARCELA</th>
            <th width="20%">CHAVE VENDA</th>
                        <th width="15%">VALOR</th>
                        </tr>
        </thead>
        <tbody>
				
				<?php
                include("conexao.php");
			    $idLogista = $_REQUEST["idlogista"];
                $result = $con->prepare("SELECT SUM(valorparcela) AS total, colaboradores.matricula, colaboradores.nome, vendas.datarealvenda, chave_venda, numeroparcela, quantasparcelas, quemvendeu FROM vendas
                INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
                WHERE id_loja = '$idLogista' AND mes_venda = '$mes' AND ano_venda = '$ano'
                GROUP BY matricula, chave_venda");
			
                $result->execute();
					$i=1;
					while($row = $result->fetch()) {
						//$idbdx = $row["id"];
				?>
				<tr id="<?php echo $row["id"]; ?>">
				
					<td><?php echo $i; ?></td>
					<td><?php echo $row["nome"]; ?></td>
					<td><?php echo $row["matricula"]; ?></td>
					<td>
					<?php
						
						$quemvendeu = $row["quemvendeu"];
						$selectqv = $con->prepare("SELECT * FROM usuarios WHERE id = '$quemvendeu'");
						$selectqv->execute();
						$arrayqv = $selectqv->fetch();
						echo($arrayqv["nome"]);
					?>
					</td>   
					<td><?php echo $row["datarealvenda"]; ?></td>
          <td><?php echo str_pad($row["numeroparcela"],2,'0', STR_PAD_LEFT)."/".str_pad($row["quantasparcelas"],2,'0',STR_PAD_LEFT); ?></td>
          <td><?php echo $row["chave_venda"]; ?></td>
					<td align="right">R$ <?php echo number_format($row["total"],2,",","."); ?></td>
				  </tr>
				<?php
				$i++;
				}
				?>
				</tbody>
        
        <tfoot>
        <tr>
						
						<td colspan="6"></td>
            <th width="20%">TOTAL</th>
            <?php
                $resultotal = $con->prepare("SELECT SUM(valorparcela) AS totalx, SUM(valorparcela - (valorparcela * descontologista/100)) AS totaldescontox, vendas.*, lojas.* FROM vendas
				INNER JOIN lojas ON vendas.id_loja = lojas.idLogista
                WHERE id_loja = '$idLogista' AND mes_venda = '$mes' AND ano_venda = '$ano'
                
                
                ");
                $resultotal->execute();
                $rowx = $resultotal->fetch();
            ?>
                        <td  align="right"><strong>R$ <?php echo number_format($rowx["totalx"],2,",","."); ?></strong></td>
                        </tr>
			
			
			<tr bgcolor="#009999" style="color: #FFFFFF">
						
						<td colspan="6" bgcolor="#000000"></td>
              <th width="20%" bgcolor="#000000">TOTAL A RECEBER (DESC.: <?=$rowx["descontologista"]?>%)</th>
          
                        <td  align="right" bgcolor="#000000"><strong>R$ <?php echo number_format($rowx["totaldescontox"],2,",","."); ?></strong></td>
                        </tr>
			
			
			
        </tfoot>
        
    </table>
</body>
  
