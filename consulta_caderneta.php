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
    
    $cliente = utf8_encode(strtoupper(filter_var($registro["cliente"], FILTER_SANITIZE_SPECIAL_CHARS)));
    $produto = utf8_encode(filter_var($registro["produto"], FILTER_SANITIZE_SPECIAL_CHARS));
    $data = date_format(date_create($registro["data"]), "d/m/Y");

    if(filter_var($registro["qtd"], FILTER_VALIDATE_FLOAT)) {
        echo "<label><b>".$cliente."</b></label><br>
        <label>Data: ".$data."</label></br>
        <label>".$registro["qtd"]." ".$produto."</label><br>
        <label>Total: R$".number_format($registro["total"], 2)."<label><br>
        <label>Observação: ".$registro["obs"]."</label><hr>";
    }
    else {
        echo "<label><b>".$cliente."</b></label><br>
        <label>Data: ".$data."</label></br>
        <label>".$produto."</label><br>
        <label>Total: R$".$registro["total"]."<label><br>
        <label>Observação: ".$registro["obs"]."</label><br>
        <label><i>A quantidade informada não é válida. Por questões de segurança, não será exibido.</i></label><hr>";
    }
}

mysqli_close($con);
include_once("footer.php");
?>
