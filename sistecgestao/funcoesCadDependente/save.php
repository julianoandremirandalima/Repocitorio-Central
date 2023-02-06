<?php
include 'database.php';
		
if(count($_POST)>0){
	if($_POST['type']==1){
		include("variaveisTabela.php");
		$idtitular = $_REQUEST["idtitular"];//CAMPO HIDDEN==================
        $sql = $con->prepare("INSERT INTO dependentes (id_titular, nome_dependente, data_nascimento_dependente, parentesco_dependente) 
		VALUES ('$idtitular', '$nome','$data', '$parentesco')");
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
        $sql = $con->prepare("UPDATE dependentes SET
		nome_dependente ='$nome', data_nascimento_dependente = '$data', parentesco_dependente = '$parentesco' WHERE id_dependentes=$id");
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
		
        $sql = $con->prepare("DELETE FROM dependentes WHERE id_dependentes=$id ");
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
		$sql = $con->prepare("DELETE FROM dependentes WHERE id_dependentes in ($id)");
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