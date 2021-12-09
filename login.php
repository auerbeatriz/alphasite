<?php
require_once("config.php");
include_once("post.php");

session_start();

if(isset($_POST["btn-login"])) {
    $erros = array();
    $post = new Post($con);

    $adm = mysqli_escape_string($con, $_POST["adm"]);
    $senha = mysqli_escape_string($con, $_POST["senha"]);

    if(!empty($adm) and !empty($senha)) {
        if($post->admExists($adm)) {
            $result = $post->passwordIsCorrect($adm, md5($senha));
            if(mysqli_num_rows($result) > 0) {
                $_SESSION["logado"] = true;
                $_SESSION["id"] = mysqli_fetch_array($result)["id"];
                $_SESSION["erros"] = null;

                mysqli_close($con);
                header("Location: home.php");
            }
            else {
                array_push($erros, "<label>Senha incorreta</label><br>");
            }
        }
        else {
            array_push($erros, "<label>Adm não encontrado na base de dados</label><br>");
        }
    }
    else {
        array_push($erros, "<label>Email ou senha não informados</label><br>");
    }

    if(!empty($erros)) {
        $_SESSION["erros"] = $erros;
        mysqli_close($con);
        header("Location: index.php");
    }   
    
}

?>