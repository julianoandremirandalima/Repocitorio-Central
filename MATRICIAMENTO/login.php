<?php
session_start();
## CONEX�O==========================================
include_once("conexao.php");

$usuario = $_REQUEST["usuario"];
$senhareal = $_REQUEST["senha"];
$senha = md5($_REQUEST["senha"]);

//PDO================================================
$selecuser = $con->prepare("SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'");
$selecuser->execute();
$conta = $selecuser->rowCount();


if($conta==0){
	
	Header("Location: index.php?error=Usuario ou Senha Incorretos!");
	
}else{
	$arrayuser = $selecuser->fetch();
	
	$nomeusuario = $arrayuser["nome"];
	$idusuario = $arrayuser["id"];
	
	$tipo = $arrayuser["tipo_user"];
	$ididentificador = $arrayuser["id_identificador_logista"];
	$ididentificadorcolaborador = $arrayuser["id_identificador"];
	
	
		
		
	## VARIAVEIS DE SESSAO==============================
	$_SESSION["USER_ID"] = $idusuario;
	$_SESSION["USER_ID_COLABORADOR"] = $ididentificadorcolaborador;
	$_SESSION["USER_NOME"] = $nomeusuario;
	$_SESSION["USER_TIPO"] = $tipo;
	$_SESSION["USER_ID_IDENTIFICADOR"] = $ididentificador;
	$_SESSION["USER_ID_IDENTIFICADOR_LOGISTA"] = $ididentificador;	
	
	
	
	## REDIRECINAR=======================================
	/*if($_SESSION["USER_TIPO"]==1)
	{
		Header("Location: principal.php");
	}*/
	
	Header("Location: principal.php");
	echo "<script language= 'JavaScript'>location.href='principal.php'</script>";
	
	
}




?>