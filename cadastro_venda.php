<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();

if(isset($_POST["btn-cad-venda"])) {
    $erros = array();
    $post = new Post($con);

    /* sanitização dos campos do formulário */
    $cliente = filter_input(INPUT_POST, "cliente", FILTER_SANITIZE_NUMBER_INT); //id
    $obs = filter_input(INPUT_POST, "obs", FILTER_SANITIZE_SPECIAL_CHARS);
    $data = $_POST["data"];

    //  obtem o numero da nota que sera salva e o total da compra
    $numeroNota = (int) $post->getLastVenda() + 1;
    $total = 0;
    foreach($_SESSION["cesta"] as $key=>$value) {
        $total += (float) $value["total"];
    }

    /* validação dos campos do formulário */
    if (!filter_var($cliente, FILTER_VALIDATE_INT)) {
        if(strcmp($cliente, "0") !=0) {
            $erros[] = "<label>Não foi possível localizar o cliente.</label><br>";
        }
    }
    if (!filter_var($total, FILTER_VALIDATE_FLOAT)) {
        $erros[] = "<label>Não foi possível calcular o valor total da compra.</label><br>";
    }

    if(is_null($_SESSION["cesta"])) {
        $erros[] = "<label>A cesta está vazia.</label><br>";
    }
    if(empty($data)) {
        $erros[] = "<label>Por favor, preencha todos os campos requeridos.</label><br>";
    }

    foreach($_SESSION["cesta"] as $key=>$value) {
        if(!empty($value["id"]) && !empty($value["qtd"])) {
            // cadastra produto_venda
        }
        else {
            $erros[] = "<label>Não foi possível cadastrar a compra, pois faltam dados de alguns produtos selecionados.</label><br>";
        }
    } 
    
    /* redirecionamento */
    if(!empty($erros)) {
        mysqli_close($con);
        $_SESSION["erros"] = $erros;
        header("Location: form_cad_venda.php");
    }
    else {
        //  TODO: cadastro da empresa
        unset($_SESSION["cesta"]);
        $_SESSION["success"] = 1;
        header("Location: form_cad_venda.php");
    }
}



?>