<?php
include("conexao.php");
$selectdatareal = $con->prepare("SELECT * FROM vendas");
$selectdatareal->execute();
while($arraydatarealchave = $selectdatareal->fetch())
{
	$chavevendabd = $arraydatarealchave["chave_venda"]; 
			
			$segundos = substr($chavevendabd,-2);
			$minutos = substr($chavevendabd,-4,2);
			$horas = substr($chavevendabd,-6,2);
			$dia = substr($chavevendabd,-8,2);
			$mes = substr($chavevendabd,-10,2);
			$ano = substr($chavevendabd,-14,4);
			
			$datarealpelachave = $ano."-".$mes."-".$dia." ".$horas.":".$minutos.":".$segundos;
			
			$atualizar = $con->prepare("UPDATE vendas SET datarealvenda = '$datarealpelachave' WHERE chave_venda = '$chavevendabd'");
			$atualizar->execute();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
</head>

<body>
</body>
</html>