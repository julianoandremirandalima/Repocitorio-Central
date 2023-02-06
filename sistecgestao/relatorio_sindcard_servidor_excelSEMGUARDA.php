<?php
session_start();
error_reporting(0);
include("conexao.php");
$filtrar = $_REQUEST["filtrar"];

$local = $_REQUEST["local"];
if($local=="FHOMUV")
{
  $localfiltro = " AND local = 'FHOMUV'";
}
else if ($local=="FUNDAÇÃO CULTURAL") {
  $localfiltro = " AND local = 'FUNDAÇÃO CULTURAL'";
}
else if ($local=="INPREV") {
  $localfiltro = " AND local = 'INPREV'";
}
else if ($local=="SEMUL") {
  $localfiltro = " AND local = 'SEMUL'";
}
else {
  $localfiltro = "AND local != 'FHOMUV' AND local != 'FUNDAÇÃO CULTURAL'  AND local != 'INPREV' AND local != 'SEMUL'";
  $local = "PREFEITURA";
}


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
 header("Content-Disposition: attachment; filename=rh-$local-$mes-$ano.xls");
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
                        <th>LOCAL</th>
					
                        <th>VALOR</th>
                        
						                 </tr>
        </thead>
        <tbody>
				
				<?php
                //include("conexao.php");
                
                $result = $con->prepare("SELECT SUM(valorparcela) AS total, colaboradores.*, lojas.*, vendas.* FROM vendas
                INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
                INNER JOIN lojas ON vendas.id_loja = lojas.idLogista
                WHERE mes_venda = '$mes' AND ano_venda = '$ano' $localfiltro
                GROUP BY id
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
					<td><?php echo $row["local"]; ?></td>   
					
					<td align="right">R$ <?php echo number_format($row["total"],2,",","."); ?></td>
				

				
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
        
        <tfoot>
        <tr>
						
					
                      
        <th></th>           
						<th></th>
            <th>TOTAL</th>
            <td  align="right">&nbsp;</td>
            <?php
                $resultotal = $con->prepare("SELECT SUM(valorparcela) AS totalx, colaboradores.* FROM vendas
                INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
               WHERE mes_venda = '$mes' AND ano_venda = '$ano' $localfiltro
                
                
                ");
                $resultotal->execute();
                $rowx = $resultotal->fetch();
            ?>
                        <td  align="right"><strong>R$ <?php echo number_format($rowx["totalx"],2,",","."); ?></strong></td>
                        
						                 </tr>
        </tfoot>
        
    </table>
</body>
</html>
