<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();

if(isset($_POST["btn-cad-cad"])) {
    $erros = array();
    $post = new Post($con);

    /* obtenção/sanitização dos campos do formulário */
    $data = $_POST["data"];
    $cliente = $_POST["cliente"]; //id
    $produto = $POST["produto"]; //id
    $qtd = filter_input(INPUT_POST, "qtd", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    

    /* validação dos campos do formulário */
    if (!filter_var($codigo, FILTER_VALIDATE_INT)) {
        $erros[] = "<label>O código de barras informado não é válido.</label><br>";
    }
    if (!filter_var($preco, FILTER_VALIDATE_FLOAT)) {
        $erros[] = "<label>O preço informado informado não é válido.</label><br>";
    }

    /* upload do arquivo */
    if(isset($_FILES["foto"])) {
        $formatosPermitidos = array("png", "jpeg", "jpg");
        $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);

        if(in_array($ext, $formatosPermitidos)) {
            $path = "arquivos/";
            $tmp = $_FILES["foto"]["tmp_name"];
            $name = uniqid().".$ext";

            if(!move_uploaded_file($tmp, $path.$name)) {
                $erros[] = "<label>Não foi possível realizar o upload da imagem.</label><br>";
            }
        }
        else {
            $erros[] = "<label>O formato do arquivo não é permitido. Escolha apenas arquivos do tipo png, jpg ou jpeg.</label><br>";
        }
    }
    else {
        $erros[] = "<label>O arquivo de imagem não foi selecionado.</label><br>";
    }

    if(!empty($erros)) {
        $_SESSION["erros"] = $erros;
        mysqli_close($con);
        header("Location: form_cad_produto.php");
    }
    else {
        //  TODO: cadastro da empresa
        header("Location: home.php");
    }
}

?>