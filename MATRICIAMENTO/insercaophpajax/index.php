<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Inserção de dados em MySQL com PHP + AJAX</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
</head>
<body>
<div class="logo"><img src="img/logo_pplware.png" alt="Peopleware" title="Peopleware"/></div>
<div class="gravar">
		<div class="inputgravar">
			<div class="tituloinput">Preencha o seguinte formulário:</div>
			<input type="text" id="campo1" placeholder="Campo1" /><br />
			<input type="text" id="campo2" placeholder="Campo2" />
		</div>
		<div class="submitgravar">
			<button class="btn btn-success" type="submit" onclick="inserir_registo()">Gravar</button>
		</div>
</div>
<script type="text/javascript">
function inserir_registo()
{

    //dados a enviar, vai buscar os valores dos campos que queremos enviar para a BD
    var dadosajax = {
        'campo1' : $("#campo1").val(),
        'campo2' : $("#campo2").val()
    };
    pageurl = 'grava.php';
    //para consultar mais opcoes possiveis numa chamada ajax
    //http://api.jquery.com/jQuery.ajax/
    $.ajax({
	
        //url da pagina
        url: pageurl,
        //parametros a passar
        data: dadosajax,
        //tipo: POST ou GET
        type: 'POST',
        //cache
        cache: false,
        //se ocorrer um erro na chamada ajax, retorna este alerta
        //possiveis erros: pagina nao existe, erro de codigo na pagina, falha de comunicacao/internet, etc etc etc
        error: function(){
            alert('Erro: Inserir Registo!!');
        },
        //retorna o resultado da pagina para onde enviamos os dados
        success: function(result)
        { 
            //se foi inserido com sucesso
            if($.trim(result) == '1')
            {
				alert("O seu registo foi inserido com sucesso!");
            }
            //se foi um erro
            else
            {
                alert("Ocorreu um erro ao inserir o seu registo!");
            }

        }
    });
}
</script>
</body>
</html>