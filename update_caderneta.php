
<?php

require_once("config.php");
include_once("util.php");
require_once("post.php");

session_start();
if(isset($_SESSION["logado"]) && $_SESSION["logado"]) {

    require_once("headerA.php");

    if((isset($_REQUEST["id"]) && isset($_REQUEST["op"])) || isset($_REQUEST["pg"])) {
        $post = new Post($con);
        $nome = $post->getAdmName($_SESSION["id"]);

        $id = $_REQUEST['id'];
        $op = $_REQUEST['op'];

        if ($op == "leitura") {
            $registro = $post->getSpecificCaderneta($id);

            $data = $registro["data"];
            $cliente = $registro["id_cliente"];
            $produto = $registro["id_produto"];
            $qtd = $registro["qtd"];
            $obs = $registro["obs"];
            $total = $registro["total"];            
        }
    ?>

        <h2> Alterar registro de caderneta - <?=$id?> </h2>
        <div class="erro">
                <?=exibeErros($_SESSION["erros"])?>
        </div><br>
        <label><i>Só é possível criar um registro na caderneta para clientes cadastrados</i></label>

        <form id="up-caderneta" action="cadastro_update_caderneta.php" method="POST">
            <input type='hidden' name='id' value='<?=$id?>'>
            <div>
                <p>
                <label for="data"> Data de ocorrência: </label>
                <input class="campo" type="date" name="data" required="required" value="<?=$data?>"> <br>
                </p>
                <p>
                <label for="cliente"> Cliente: </label>
                <select name="cliente" required="required">
                    <option value="nan" selected="selected">Não especificado</option>
                    <?php listClientesForUpdate($post, $cliente); ?>
                </select><br>
                </p>
                <p>
                <label for="produto">Produto: </label>
                <select name="produto" required="required">
                    <option value="nan" selected="selected">Não especificado</option>
                    <?php listProdutosForUpdate($post, $produto); ?>
                </select>
                </p>
                <p>
                <label for="qtd">Quantidade:</label>
                <input class="campo" type="number" step="0.01" name="qtd" required="required" value="<?=$qtd?>"><br>
                </p>
                <p>
                <label for="total">Valor total:</label>
                <input class="campo" type="number" step="0.01" name="total" required="required" value="<?=$total?>"><br>
                </p>
                <p>
                <label for="obs">Observação: </label>
                <input class="campo" type="text" name="obs" placeholder="Obs." value="<?=$obs?>"><br>
                </p>
            </div>
            <input class="botao" type="submit" name="btn-cad" value="Atualizar Registro">
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