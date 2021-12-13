<?php
require_once("config.php");
include_once("util.php");
require_once("post.php");

session_start();

$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);
$produtos = $post->getProdutos();

require_once("headerA.php");
?>

<div class="produtos">
    <img src="arquivos/alface.jpg" height="250px"><br>
    <label>ALFACE <b>R$1,00</b></label><br>
    <input name="qtd" type="number">
    <button>Adicionar</button>
</div>

<div class="receipt">
    <h2>Recibo</h2>
    <form>
        <label for="data"> Data de ocorrência: </label>
        <input type="date" name="data" required="required"> <br>

        <label for="cliente"> Cliente: </label>
        <select name="cliente">
            <option value="nan" selected="selected">Não especificado</option>
            <?php listClientes($post); ?>
        </select><br>

        <label for="obs"> Observação: </label>
        <input type="text" name="obs"> <br><br>

        <input type="submit" name="btn-cad-venda" value="Cadastrar Venda">
    </form>
</div>


<?php
mysqli_close($con);
include_once("footer.php");
?>