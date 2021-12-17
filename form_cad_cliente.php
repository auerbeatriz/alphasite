<?php

require_once("config.php");
include("util.php");
require_once("post.php");

session_start();

if(isset($_SESSION["logado"]) && $_SESSION["logado"]) {

    $post = new Post($con);
    $nome = $post->getAdmName($_SESSION["id"]);

    require_once("headerA.php");
    maskFunctions();
?>

    <div id="erros">
        <?=exibeErros()?>
    </div>

    <form id="cad-cliente" action="cadastro_cliente.php" method="POST">
        <label for="nome"> Nome: </label>
        <input type="text" name="nome" required="required"> <br>

        <label for="cpf"> CPF: </label>
        <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00"> <br>

        <label for="email"> Email: </label>
        <input type="email" name="email" > <br>

        <label for="telefone"> Telefone: </label>
        <input type="tel" id="tel" name="telefone" required="required" placeholder="(00) 00000-00000"> <br>

        <label for="cep"> CEP: </label>
        <input type="text" id="cep" name="cep" placeholder="00000-00"> <br>

        <label for="logradouro"> Logradouro: </label>
        <input type="text" name="logradouro" > <br>

        <label for="numero"> Número: </label>
        <input type="text" name="numero" > <br>

        <label for="complemento"> Complemento: </label>
        <input type="text" name="complemento"> <br>

        <label for="bairro"> Bairro: </label>
        <input type="text" name="bairro"> <br>

        <label for="cidade"> Cidade: </label>
        <input type="text" name="cidade" > <br>

        <label for="uf"> Estado: </label>
        <input type="text" name="uf" size="2" maxlength="2" placeholder="XX"> <br>    

        <input type="submit" name="btn-cad-cli" value="Cadastrar Cliente">
    </form>

<?php
    include_once("footer.php");
}
else {
    header("Location: index.php");
}
mysqli_close($con);
?>