<?php
require_once("config.php");
include_once("util.php");
require_once("post.php");

session_start();

$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");
?>

<form id="cad-venda" action="cadastro_venda.php">
    <label for="data"> Data de ocorrência: </label>
    <input type="date" name="data" required="required"> <br>

    <label for="cliente"> Cliente: </label>
    <select name="cliente">
        <option value="default">Não especificado</option>
        <?php listClientes($post); ?>
    </select><br>

    <h3>Produtos</h3>

    <select name="produtos">
        <?php listProdutos($post); ?>
    </select>

    <label for="qtd">Quantidade:</label>
    <input type="float" name="qtd" required="required" placeholder="1.00">

    <input type="button" value="Inserir produto"><br><br>

    <input type="submit" name="btn-cad-venda" value="Cadastrar Venda">
</form>

<?php
include_once("footer.php");
?>