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
    listProdutoData($produto);
}

mysqli_close($con);
include_once("footer.php");
?>
