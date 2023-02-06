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
else if ($local=="Guarda Municipal") {
  $localfiltro = " AND local = 'Guarda Municipal'";
}
else {
  $localfiltro = "AND local != 'FHOMUV' AND local != 'FUNDAÇÃO CULTURAL'  AND local != 'INPREV' AND local != 'SEMUL' AND local != 'Guarda Municipal'";
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script>
        var total = 0;
        $(document).ready(function() {
            $('table tbody tr').each(function() {
                total += parseFloat(this.children[4].innerHTML);
                totaldecimal = total.toFixed(2);
            });
            $('#ttt').text('Total: ' + totaldecimal);
        });
    </script>

			<br>
      <table id="myTable" class="table">
        <thead>
        <tr>
						
						<th>NOME</th>
                        <th>MATRÍCULA</th>
                        <th>LOCAL</th>
                        <th>ANÁLISE</th>
					
                        <th>VALOR</th>
                        
						                 </tr>
        </thead>
        <tbody>
				<script type="text/javascript">
						
						function abrirJanela(pagina, largura, altura) {
						// Definindo centro da tela
						var esquerda = (screen.width - largura)/2;
						var topo = (screen.height - altura)/2;
						// Abre a nova janela
						minhaJanela = window.open(pagina,'','height=' + altura + ', width=' + largura + ', top=' + topo + ', left=' + esquerda);
						}
						
						</script>
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
                //print_r($result);
					$i=1;
					while($row = $result->fetch()) {
						$idbdx = $row["id"];
				?>
				<tr id="<?php echo $row["id"]; ?>">
				
					<td><?php echo $row["nome"]; ?></td>
					<td><?php echo $row["matricula"]; ?></td>
					<td><?php echo $row["local"]; ?></td>
					<td><button type="button" class="btn btn-primary btn-sm"  onclick="javascript:abrirJanela('analisarlimite.php?id=<?=$idbdx?>', 1024, 700);">Analisar <i class="bi bi-person-plus dependente" data-toggle="tooltip" title="Dependentes"></i></button></td>   
					<?php
              $matriculabd =  $row["matricula"];
              $totalcompra =  $row["total"];
              $selectconvenios = $con->prepare("SELECT SUM(valor_contratado) AS totalconvenio, matricula_colaborador_cadastrado FROM empresasconveniadas_colaborador WHERE matricula_colaborador_cadastrado = '$matriculabd'");
              $selectconvenios->execute();
              $arrayconvenios = $selectconvenios->fetch();
              $totalconvenios = $arrayconvenios["totalconvenio"];

              //$totais = $totalcompra + $totalconvenios;
              $totais = $totalcompra;
          ?>
					<td align="right"> <?php echo number_format($totais,2,",","."); ?></td>
				

				
				</tr>
				<?php
				$i++;
				}

        //SELECIONAR OS QUE NÃO FIZERAM COMPRA MAS ESTÃO NOS CONVENIOS===================================
        $ib=1;
         $selecsoconvenios= $con->prepare("SELECT empresasconveniadas_colaborador.*, colaboradores.* FROM colaboradores
         INNER JOIN empresasconveniadas_colaborador ON empresasconveniadas_colaborador.matricula_colaborador_cadastrado = colaboradores.matricula
         WHERE id != '' $localfiltro
         ");
         $selecsoconvenios->execute();
         while($rowx =  $selecsoconvenios->fetch())
         {
           $idconvenios = $rowx["id"];
           $matriculaconvenios = $rowx["matricula_colaborador_cadastrado"];
           $selectvendasfeitas = $con->prepare("SELECT colaboradores.*, vendas.* FROM vendas
           INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
           
           
           WHERE mes_venda = '$mes' AND ano_venda = '$ano' $localfiltro");
           $selectvendasfeitas->execute();
           $arrayfeitos = $selectvendasfeitas->fetch();
           $idfeitas = $arrayfeitos["id_usuario"];
           $matriculasfeitas = $arrayfeitos["matricula"];
           //echo("matriculafeitas: ".$matriculasfeitas." x ".$matriculaconvenios."<br>");
           if($matriculaconvenios!=$matriculasfeitas)
           { 
				?>

<tr id="<?php echo $rowx["id"]; ?>">
				
        <td><?php echo $rowx["nome"]; ?></td>
        <td><?php echo $rowx["matricula"]; ?></td>
        <td><?php echo $rowx["local"]; ?></td>
        <td><button type="button" class="btn btn-warning btn-sm"  onclick="javascript:abrirJanelax('analisarlimite.php?id=<?=$ib?>', 1024, 700);">Convenio <i class="bi bi-person-plus dependente" data-toggle="tooltip" title="Dependentes"></i></button><br><?php echo $rowx["responsavel"]; ?></td>   
        <td align="right"> <?php echo number_format($rowx["valor_contratado"],2,",","."); ?></td>
      

      
      </tr>

        <?php
        $ib++;
         }
        }
        ?>
       
				</tbody>
        
        <tfoot>
        <tr>
						
       <td></td>
       <td></td>
            <td  align="right">&nbsp;</td>
            <td  align="right">&nbsp;</td>
           
                        <td id="ttt" align="right"><strong></strong></td>
                        
						                 </tr>
        </tfoot>
        
    </table>
</body>
</html>
