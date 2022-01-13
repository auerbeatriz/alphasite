<?php

require_once("config.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

if(isset($_GET["op"]) && isset($_GET["id"])) {
    switch ($_GET["op"]) {
        case "caderneta":
            $result = $post->editCaderneta($_GET["id"]);
            var_dump($result);
            header("Location: consulta_caderneta.php");
            break;
    }
}
else {
    $anterior = $_SERVER['HTTP_REFERER'];
    header("Location: $anterior");
}

?>