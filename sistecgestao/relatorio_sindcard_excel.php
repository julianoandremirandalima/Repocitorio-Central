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



 header("Content-type: application/vnd.ms-excel");
 header("Content-type: application/force-download");
 header("Content-Disposition: attachment; filename=detalhado-$mes-$ano.xls");
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
	<table border="1" class="table" id="myTable">
        <thead>
        <tr>
						
						<th>N°</th>
                        <th>NOME</th>
                        <th>MATRÍCULA</th>
                        <th>SETOR</th>
                        <th>LOCAL</th>
						<th>DATA</th>
            <th>LOJA</th>
            <th>PARCELA</th>
            <th>CHAVE VENDA</th>
                        <th>VALOR</th>
                        <th>STATUS</th>
                        </tr>
        </thead>
        <tbody>
				
				<?php
                //include("conexao.php");
                
                $result = $con->prepare("SELECT SUM(valorparcela) AS total, colaboradores.*, lojas.*, vendas.* FROM vendas
                INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
                INNER JOIN lojas ON vendas.id_loja = lojas.idLogista
                WHERE mes_venda = '$mes' AND ano_venda = '$ano'
                GROUP BY chave_venda
				ORDER BY nome
                
                ");
                $result->execute();
					$i=1;
					while($row = $result->fetch()) {
						//$idbdx = $row["id"];
				?>
				<tr id="<?php echo $row["id"]; ?>">
				
					<td><?php echo $i; ?></td>
					<td><?php echo $row["nome"]; ?></td>
					<td><?php echo $row["matricula"]; ?></td>
					<td><?php echo $row["setor"]; ?></td>
					<td><?php echo $row["local"]; ?></td>   
					<td><?php echo $row["datarealvenda"]; ?></td>
          <td><?php echo $row["nomeLogista"]; ?></td>
          <td><?php echo str_pad($row["numeroparcela"],2,'0', STR_PAD_LEFT)."/".str_pad($row["quantasparcelas"],2,'0',STR_PAD_LEFT); ?></td>
          <td><?php echo $row["chave_venda"]; ?></td>
					<td align="right">R$ <?php echo number_format($row["total"],2,",","."); ?></td>
					<td align="right"><?php echo $row["statusparcela"]; ?></td>
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
        
        <tfoot>
        <tr>
						
						<td></td>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
						<th></th>
            <th>TOTAL</th>
            <?php
                $resultotal = $con->prepare("SELECT SUM(valorparcela) AS totalx FROM vendas
                WHERE mes_venda = '$mes' AND ano_venda = '$ano'
                
                
                ");
                $resultotal->execute();
                $rowx = $resultotal->fetch();
            ?>
                        <td  align="right"><strong>R$ <?php echo number_format($rowx["totalx"],2,",","."); ?></strong></td>
                        <td  align="right">&nbsp;</td>
                        </tr>
        </tfoot>
        
    </table>
</body>
</html>
