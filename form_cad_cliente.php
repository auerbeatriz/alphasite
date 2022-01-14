
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
    <h2> Cadastro de cliente </h2>
    <div class="erro">
            <?=exibeErros($_SESSION["erros"])?>
    </div><br>
    
    <form id="cad-cliente"action="cadastro_update_cliente.php" method="POST">
              
        <div>
        <p>
        <label for="nome"> Nome: </label>
        <input class="campo" type="text" name="nome" required="required"> <br>
        </p>
        <p>
        <label for="cpf"> CPF: </label>
        <input class="campo" type="text" id="cpf" name="cpf" placeholder="000.000.000-00"> <br>
        </p>
        <p>
        <label for="email"> Email: </label>
        <input class="campo" type="email" name="email" > <br>
        </p>
        <p>
        <label for="telefone"> Telefone: </label>
        <input class="campo" type="tel" id="tel" name="telefone" required="required" placeholder="(00) 00000-00000"> <br>
        </p>
        <p>
        <label for="cep"> CEP: </label>
        <input class="campo" type="text" id="cep" name="cep" placeholder="00000-00"> <br>
        </p>
        <p>
        <label for="logradouro"> Logradouro: </label>
        <input class="campo" type="text" name="logradouro" > <br>
        </p>
        <p>
        <label for="numero"> Número: </label>
        <input class="campo" type="text" name="numero" > <br>
        </p>
        <p>
        <label for="complemento"> Complemento: </label>
        <input class="campo" type="text" name="complemento"> <br>
        </p>
        <p>
        <label for="bairro"> Bairro: </label>
        <input class="campo" type="text" name="bairro"> <br>
        </p>
        <p>
        <label for="cidade"> Cidade: </label>
        <input class="campo" type="text" name="cidade" > <br>
        </p>
        <p>
        <label for="uf"> Estado: </label>
        <input class="campo" type="text" name="uf" size="2" maxlength="2" placeholder="XX"> <br>    
        </p>
        </div>
        <input class="botao" type="submit" name="btn-cli" value="Cadastrar Cliente">
    </form>

<?php
    include_once("footer.php");
}
else {
    
    header("Location: index.php");
}
mysqli_close($con);
?>