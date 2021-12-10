<?php

require_once("config.php");
include_once("util.php");
require_once("post.php");

session_start();

$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");
?>

<form id="cad-caderneta" action="cadastro_caderneta.php">
    <label for="data"> Data de ocorrência: </label>
    <input type="date" name="data" required="required"> <br>

    <label><i>Só é possível criar um registro na caderneta para clientes cadastrados<i></label><br>
    <label for="cliente"> Cliente: </label>
    <select name="cliente" required="required">
        <?php listClientes($post); ?>
    </select><br>

    <label for="produto">Produto: </label>
    <select name="produto" required="required">
        <?php listProdutos($post); ?>
    </select>

    <label for="qtd">Quantidade:</label>
    <input type="float" name="qtd" required="required" placeholder="1.00"><br>

    <input type="submit" name="btn-cad-venda" value="Cadastrar Registro">
</form>

<?php
include_once("footer.php");
?>