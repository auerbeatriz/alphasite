<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php"); 

if(isset($_SESSION["success"]) && $_SESSION["success"]) {
    echo "<script type='text/javascript'> alert('Produto cadastrado com sucesso!') </script>";
    unset($_SESSION["success"]);
}
?>

<h1> Produtos </h1>
<form action="" method="post">
    <label for="busca_nome">Nome do produto:</label>
    <input type="search" id="busca_nome" name="nome">

    <label for="busca_codigo">Código:</label>
    <input type="search" id="busca_codigo" name="codigo">

    <label for="busca_codigo">Fornecedor:</label>
    <input type="search" id="busca_fornecedor" name="fornecedor">

    <input type="submit" name="filtragem" value="Filtrar"></input>
</form>
<br><br>

<?php

if(isset($_POST["filtragem"])) {
    $nome = $_POST["nome"];
    $codigo = $_POST["codigo"];
    $fornecedor = $_POST["fornecedor"];
    $produtos = $post->getProdutosInFilter($nome, $codigo, $fornecedor);
} else {
    $produtos = $post->getProdutos();
}

while ($produto = mysqli_fetch_assoc($produtos)) {
    listProdutosForConsulta($produto);
}

mysqli_close($con);
include_once("footer.php");
?>
