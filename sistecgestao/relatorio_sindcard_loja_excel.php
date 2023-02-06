<?php
session_start();
error_reporting(0);
include("conexao.php");
$filtrar = $_REQUEST["filtrar"];
if($filtrar=="sim")
{
  $ano = $_REQUEST["ano"];
  $mes = $_REQUEST["mes"];
}
else
{
  $ano = date("Y");
  $mes = date("m");
}

$selectdesconto = $con->prepare("SELECT * FROM variaveis");
$selectdesconto->execute();
$arraydesconto = $selectdesconto->fetch();
$desconto = $arraydesconto["descontoempresa"];


 header("Content-type: application/vnd.ms-excel");
 header("Content-type: application/force-download");
 header("Content-Disposition: attachment; filename=total-loja-relatorio-$mes-$ano.xls");
 header("Pragma: no-cache");


?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <title>Sindserva - Sindicato dos Servidores Públicos
Municipais de Varginha </title>
</head>

<body>
<table id="myTable" class="table">
        <thead>
        <tr>
						
						<th width="18" >N°</th>
                       
            <th width="40%">LOJA</th>
           
                        <th width="30%" style="text-align: right">VALOR TOTAL</th>
                        <th width="30%" style="text-align: right">VALOR A PAGAR COM DESCONTO(<?=$desconto?>%)</th>
                       
						                 </tr>
        </thead>
        <tbody>
				
				<?php
                //include("conexao.php");
                
                $result = $con->prepare("SELECT SUM(valorparcela) AS total, colaboradores.*, lojas.*, vendas.* FROM vendas
                INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
                INNER JOIN lojas ON vendas.id_loja = lojas.idLogista
                WHERE mes_venda = '$mes' AND ano_venda = '$ano'
                GROUP BY idLogista
                
                ");
                $result->execute();
					$i=1;
					while($row = $result->fetch()) {
						//$idbdx = $row["id"];

            $totalsoma = $row["total"];
            $descontoporloja = $row["descontologista"];
            $totaldescontado = $totalsoma - ($totalsoma*$descontoporloja)/100;
				?>
				<tr id="<?php echo $row["id"]; ?>">
				
					<td><?php echo $i; ?></td>
				
          <td><?php echo $row["nomeLogista"]; ?> (-<?=$descontoporloja?>)%</td>
         
					<td align="right">R$ <?php echo number_format($row["total"],2,",","."); ?></td>
          <td align="right">R$ <?php echo number_format($totaldescontado,2,",","."); ?></td>
					

				
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
        
        <tfoot>
        <tr>
						
						
                        <th></th>
                      
                       
            <th>TOTAL</th>
            <?php
               $resultotal = $con->prepare("SELECT SUM(valorparcela) AS totalx, SUM(valorparcela - (valorparcela * descontologista/100)) AS totaldescontox, vendas.*, lojas.* FROM vendas
               INNER JOIN lojas ON vendas.id_loja = lojas.idLogista
               WHERE mes_venda = '$mes' AND ano_venda = '$ano'
               
               
               ");
               $resultotal->execute();
               $rowx = $resultotal->fetch();
       //$valortotaldescontato = $rowx["totalx"] - ($rowx["totalx"] * $descontoporloja)/100;
       $valortotaldescontato = $rowx["totaldescontox"];
            ?>
                        <td  align="right"><strong>R$ <?php echo number_format($rowx["totalx"],2,",","."); ?></strong></td>
						<td  align="right"><strong>R$ <?php echo number_format($valortotaldescontato,2,",","."); ?></strong></td>
                        
						                 </tr>
        </tfoot>
        
    </table>
</body>
</html>
