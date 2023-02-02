<?php
if(isset($_POST["chave_compra"])){
    include("conexao.php");
    $chavebd = $_POST["chave_compra"]; 
    $selectbd = $con->prepare("SELECT colaboradores.*, lojas.*, vendas.* FROM vendas
    INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
    INNER JOIN lojas ON vendas.id_loja = lojas.idLogista
    WHERE chave_venda = '$chavebd'");
    $selectbd->execute();
    $linha = $selectbd->fetch();

    $conteudo = "";
    $conteudo .= "<strong>".$linha["nomeLogista"]."</strong><br>";
    $conteudo .= $linha["razaosocialLogista"]."<br>";
    $conteudo .= "<strong>CNPJ: ".$linha["cnpjLogista"]."</strong><br>";
    $conteudo .= $linha["enderecoLogista"]."<br>";
    $conteudo .= $linha["telefoneLogista"]." - ";
    $conteudo .= $linha["emailLogista"]."<br>";
    $conteudo .= "--------------------------------------------------------------------<br>";
    $conteudo .= "<strong>TITULAR: ".$linha["nome"]."</strong><br>";
    $conteudo .= "Matrícula: ".$linha["matricula"]."<br>";
    
    $conteudo .= "Data Venda: ".$linha["datarealvenda"]."<br>";
    $conteudo .= "CHAVE VENDA: <strong>".$linha["chave_venda"]."</strong><br>";
    $conteudo .= "Cartão: ******".substr($linha["cartao"],-3)."<br>";
    $conteudo .= "<table class='table'>
    <tr>
        <td align = 'left'><strong>parc.</strong></td>
        <td align = 'left'><strong>valor</strong></td>
        <td align = 'left'><strong>mês</strong></td>
        <td align = 'left'><strong>controle</strong></td>
    
    </tr>
    ";
    $selectbd = $con->prepare("SELECT colaboradores.*, lojas.*, vendas.* FROM vendas
    INNER JOIN colaboradores ON vendas.id_usuario = colaboradores.id
    INNER JOIN lojas ON vendas.id_loja = lojas.idLogista
    WHERE chave_venda = '$chavebd'");
    $selectbd->execute();
    while($linha2 = $selectbd->fetch())
    {
        $conteudo .= "<tr>
        <td align = 'left'>".$linha2['numeroparcela']."</td>
        <td align = 'left'>R$ ".number_format($linha2['valorparcela'],'2',',','.')."</td>
        <td align = 'left'>".date('m/Y', strtotime($linha2['data_venda']))."</td>
        <td align = 'left'>".$linha2['chave_venda'].$linha2['numeroparcela']."</td>
        
    
    </tr>";
    }
    $conteudo .= "</table>";
    $conteudo .= "Total: <strong>R$ ".number_format($linha['valortotal'],'2',',','.')."</strong><br><br>";
    $conteudo .= "<div align = 'center'>_____________________________________________________<br> Assinatura legível</div>";
    
    echo($conteudo);
  

}