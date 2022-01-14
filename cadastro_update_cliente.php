

<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
if(isset($_POST["btn-cli"])) {
    $op = trim($_POST["btn-cli"]);

    $erros = array();
    $post = new Post($con);

    /* sanitização dos campos do formulário */
    
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_NUMBER_INT);
    $logradouro = filter_input(INPUT_POST, "logradouro", FILTER_SANITIZE_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_NUMBER_INT);
    $complemento = filter_input(INPUT_POST, "complemento", FILTER_SANITIZE_SPECIAL_CHARS);
    $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS);
    $uf = filter_input(INPUT_POST, "uf",FILTER_SANITIZE_SPECIAL_CHARS);

    /* validação dos campos do formulário */
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "<label>O e-mail informado não é válido.</label><br>";
    }
    if(strlen($telefone) < 13) {
        $erros[] = "<label>O número de <b>telefone</b> informado não é válido.</label><br>";
    }
    if (!empty($numero) && !filter_var($numero, FILTER_VALIDATE_INT)) {
        $erros[] = "<label>O <b>número</b> de endereço informado não é válido.</label><br>";
    }
    if(!empty($cep) && (strlen($cep) != 9)) {
        $erros[] = "<label>O CEP informado não é válido.</label><br>";
    }

    /*  validação do cnpj da empresa */
    if(!empty($cpf) && !validaCpf(limpaDocumento($cpf))) {
        $erros[] = "<label>O CPF informado não é válido.</label><br>";
    }

    /* verificando campos requeridos */
    if(empty($nome) || empty($telefone)) {
        $erros[] = "<label>Por favor, preencha todos os dados solicitados.</label><br>";
    }

    if(!empty($erros)) {
        mysqli_close($con);
        $_SESSION["erros"] = $erros;
        header("Location: form_cad_cliente.php");
    }
    else {
        switch ($op) {
            case "Cadastrar Cliente":
                if($post->registerCliente($nome, $email, $telefone, $cpf, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf)) {
                    mysqli_close($con);
                    header("Location: consulta_cliente.php");
                }
                else {
                    $erros[] = "Não foi possível cadastrar o cliente. Tente novamente.";
                    $_SESSION["erros"] = $erros;
                    header("Location: form_cad_cliente.php");
                }
                break;
            case "Atualizar Registro":
                $id = $_POST["id"];
                if($post->updateCliente($nome, $email, $telefone, $cpf, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf, $id)) {
                    mysqli_close($con);
                    header("Location: consulta_cliente.php");
                }
                else {
                    $erros[] = "Não foi possível alterar o registro. Tente novamente.";
                    $_SESSION["erros"] = $erros;
                    header("Location: update_cliente.php?id=$id&op=leitura");
                }
                break;
        }
    }
}

?>