
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
    <h2> Cadastro de caderneta </h2>
    <div class="erro">
            <?=exibeErros($_SESSION["erros"])?>
    </div><br>
    <label><i>Só é possível criar um registro na caderneta para clientes cadastrados</i></label>

    <form id="cad-caderneta" action="cadastro_caderneta.php" method="POST">
        <div>
            <p>
            <label for="data"> Data de ocorrência: </label>
            <input class="campo" type="date" name="data" required="required"> <br>
            </p>
            <p>
            <label for="cliente"> Cliente: </label>
            <select name="cliente" required="required">
                <option value="nan" selected="selected">Não especificado</option>
                <?php listClientes($post); ?>
            </select><br>
            </p>
            <p>
            <label for="produto">Produto: </label>
            <select name="produto" required="required">
                <option value="nan" selected="selected">Não especificado</option>
                <?php listProdutos($post); ?>
            </select>
            </p>
            <p>
            <label for="qtd">Quantidade:</label>
            <input class="campo" type="number" step="0.01" name="qtd" required="required"><br>
            </p>
            <p>
            <label for="total">Valor total:</label>
            <input class="campo" type="number" step="0.01" name="total" required="required"><br>
            </p>
            <p>
            <label for="obs">Observação: </label>
            <input class="campo" type="text" name="obs" placeholder="Obs."><br>
            </p>
        </div>
        <input class="botao" type="submit" name="btn-cad-cad" value="Cadastrar Registro">
    </form>

<?php
    include_once("footer.php");
}
else {
    header("Location: index.php");
}
mysqli_close($con);