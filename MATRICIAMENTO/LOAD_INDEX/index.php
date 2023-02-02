<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>PÁGINA LOAD</title>
	<link rel="stylesheet" href="css/style.css" media="screen"/>
	<script src="js/jquery-2.1.3.js"></script>
</head>
<body>
	<div id="container">
		<div id="loader"></div>
		<div id="content">
			<img src="img/4k.jpg" width="100%" height="auto"/>
			<img src="img/4k.jpg" width="100%" height="auto"/>
			<img src="img/4k.jpg" width="100%" height="auto"/>
			<img src="img/4k.jpg" width="100%" height="auto"/>
			<img src="img/4k.jpg" width="100%" height="auto"/>
			<img src="img/4k.jpg" width="100%" height="auto"/>
			<img src="img/4k.jpg" width="100%" height="auto"/>
			<img src="img/4k.jpg" width="100%" height="auto"/>
		</div>
	</div>
	<script type="text/javascript">
		// Este evendo é acionado após o carregamento da página
		jQuery(window).load(function() {
			//Após a leitura da pagina o evento fadeOut do loader é acionado, esta com delay para ser perceptivo em ambiente fora do servidor.
			jQuery("#loader").delay(2000).fadeOut("slow");
		});
	</script>
</body>
</html>