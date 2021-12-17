<?php
require_once("config.php");
include("util.php");
require_once("post.php");

session_start();

/*  todo o código da página só será exibido caso ele esteja logado
 * Se não estiver, ele será redirecionado para a página index.html, onde há o formulário de login
 */
if(isset($_SESSION["logado"]) && $_SESSION["logado"]) {
    $post = new Post($con);
    $nome = $post->getAdmName($_SESSION["id"]);

    require_once("headerA.php");
    maskFunctions();
?>

    <div id="erros">
        <?=exibeErros()?>
    </div>

    <form id="cad-fornecedor" action="cadastro_fornecedor.php" method="POST">
        <label for="razaoSocial"> Razão social: </label>
        <input type="text" name="razaoSocial" required="required"> <br>

        <label for="cnpj"> CNPJ: </label>
        <input type="text" id="cnpj" name="cnpj" required="required" placeholder="00.000.000/0000-00"> <br>

        <label for="email"> Email: </label>
        <input type="email" name="email" required="required"> <br>

        <label for="telefone"> Telefone: </label>
        <input type="tel" id="tel" name="telefone" required="required" placeholder="(00) 0000-0000"> <br>

        <label for="cep"> CEP: </label>
        <input type="text" id="cep" name="cep" required="required" placeholder="00000-00"> <br>

        <label for="logradouro"> Logradouro: </label>
        <input type="text" name="logradouro" required="required" > <br>

        <label for="numero"> Número: </label>
        <input type="text" name="numero" required="required"> <br>

        <label for="complemento"> Complemento: </label>
        <input type="text" name="complemento"> <br>

        <label for="bairro"> Bairro: </label>
        <input type="text" name="bairro" required="required"> <br>

        <label for="cidade"> Cidade: </label>
        <input type="text" name="cidade" required="required"> <br>

        <label for="uf"> Estado: </label>
        <input type="text" name="uf" size="2" maxlength="2" required="required" placeholder="XX"> <br>

        <input type="submit" name="btn-cad-forn" value="Cadastrar Fornecedor">
    </form>

<?php
    include_once("footer.php");
}
else {
    header("Location: index.php");
}
mysqli_close($con);
?>