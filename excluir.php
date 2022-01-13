<?php

require_once("config.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

if(isset($_GET["op"]) && isset($_GET["id"])) {
    $result = $post->exclude($_GET["campo"], $_GET["id"], $_GET["op"]);
    
    $pg = "Location: consulta_".$_GET["op"].".php";
    header($pg);
}
else {
    $anterior = $_SERVER['HTTP_REFERER'];
    header("Location: $anterior");
}

?>