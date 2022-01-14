<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();

if(isset($_POST["btn-cad"])) {
    $op = trim($_POST["btn-cad"]);

    $erros = array();
    $post = new Post($con);

    /* obtenção/sanitização dos campos do formulário */
    $data = $_POST["data"];
    $cliente = $_POST["cliente"]; //id
    $produto = $_POST["produto"]; //id
    $qtd = filter_input(INPUT_POST, "qtd", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $total = filter_input(INPUT_POST, "total", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $obs = filter_input(INPUT_POST, "obs", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $nomeProduto = $post->getProdutoName($produto);

    /* validação dos campos do formulário */
    if (!filter_var($qtd, FILTER_VALIDATE_FLOAT)) {
        $erros[] = "<label>A quantidade informada não é válida.</label><br>";
    }
    if (!filter_var($total, FILTER_VALIDATE_FLOAT)) {
        $erros[] = "<label>O valor total informado não é válido.</label><br>";
    }
    if (!filter_var($cliente, FILTER_VALIDATE_INT)) {
        $erros[] = "<label>Não foi possível localizar o cliente informado.</label><br>";
    }
    if (!filter_var($produto, FILTER_VALIDATE_INT)) {
        $erros[] = "<label>Não foi possível localizar o produto informado.</label><br>";
    }

    if(empty($data) || empty($cliente) || empty($produto) || empty($qtd)) {
        $erros[] = "<label>Por favor, preencha todos os campos requeridos.</label><br>";
    }
    
    if(!empty($erros)) {
        mysqli_close($con);
        $_SESSION["erros"] = $erros;
        header("Location: form_cad_caderneta.php");
    }
    else {
        if(!is_null($nomeProduto)) {
            switch ($op) {
                case "Cadastrar Registro":
                    if($post->registerCaderneta($cliente, $produto, $nomeProduto, $qtd, $data, $total, $obs)) {
                        mysqli_close($con);
                        header("Location: consulta_caderneta.php");
                    }
                    else {
                        $erros[] = "Não foi possível cadastrar o registro. Tente novamente.";
                        $_SESSION["erros"] = $erros;
                        header("Location: form_cad_caderneta.php");
                    }
                    break;
                case "Atualizar Registro":
                    $id = $_POST["id"];
                    if($post->updateCaderneta($cliente, $produto, $nomeProduto, $qtd, $data, $total, $obs, $id)) {
                        mysqli_close($con);
                        header("Location: consulta_caderneta.php");
                    }
                    else {
                        $erros[] = "Não foi possível alterar o registro. Tente novamente.";
                        $_SESSION["erros"] = $erros;
                        header("Location: update_caderneta.php?id=$id&op=leitura");
                    }
                    break;
            }
        }
        else {
            $erros[] = "Não foi possível cadastrar o registro. Tente novamente.";
            $_SESSION["erros"] = $erros;
            header("Location: form_cad_caderneta.php");
        }
    }
}

?>