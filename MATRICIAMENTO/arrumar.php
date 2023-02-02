<?php
include("conexao.php");
$s = $con->prepare("SELECT * FROM local");
$s->execute();
while($l = $s->fetch())
{
	$id = $l["idlocal"];
	$nome = $l["nomelocal"];
	
	echo $id.")".$nome."<br>";
	$u = $con->prepare("UPDATE matriciamento SET local = '$id' WHERE local = '$nome'");
	$u->execute();

}

?>