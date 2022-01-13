
<?php
require_once("config.php");
include_once("util.php");
require_once("post.php");

session_start();

if(isset($_SESSION["logado"]) && $_SESSION["logado"]) {
    $post = new Post($con);
    $nome = $post->getAdmName($_SESSION["id"]);
    $produtos = $post->getProdutos();

    if(isset($_POST["add"])) {
        if(isset($_SESSION["cesta"])) {
            $session_array_id = array_column($_SESSION["cesta"], "id");
            if(!in_array($_GET["id"], $session_array_id)) {
                $session_array = array(
                    "id" => $_GET["id"],
                    "nome" => $_POST["nome"],
                    "qtd" => $_POST["qtd"],
                    "preco" => $_POST["preco"],
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
                "preco" => $_POST["preco"],
                "total" => $_POST["qtd"] * $_POST["preco"]
            );
            $_SESSION["cesta"][] = $session_array;
        }
    }
    if(isset($_POST["limpar"])) {
        unset($_SESSION["cesta"]);
        unset($_SESSION["erros"]);
        header("Location: form_cad_venda.php");
    }

    require_once("headerA.php");

?>
    <div class="cesta">
        <?php
        while($produto = mysqli_fetch_assoc($produtos)) {
            listProdutosForVenda($produto);
        }
        ?>
    </div>

    <div class="receipt">
        <h2>Recibo</h2>
        <form action="cadastro_venda.php" method="POST">
            <p>
            <label for="data"> Data de ocorrência: </label>
            <input class="campo" type="date" name="data" required="required"> <br>
            </p>
            <p>
            <label for="cliente"> Cliente: </label>
            <select name="cliente">
                <option value="0" selected="selected">Não especificado</option>
                <?php listClientes($post); ?>
            </select><br>
            </p>
            <p>
            <label for="obs"> Observação: </label>
            <input class="campo" type="text" name="obs"> <br><br>
            </p>
            <p>
            <div id="result">
                <?php if(isset($_SESSION["cesta"])){listCesta($_SESSION["cesta"]);} ?>
            </p>           
            </div><br>
            
            <input class="botao" type="submit" name="btn-cad-venda" value="Cadastrar Venda">
        </form><br>

        <form action="" method="POST">
            <input class="botao" type="submit" name="limpar" value="Limpar Cesta">
        </form> <br>

        <div class="erro">
            <?php if(isset($_SESSION["erros"])) {exibeErros($_SESSION["erros"]);} ?>
        </div><br>
    </div>


<?php
    include_once("footer.php");
}
else {
    header("Location: index.php");
}
mysqli_close($con);
?>