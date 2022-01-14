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
    <h2> Cadastro de fornecedor </h2>
    <div class="erro">
        <?=exibeErros($_SESSION["erros"])?>
    </div><br>
    
    <form id="cad-fornecedor" action="cadastro_update_fornecedor.php" method="POST">
        <div>
        <p>
        <label for="razaoSocial"> Razão social: </label>
        <input class="campo" type="text" name="razaoSocial" required="required"> <br>
        </p>
        <p>
        <label for="cnpj"> CNPJ: </label>
        <input class="campo" type="text" id="cnpj" name="cnpj" required="required" placeholder="00.000.000/0000-00"> <br>
        </p>
        <p>
        <label for="email"> Email: </label>
        <input class="campo" type="email" name="email" required="required"> <br>
        </p>
        <p>
        <label for="telefone"> Telefone: </label>
        <input class="campo" type="tel" id="tel" name="telefone" required="required" placeholder="(00) 0000-0000"> <br>
        </p>
        <p>
        <label for="cep"> CEP: </label>
        <input class="campo" type="text" id="cep" name="cep" required="required" placeholder="00000-00"> <br>
        </p>
        <p>
        <label for="logradouro"> Logradouro: </label>
        <input class="campo" type="text" name="logradouro" required="required" > <br>
        </p>
        <p>
        <label for="numero"> Número: </label>
        <input class="campo" type="text" name="numero" required="required"> <br>
        </p>
        <p>
        <label for="complemento"> Complemento: </label>
        <input class="campo" type="text" name="complemento"> <br>
        </p>
        <p>
        <label for="bairro"> Bairro: </label>
        <input class="campo" type="text" name="bairro" required="required"> <br>
        </p>
        <p>
        <label for="cidade"> Cidade: </label>
        <input class="campo" type="text" name="cidade" required="required"> <br>
        </p>
        <p>
        <label for="uf"> Estado: </label>
        <input class="campo" type="text" name="uf" size="2" maxlength="2" required="required" placeholder="XX"> <br>
        </p>
        </div>
        <input class="botao" type="submit" name="btn-forn" value="Cadastrar Fornecedor">
    </form>

<?php
    include_once("footer.php");
}
else {
    header("Location: index.php");
}
mysqli_close($con);
?>