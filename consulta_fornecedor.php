<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");

echo "<h1> Fornecedores </h1>";

$fornecedores = $post->getFornecedores();
while ($fornecedor = mysqli_fetch_assoc($fornecedores)) {
    listFornecedorData($fornecedor);
}

mysqli_close($con);
include_once("footer.php");
?>
