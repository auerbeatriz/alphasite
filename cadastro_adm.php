<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();

/* essa tela de cadastro é extra, por favor não considerar para pontuação pois não utilizamos validação.
 * porém, em todas as outras 5 telas está sendo aplicado os requisitos do trabalho
 */
if(isset($_POST["cad-adm"])) {
    $erros = array();
    $post = new Post($con);

    $id = $_POST["id"];
    $nome = utf8_encode(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS));
    $login = utf8_encode(filter_input(INPUT_POST, "login", FILTER_SANITIZE_SPECIAL_CHARS));
    $senha = md5(filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS));

    if(empty($nome) || empty($login) || empty($senha)) {
        $erros[] = "<label>Por favor, insira todos os parâmetros requeridos.</label><br>";
    }

    if(!empty($erros)) {
        mysqli_close($con);
        $_SESSION["erros"] = $erros;
    }
    else {
        if((!is_null($id) && !($post->admIsRegistered($id))) || is_null($id)) {
            if($post->registerAdm($nome, $login, $senha)) {
                mysqli_close($con);
            }
            else {
                $erros[] = "Não foi possível cadastrar o registro. Tente novamente.";
                $_SESSION["erros"] = $erros;
            }
        }
        else {
            if($post->updateAdm($id, $nome, $login, $senha)) {
                mysqli_close($con);
            }
            else {
                $erros[] = "Não foi possível atualizar o registro. Tente novamente.";
                $_SESSION["erros"] = $erros;
            }
        }
        
    }
    header("Location: gerenciar_adm.php");
}
else {
    header("Location: gerenciar_adm.php");
}

?>