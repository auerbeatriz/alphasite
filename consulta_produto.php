<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");

echo "<h1> Produtos </h1>";

$produtos = $post->getProdutos();
while ($produto = mysqli_fetch_assoc($produtos)) {
    
    $nomeProduto = utf8_encode(strtoupper(filter_var($produto["nome"], FILTER_SANITIZE_SPECIAL_CHARS)));
    $fornecedor = utf8_encode(filter_var($produto["fornecedor"], FILTER_SANITIZE_SPECIAL_CHARS));

    if(filter_var($produto["preco_venda"], FILTER_VALIDATE_FLOAT)) {
        echo "<figure>
        <img src='".$produto["foto"]."' class='display_produto'>
        </figure>
        <label>".$produto["codigo_barras"]." - <b>".$nomeProduto."</b></label><br>
        <label>Fornecedor: ".$fornecedor."</label><br>
        <label>Preço de venda: R$".$produto["preco_venda"]."<label>
        <hr>";
    }
    else {
        echo "<label>".$produto["codigo_barras"]." - <b>".$nomeProduto."</b></label><br>
        <label>Fornecedor: ".$fornecedor."</label><br>
        <figure>
            <img src='".$produto["foto"]."'>
        </figure><br>
        <label><i>O preço do produto não é válido. Por questões de segurança, não será exibido.</i></label><hr>";
    }
}

mysqli_close($con);
include_once("footer.php");
?>
