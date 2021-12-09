<?php

require_once("config.php");
require_once("post.php");

session_start();

$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");
?>

<h2> Vendas: R$0,00</h2>
<h2> Caderneta: R$0,00</h2>

<label><i>Uma frase inspiradora</i></label>
<?php
include_once("footer.php");
?>