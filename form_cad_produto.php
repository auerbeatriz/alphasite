<?php

require_once("config.php");
include_once("util.php");
require_once("post.php");

session_start();

$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");

?>

<form id="cad-produto" action="cadastro_produto.php" enctype="multipart/form-datas">
    <label for="nome"> Nome do produto: </label>
    <input type="text" name="nome" required="required" placeholder="Alface"> <br>

    <label for="preco"> Preço de venda: </label>
    <input type="float" name="preco" required="required" placeholder="R$ 1,00"> <br>

    <label for="fornecedor"> Fornecedor: </label>
    <select name="fornecedor">
        <?php listFornecedores($post); ?>
    </select><br>

    <label for="foto"> Foto do produto: </label>
    <input type="file" name="foto"> <br>

    <input type="submit" name="btn-cad-produto" value="Cadastrar Produto">
</form>

<?php
include_once("footer.php");
?>