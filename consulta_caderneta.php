<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");

echo "<h1> Registros na caderneta </h1>";

$registros = $post->getCaderneta();
while ($registro = mysqli_fetch_assoc($registros)) {
    listRegistrosCaderneta($registro);
}

mysqli_close($con);
include_once("footer.php");
?>
