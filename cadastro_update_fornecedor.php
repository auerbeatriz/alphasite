<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();

if(isset($_POST["btn-forn"])) {
    $op = trim($_POST["btn-forn"]);

    $erros = array();
    $post = new Post($con);    

    /* sanitização dos campos do formulário */
    $razaoSocial = utf8_encode(filter_input(INPUT_POST, "razaoSocial", FILTER_SANITIZE_SPECIAL_CHARS));
    $cnpj = $_POST["cnpj"];
    $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_NUMBER_INT);
    $logradouro = utf8_encode(filter_input(INPUT_POST, "logradouro", FILTER_SANITIZE_SPECIAL_CHARS));
    $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_NUMBER_INT);
    $complemento = utf8_encode(filter_input(INPUT_POST, "complemento", FILTER_SANITIZE_SPECIAL_CHARS));
    $bairro = utf8_encode(filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS));
    $cidade = utf8_encode(filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS));
    $uf = filter_input(INPUT_POST, "uf",FILTER_SANITIZE_SPECIAL_CHARS);
    $email = utf8_encode(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $telefone = $_POST["telefone"];

    /* validação dos campos do formulário */
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "<label>O e-mail informado não é válido.</label><br>";
    }
    if (!filter_var($numero, FILTER_VALIDATE_INT)) {
        $erros[] = "<label>O <b>número</b> de endereço informado não é válido.</label><br>";
    }
    if(strlen($cep) != 9) {
        $erros[] = "<label>O CEP informado não é válido.</label><br>";
    }
    if(strlen($telefone) < 13) {
        $erros[] = "<label>O número de <b>telefone</b> informado não é válido.</label><br>";
    }

    /*  validação do cnpj da empresa */
    if(!validaCnpj(limpaDocumento($cnpj))) {
        $erros[] = "<label>O CNPJ informado não é válido.</label><br>";
    }

    if(empty($razaoSocial) || empty($email) || empty($telefone) || empty($cnpj) || empty($cep) || empty($logradouro) || empty($numero) || empty($bairro) || empty($cidade) || empty($uf)) {
        $erros[] = "<label>Por favor, preencha todos os dados solicitados.</label><br>";
    }
    
    if(!empty($erros)) {      
        mysqli_close($con);
        $_SESSION["erros"] = $erros;
        header("Location: form_cad_fornecedor.php");
    }
    else {
        switch ($op) {
            case "Cadastrar Fornecedor":
                if($post->registerFornecedor($razaoSocial, $cnpj, $email, $telefone, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf)) {
                    mysqli_close($con);
                    $_SESSION["success"] = true;
                    header("Location: consulta_fornecedor.php");
                }
                else {
                    $erros[] = "Não foi possível cadastrar o fornecedor. Tente novamente.";
                    $_SESSION["erros"] = $erros;
                    header("Location: form_cad_fornecedor.php");
                }
                break;
            case "Atualizar Registro":
                $id = $_POST["id"];
                if($post->updateFornecedor($razaoSocial, $cnpj, $email, $telefone, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf, $id)) {
                    mysqli_close($con);
                    header("Location: consulta_fornecedor.php");
                }
                else {
                    $erros[] = "Não foi possível alterar o registro. Tente novamente.";
                    $_SESSION["erros"] = $erros;
                    header("Location: update_fornecedor.php?id=$id&op=leitura");
                }
                break;
        }
    }
    
}

?>