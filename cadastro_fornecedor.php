<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();

if(isset($_POST["btn-cad-forn"])) {
    $erros = array();
    $post = new Post($con);    

    /* sanitização dos campos do formulário */
    $razaoSocial = filter_input(INPUT_POST, "razaoSocial", FILTER_SANITIZE_SPECIAL_CHARS);
    $cnpj = filter_input(INPUT_POST, "cnpj", FILTER_SANITIZE_NUMBER_INT);    
    $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_NUMBER_INT);
    $logradouro = filter_input(INPUT_POST, "logradouro", FILTER_SANITIZE_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_NUMBER_INT);
    $complemento = filter_input(INPUT_POST, "complemento", FILTER_SANITIZE_SPECIAL_CHARS);
    $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS);
    $uf = filter_input(INPUT_POST, "uf",FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_NUMBER_INT);

    /* validação dos campos do formulário */
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "<label>O e-mail informado não é válido.</label>";
    }
    if (!filter_var($numero, FILTER_VALIDATE_INT)) {
        $erros[] = "<label>O <b>número</b> de endereço informado não é válido.</label>";
    }

    /*  validação do cnpj da empresa */
    if(!validaCnpj($cnpj)) {
        $erros[] = "<label>O CNPJ informado não é válido.</label>";
    }
    
    if(!empty($erros)) {
        $_SESSION["erros"] = $erros;
        mysqli_close($con);
        header("Location: form_cad_fornecedor.php");
    }
    else {
        //  TODO: cadastro da empresa
        header("Location: home.php");
    }
}

?>