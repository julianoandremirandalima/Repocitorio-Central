<?php
include('db.php');
include('funcoes.php');
$query = '';
$saida = array();
$query .= "SELECT * FROM usuarios ";


	if(isset($_POST["search"]["value"]))
	{
		//POR JULIANO: AQUI ACRESCENTO OS CAMPOS(COLUNAS) QUE VAI SER FILTRADO NA TABELA
		$query .= 'WHERE nome LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR usuario LIKE "%'.$_POST["search"]["value"].'%" ';
	}
	if(isset($_POST["order"]))
	{
		$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
	$query .= 'ORDER BY nome, tipo_user DESC ';
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
		$sub_array[] = $row["nome"];
		$sub_array[] = $row["usuario"];
		$sub_array[] = $row["tipo_user"];
		$idbdx = $row["id"];
		$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-secondary btn-sm update"><i class="bi bi-pencil-square"></i></button>';
		$sub_array[] = '<a href="baixar.php?id='.$idbdx.'" target="_blanck"><button type="button" name="baixar" id="'.$row["id"].'" class="btn btn-secondary btn-sm baixar"><i class="bi bi-arrow-down-circle-fill"></i></button></a>';
		$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-secondary btn-sm delete"><i class="bi bi-trash-fill"></i></button>';
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