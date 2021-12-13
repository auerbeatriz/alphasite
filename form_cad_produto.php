<?php

require_once("config.php");
include_once("util.php");
require_once("post.php");

session_start();

if(isset($_SESSION["logado"]) && $_SESSION["logado"]) {

    $post = new Post($con);
    $nome = $post->getAdmName($_SESSION["id"]);

    require_once("headerA.php");

?>

    <div id="erros">
            <?=exibeErros($_SESSION["erros"])?>
    </div>

    <form id="cad-produto" action="cadastro_produto.php" enctype="multipart/form-data" method="POST">
        <label for="nome"> Código de barras: </label>
        <input type="text" name="codigo" required="required" placeholder="989893"> <br>

        <label for="nome"> Nome do produto: </label>
        <input type="text" name="nome" required="required" placeholder="Alface"> <br>

        <label for="preco"> Preço de venda: </label>
        <input type="number" step="0.01" name="preco" required="required" placeholder="R$ 1,00"> <br>

        <label for="fornecedor"> Fornecedor: </label>
        <select name="fornecedor" required="">
            <option value="0" selected="selected">Produção própria</option>
            <?php listFornecedores($post); ?>
        </select><br>

        <label for="foto"> Foto do produto: </label>
        <input type="file" name="foto"> <br>

        <input type="submit" name="btn-cad-produto" value="Cadastrar Produto">
    </form>

<?php
    include_once("footer.php");
}
else {
    header("Location: index.php");
}
mysqli_close($con);
?>