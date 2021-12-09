<?php
require_once("config.php");
include_once("post.php");

session_start();

if(isset($_POST["btn-login"])) {
    $erros = array();
    $post = new Post($con);

    $adm = mysqli_escape_string($con, $_POST["adm"]);
    $senha = md5(mysqli_escape_string($con, $_POST["senha"]));

    if(!empty($adm) && !empty($senha)) {
        if($post->admExists($adm)) {
            if($post->passwordIsCorrect($adm, $senha)) {
                $_SESSION["logado"] = true;
                $_SESSION["code"] = $adm; //o campo 'adm' é a chave primária da tabela
                header("Location: home.php");
            }
            else {
                array_push($erros, "<label>Senha incorreta</label><br>");
            }
        }
        else {
            array_push($erros, "<label>ADM não encontrado na base de dados</label><br>");
        }
    }
    else {
        array_push($erros, "<label>Email ou senha não informados</label><br>");
    }

    if(!empty($erros)) {
        $_SESSION["erros"] = $erros;
        header("Location: index.php");
    }   
    
}

?>