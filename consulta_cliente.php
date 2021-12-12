<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");

echo "<h1> Clientes </h1>";

$clientes = $post->getClientes();
while ($cliente = mysqli_fetch_assoc($clientes)) {
    listClienteData($cliente);
}

mysqli_close($con);
include_once("footer.php");
?>
