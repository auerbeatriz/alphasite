
<?php

require_once("config.php");
include("util.php");
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
            $registro = $post->getSpecificCliente($id);

            $nome = utf8_encode($registro["nome"]);
            $email = utf8_encode($registro["email"]);
            $telefone = $registro["telefone"];
            $cpf = $registro["cpf"];
            $cep = $registro["cep"];
            $logradouro = utf8_encode($registro["logradouro"]);
            $numero = $registro["numero"];
            $complemento = utf8_encode($registro["complemento"]);
            $bairro = utf8_encode($registro["bairro"]);
            $cidade = utf8_encode($registro["cidade"]);
            $uf = utf8_encode($registro["uf"]);     
        }
?>
    <h2> Cadastro de cliente </h2>
    <div class="erro">
            <?=exibeErros($_SESSION["erros"])?>
    </div><br>
    
    <form id="cad-cliente"action="cadastro_update_cliente.php" method="POST">
        <input type='hidden' name='id' value='<?=$id?>'>
        <div>
        <p>
        <label for="nome"> Nome: </label>
        <input class="campo" type="text" name="nome" required="required" value="<?=$nome?>"> <br>
        </p>
        <p>
        <label for="cpf"> CPF: </label>
        <input class="campo" type="text" id="cpf" name="cpf" placeholder="000.000.000-00" value="<?=$cpf?>"> <br>
        </p>
        <p>
        <label for="email"> Email: </label>
        <input class="campo" type="email" name="email" value="<?=$email?>"> <br>
        </p>
        <p>
        <label for="telefone"> Telefone: </label>
        <input class="campo" type="tel" id="tel" name="telefone" required="required" placeholder="(00) 00000-00000" value="<?=$telefone?>"> <br>
        </p>
        <p>
        <label for="cep"> CEP: </label>
        <input class="campo" type="text" id="cep" name="cep" placeholder="00000-00" value="<?=$cep?>"> <br>
        </p>
        <p>
        <label for="logradouro"> Logradouro: </label>
        <input class="campo" type="text" name="logradouro" value="<?=$logradouro?>"> <br>
        </p>
        <p>
        <label for="numero"> Número: </label>
        <input class="campo" type="text" name="numero" value="<?=$numero?>"> <br>
        </p>
        <p>
        <label for="complemento"> Complemento: </label>
        <input class="campo" type="text" name="complemento" value="<?=$complemento?>"> <br>
        </p>
        <p>
        <label for="bairro"> Bairro: </label>
        <input class="campo" type="text" name="bairro" value="<?=$bairro?>"> <br>
        </p>
        <p>
        <label for="cidade"> Cidade: </label>
        <input class="campo" type="text" name="cidade" value="<?=$cidade?>"> <br>
        </p>
        <p>
        <label for="uf"> Estado: </label>
        <input class="campo" type="text" name="uf" size="2" maxlength="2" placeholder="XX" value="<?=$uf?>"> <br>    
        </p>
        </div>
        <input class="botao" type="submit" name="btn-cli" value="Atualizar Registro">
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