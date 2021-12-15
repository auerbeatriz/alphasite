<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");

echo "<h1> Registros de vendas </h1>";

$vendas = $post->getVendas();
while ($venda = mysqli_fetch_assoc($vendas)) {

    if(filter_var($venda["numero_nota"], FILTER_VALIDATE_INT)) {
        $numeroNota = $venda["numero_nota"];
        $cliente = utf8_encode(strtoupper(filter_var($venda["cliente"], FILTER_SANITIZE_SPECIAL_CHARS)));
        $obs = utf8_encode(strtoupper(filter_var($venda["obs"], FILTER_SANITIZE_SPECIAL_CHARS)));
        $data = date_format(date_create($venda["data"]), "d/m/Y");

        echo "<label><b>Nº ".$numeroNota."</b> - ".$data."</label><br>
            <label><b>Total da compra:</b> R$ ".number_format($venda["total"], 2)."</label><br>
            <label>Cliente: ".$cliente."</label><br>
            <label>Observação: ".$obs."</label><br>";

        echo "<h3>Produtos</h3>";

        $produtosVenda = $post->getProdutosVenda($numeroNota);
        while ($produto = mysqli_fetch_assoc($produtosVenda)) {
            $nomeProduto = utf8_encode(filter_var($produto["produto"], FILTER_SANITIZE_SPECIAL_CHARS));
            echo "<li>".$produto["qtd"]." ".$nomeProduto."</li>";
        }
        
        echo "<hr>";
    }
    else {
        echo "<label>Foram encontrados dados inválidos para essa nota. Por motivos de segurança, ela não será exibida.</label><hr>";
    }
    
    
}

mysqli_close($con);
include_once("footer.php");
?>
