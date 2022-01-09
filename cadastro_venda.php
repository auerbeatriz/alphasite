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
    $produtos = $_SESSION["cesta"];

    //  obtem o numero da nota que sera salva e o total da compra
    $numeroNota = (int) $post->getLastVenda() + 1;
    $total = 0;
    foreach($produtos as $key=>$value) {
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

    if(is_null($produtos)) {
        $erros[] = "<label>A cesta está vazia.</label><br>";
    }
    if(empty($data)) {
        $erros[] = "<label>Por favor, preencha todos os campos requeridos.</label><br>";
    }
    
    /* redirecionamento */
   if(!empty($erros)) {
        mysqli_close($con);
        $_SESSION["erros"] = $erros;
        header("Location: form_cad_venda.php");
    }
    else {
        //  TODO: cadastro da empresa
        if($post->registerVenda($numeroNota, $data, $cliente, $total, $obs, $produtos)) {
            mysqli_close($con);
            header("Location: home.php");
        }
        else {
            $erros[] = "Não foi possível cadastrar a venda. Tente novamente.";
            $_SESSION["erros"] = $erros;
            header("Location: form_cad_venda.php");
        }
    }
}



?>