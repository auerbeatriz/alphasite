<?php
require_once("config.php");
include_once("util.php");
require_once("post.php");

session_start();

$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);
$produtos = $post->getProdutos();

require_once("headerA.php");

while($produto = mysqli_fetch_assoc($produtos)) {
    listProdutosForVenda($produto);
}

if(isset($_POST["add"])) {
    if(isset($_SESSION["cesta"])) {
        $session_array_id = array_column($_SESSION["cesta"], "id");
        if(!in_array($_GET["id"], $session_array_id)) {
            $session_array = array(
                "id" => $_GET["id"],
                "nome" => $_POST["nome"],
                "qtd" => $_POST["qtd"],
                "total" => $_POST["qtd"] * $_POST["preco"]
            );
            $_SESSION["cesta"][] = $session_array;
        }
    }
    else {
        $session_array = array(
            "id" => $_GET["id"],
            "nome" => $_POST["nome"],
            "qtd" => $_POST["qtd"],
            "total" => $_POST["qtd"] * $_POST["preco"]
        );
        $_SESSION["cesta"][] = $session_array;
    }
}

if(isset($_POST["limpar"])) {
    $_SESSION["cesta"] = null;
    header("Location: test_form_cad_venda.php");
}

?>

<div class="receipt">
    <h2>Recibo</h2>
    <form action="cadastro_venda.php" method="POST">
        <label for="data"> Data de ocorrência: </label>
        <input type="date" name="data" required="required"> <br>

        <label for="cliente"> Cliente: </label>
        <select name="cliente">
            <option value="0" selected="selected">Não especificado</option>
            <?php listClientes($post); ?>
        </select><br>

        <label for="obs"> Observação: </label>
        <input type="text" name="obs"> <br><br>

        <div id="result">
            <?= listCesta($_SESSION["cesta"]); ?>
        </div><br>

        <input type="submit" name="btn-cad-venda" value="Cadastrar Venda">
    </form><br>

    <form action="" method="POST">
        <input type="submit" name="limpar" value="Limpar Cesta">
    </form> 

    <div id="erros">
        <?=exibeErros($_SESSION["erros"])?>
    </div>
</div>


<?php
mysqli_close($con);
include_once("footer.php");
?>