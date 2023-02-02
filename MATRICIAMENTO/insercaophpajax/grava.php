<?php

	//Conexão à base de dados
	include("../conexao.php");
	
	//recebe os parâmetros

    $campo1 = $_REQUEST['campo1'];
    $campo2 = $_REQUEST['campo2'];

    try
    {
        //insere na BD
        $sql = $con->prepare("INSERT INTO dados (campo1bd, campo2bd) VALUES('".trim($campo1)."','".trim($campo2)."')");
        $sql->execute();
        
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        echo "1";
    } 
    catch (Exception $ex)
    {
        //retorna 0 para no sucesso do ajax saber que foi um erro
        echo "0";
    }
?>