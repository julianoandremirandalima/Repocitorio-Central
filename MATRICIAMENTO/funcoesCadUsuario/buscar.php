<?php
include('db.php');
include('funcoes.php');
$query = '';
$saida = array();
$query .= "SELECT * FROM colaboradores ";


	if(isset($_POST["search"]["value"]))
	{
		//POR JULIANO: AQUI ACRESCENTO OS CAMPOS(COLUNAS) QUE VAI SER FILTRADO NA TABELA
		$query .= 'WHERE nome LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR matricula LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR local LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR setor LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR assinatura LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR contrato LIKE "%'.$_POST["search"]["value"].'%" ';
	}

	
	
	

	if(isset($_POST["order"]))
	{
		$query .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
		$query .= ' ORDER BY nome ';
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
		$assinatura = $row["assinatura"];
		$contrato = $row["contrato"];
		$idbdx = $row["id"];
		$nomebdx = $row["nome"];
		$sub_array[] = $row["nome"];
		$sub_array[] = $row["matricula"];
		$sub_array[] = $row["local"];
		$sub_array[] = $row["setor"];
		
		$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary btn-sm update"><i class="bi bi-pencil-square"></i></button>';
		$sub_array[] = '<button type="button" class="btn btn-info btn-sm"  onclick="javascript:abrirJanela('."'detalhe.php?idtitular=$idbdx&nome=$nomebdx'".', 1024, 700);"><i class="bi bi-person-plus dependente" data-toggle="tooltip" title="Dependentes"></i></button>';
		$sub_array[] = '<button type="button" class="btn btn-warning btn-sm"  onclick="javascript:abrirJanela('."'resumo.php?idtitular=$idbdx&nome=$nomebdx'".', 1024, 700);"><i class="bi bi-eye baixar" data-toggle="tooltip" title="Resumo"></i></button>';
		$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-sm delete"><i class="bi bi-trash-fill"></i></button>';
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