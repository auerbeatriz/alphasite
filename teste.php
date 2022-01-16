
<?php
require_once("config.php");
include_once("util.php");
require_once("post.php");

session_start();

$post = new Post($con);
$result = $post->getClientesInFilter("REGINA MÁRCIA MONTEIRO", null);
$result = mysqli_query($con, "SELECT * FROM `cliente` WHERE nome like '%Breno Marcos Galvão%';");
var_dump($result);
while($cliente = mysqli_fetch_array($result)) {
    echo $cliente["nome"];
}
mysqli_close($con);
?>