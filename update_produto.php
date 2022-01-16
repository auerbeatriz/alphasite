<?php

require_once("config.php");
include_once("util.php");
require_once("post.php");

session_start();

if(isset($_SESSION["logado"]) && $_SESSION["logado"]) {

    require_once("headerA.php");
    maskFunctions();

    if((isset($_REQUEST["id"]) && isset($_REQUEST["op"])) || isset($_REQUEST["pg"])) {
        $post = new Post($con);
        $nome = $post->getAdmName($_SESSION["id"]);

        $id = $_REQUEST['id'];
        $op = $_REQUEST['op'];

        if ($op == "leitura") {
            $registro = $post->getSpecificProduto($id);

            $codigoBarras = $registro["codigo_barras"];
            $nome = $registro["nome"];
            $preco = $registro["preco_venda"];
            $foto = $registro["foto"];
            $fornecedor = $registro["id_fornecedor"];
        }

?>

    <h2> Atualizar dados do produto </h2>
    <div id="erros">
            <?=exibeErros($_SESSION["erros"])?>
    </div>

    <form id="cad-produto" action="cadastro_update_produto.php" enctype="multipart/form-data" method="POST">
    <input type='hidden' name='id' value='<?=$id?>'>
    <input type='hidden' name='foto_atual' value='<?=$foto?>'>
    <div>
        <p>
        <figure><img src="<?=$foto?>" class='oferta'/></figure>
        <label for="codigo"> Código de barras: </label>
        <input class="campo" type="text" name="codigo" required="required" value="<?=$codigoBarras?>"> <br>
        </p>
        <p>
        <label for="nome"> Nome do produto: </label>
        <input class="campo" type="text" name="nome" required="required" placeholder="" value="<?=$nome?>"> <br>
        </p>
        <p>
        <label for="preco"> Preço de venda: </label>
        <input class="campo" type="number" step="0.01" name="preco" required="required" placeholder="" value="<?=$preco?>"> <br>
        </p>
        <p>
        <label for="fornecedor"> Fornecedor: </label>
        <select class="campo" name="fornecedor" required="">
            <?php listFornecedoresForUpdate($post, $fornecedor); ?>
        </select><br>
        </p>
        <p>
        <label for="foto"> Foto do produto: </label>
        <input type="file" name="foto"><br>
        <p>
    </div>

        <input class="botao" type="submit" name="btn-produto" value="Atualizar Registro">
    </form>

<?php
        include_once("footer.php");
    }
    else {
        $anterior = $_SERVER['HTTP_REFERER'];
        header("Location: $anterior");
    }
}
else {
    header("Location: index.php");
}
mysqli_close($con);
?>