<?php

require_once("config.php");
require_once("post.php");

session_start();

/*  todo o código da página só será exibido caso ele esteja logado
 * Se não estiver, ele será redirecionado para a página index.html, onde há o formulário de login
 */
if(isset($_SESSION["logado"]) && $_SESSION["logado"]) {
    $post = new Post($con);
    $nome = $post->getAdmName($_SESSION["id"]);

    require_once("headerA.php");

    $vendas = $post->getValorTotalVendas();
    $caderneta = $post->getValorTotalCaderneta();

    echo "<h2> Vendas: R$ ".number_format($vendas, 2)."</h2>";
    echo "<h2> Caderneta: R$ ".number_format($caderneta, 2)."</h2>";
    
    include_once("footer.php");
}
else {
    header("Location: index.php");
}
mysqli_close($con);
?>