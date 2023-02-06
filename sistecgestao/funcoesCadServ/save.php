<?php
include 'database.php';
		
if(count($_POST)>0){
	if($_POST['type']==1){
		include("variaveisTabela.php");
		
        $sql = $con->prepare("INSERT INTO colaboradores (nome, matricula, local, setor,	data_nascimento, estado_civil, sexo, escolaridade, rg, cpf, endereco, numero, bairro, cidade, cep, funcao, tipo, data1, data2, telefone, celular, wattsap, email, limite) 
		VALUES ('$nome','$matricula','$local','$setor','$data', '$estadocivil', '$sexo', '$escolaridade', '$rg', '$cpf', '$endereco', '$numero', 
		'$bairro', '$cidade', '$cep', '$funcao', '$tipo', '$data1', '$data2', '$telefone', '$celular', '$wattsap', '$email', '$limite')");
		if ($sql->execute()) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . $con->errorInfo();
		}
		$con = null;
        //mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		include("variaveisTabela.php");
        $sql = $con->prepare("UPDATE colaboradores SET
		nome ='$nome', matricula = '$matricula', local = '$local', setor = '$setor', data_nascimento = '$data', estado_civil = '$estadocivil', sexo = '$sexo', escolaridade = '$escolaridade', rg = '$rg', cpf = '$cpf', endereco = '$endereco', numero = '$numero', bairro = '$bairro', cidade = '$cidade', cep = '$cep', funcao = '$funcao', tipo = '$tipo', data1 = '$data1', data2 = '$data2', telefone = '$telefone', celular = '$celular', wattsap = '$wattsap', email = '$email', limite = '$limite'
		WHERE id=$id");
		if ($sql->execute()) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . $con->errorInfo();
		}
		$con = null;
        //mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		
        $sql = $con->prepare("DELETE FROM colaboradores WHERE id=$id ");
		if ($sql->execute()) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . $con->errorInfo();
		}
		$con = null;
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = $con->prepare("DELETE FROM colaboradores WHERE id in ($id)");
		if ($sql->execute()) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . $con->errorInfo();
		}
		$con = null;
	}
}

?>