<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();

if(isset($_POST["btn-cad-cli"])) {
    $erros = array();
    $post = new Post($con);    

    /* sanitização dos campos do formulário */
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_NUMBER_INT);
    $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_NUMBER_INT);
    // não obrigatórios:
    $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_NUMBER_INT);
    $logradouro = filter_input(INPUT_POST, "logradouro", FILTER_SANITIZE_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_NUMBER_INT);
    $complemento = filter_input(INPUT_POST, "complemento", FILTER_SANITIZE_SPECIAL_CHARS);
    $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS);
    $uf = filter_input(INPUT_POST, "uf",FILTER_SANITIZE_SPECIAL_CHARS);

    /* validação dos campos do formulário */
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "<label>O e-mail informado não é válido.</label><br>";
    }
    if(strlen($telefone) < 10) {
        $erros[] = "<label>O número de <b>telefone</b> informado não é válido.</label><br>";
    }
    if (!empty($numero) && !filter_var($numero, FILTER_VALIDATE_INT)) {
        $erros[] = "<label>O <b>número</b> de endereço informado não é válido.</label><br>";
    }
    if(!empty($cep) && (strlen($cep) != 8 || !filter_var($cep, FILTER_VALIDATE_INT))) {
        $erros[] = "<label>O CEP informado não é válido.</label><br>";
    }

    /*  validação do cnpj da empresa */
    if(!validaCpf($cpf)) {
        $erros[] = "<label>O CPF informado não é válido.</label><br>";
    }

    /* verificando campos requeridos */
    if(empty($nome) || empty($email) || empty($telefone) || empty($cpf)) {
        $erros[] = "<label>Por favor, preencha todos os dados solicitados.</label><br>";
    }
    
    if(!empty($erros)) {
        $_SESSION["erros"] = $erros;
        mysqli_close($con);
        header("Location: form_cad_cliente.php");
    }
    else {
        //  TODO: cadastro do cliente
        header("Location: home.php");
    }
}

?>