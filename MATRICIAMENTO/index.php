<?php
error_reporting(0);
$errox = $_REQUEST["error"];
$erro = "<p style='color: #ff0000;'>$errox</p>"
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>.:SISTEC - SEMUS:. - Sistema de Matriciamento</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="icone.png" rel="icon">
  <link href="icone.png" rel="apple-touch-icon">
<style type="text/css">
:root{
--bg1: #66ADFF;/*azul*/
--bg2: #66ADFF;/*verde*/
/*--bg2: #099;verde*/
/*--bg2: #07C460;verde*/
}
body{
	font-family:Verdana, Geneva, sans-serif;
	color:#616161;
	background-image: linear-gradient(to right, var(--bg1) 50%, var(--bg2) 50%);
	height:100vh;
	display:grid;
	place-items: center;	
}

.container{
	background-color:rgba(255,255,255,0.15);
	height:90vh;
	width:90vh;
	border-radius:50%;
	box-sizing:border-box;
	padding:2.2rem;
	}
	
.circle{
	background-color:#fff;
	height:100%;
	border-radius:50%;
	text-align:center;
	display:grid;
	place-items:center;}
	
form{
	box-sizing:border-box;
	}
	
.single-title{
	font-size:2em;
	}
	
.single-text{
	padding-bottom:0.7em;
	border-bottom:3px solid var(--bg2);
	display:inline-block;
	}
	
.user, .pass, .btn{
	padding:1rem 1.5rem;
	margin-top:1rem;
	border-radius:50px;
	width:100%;
	outline:none;
	border:1px solid #adadad;
	display:block;
	box-sizing:border-box;
}

.pass{
	margin-top:0.4rem;
}

.flex{
	display:flex;
	justify-content: center;
	gap: 3rem;
	margin:1rem 0;
	font-size:0.8em;
}

.btn{
	background-color:var(--bg2);
	border:none;
	color:#fff;
	margin:1rem 0;
	cursor:pointer;
}

.btn:hover{
	background-color:var(--bg1);
}

.dont{
	font-style:0.8em;
}

a{
	text-decoration:none;
	color:var(--bg2);
	font-weight:500;
}
	

@media(max-width: 630px){
.container{
	height:100vw;
	width:100vw;
	}

}



</style>
</head>

<body>
<div class="container">
 <div class="circle" style="background-color:#fff">
 	<form action="login.php" method="post">
    <div align="center" class="rotated">
      <p><img src="logosistec.png" style="background-color:#003366; padding:20px; border-radius:30px; max-width:290px; width:100%"></p>
      <p><img src="logoAPS.png" width="297" height="92"></p>
    </div>
     <p class="sigle-title">LOGIN</p>
     <?=$erro?>
     <input type="text" class="user" placeholder="USUÁRIO" name="usuario" required>
     <input type="password" class="pass" placeholder="SENHA" name="senha" required>
     <div class="flex">
     <div>
     <input type="checkbox" id="checkbox">
     <label for="checkbox">LEMBRE-ME</label>     
     </div>
     <a href="esqueceusenha.php">RECUPERAR SENHA</a>
     
     </div>
     
     <input type="submit" class="btn" value="ENTRE">
       
     
    </form>
 
 </div>
</div>
</body>
</html>
