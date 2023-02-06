<?php
include('db.php');
include('funcoes.php');
$query = '';
$saida = array();
$query .= "SELECT * FROM lojas ";


	if(isset($_POST["search"]["value"]))
	{
		//POR JULIANO: AQUI ACRESCENTO OS CAMPOS(COLUNAS) QUE VAI SER FILTRADO NA TABELA
		$query .= 'WHERE nomeLogista LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR conveniada LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR cnpjLogista LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR enderecoLogista LIKE "%'.$_POST["search"]["value"].'%" ';
	}
	if(isset($_POST["order"]))
	{
		$query .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
	$query .= ' ORDER BY nomeLogista ';
	}
	
	if($_POST["length"] != -1)
	{
		$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}	

	
	$statement = $con->prepare($query);
	$statement->execute();	
	$resultado = $statement->fetchAll();
	
	$dados = array();
	$contar_rows = $statement->rowCount();
	
	foreach($resultado as $row)
	{
		$imagem = '';
		if($row["imagem"] != '')
		{
			$imagem = '<img src="upload/'.$row["imagem"].'" class="img-thumbnail" width="50" height="35" />';
		}
		else
		{
			$imagem = '';
		}
		$sub_array = array();
		$sub_array[] = $imagem;
		$sub_array[] = $row["nomeLogista"];
		$sub_array[] = $row["conveniada"];
		
		$sub_array[] = $row["cnpjLogista"];
		$sub_array[] = $row["enderecoLogista"];
		$idbdx = $row["idLogista"];
		$nomebdx = $row["nomeLogista"];
		
		$sub_array[] = '<button type="button" class="btn btn-success btn-sm"  onclick="javascript:abrirJanela('."'contrato.php?idtitular=$idbdx&nome=$nomebdx'".', 1024, 700);"><i class="bi bi-clipboard-check baixar" data-toggle="tooltip" title="Resumo"></i></button>';
		$sub_array[] = '<button type="button" name="update" id="'.$row["idLogista"].'" class="btn btn-primary btn-sm update"><i class="bi bi-pencil-square"></i></button>';
		$sub_array[] = '<button type="button" name="delete" id="'.$row["idLogista"].'" class="btn btn-danger btn-sm delete"><i class="bi bi-trash-fill"></i></button>';
		$dados[] = $sub_array;
		
	}


	$saida = array(
	 	"draw"				=>	intval($_POST["draw"]),
		"recordsTotal"		=> 	$contar_rows,
		"recordsFiltered"	=>	get_total_registros(),
		"data"				=>	$dados
	);
	echo json_encode($saida);
	
?>