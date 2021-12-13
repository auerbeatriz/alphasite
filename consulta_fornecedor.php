<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();

/*  todo o código da página só será exibido caso ele esteja logado
 * Se não estiver, ele será redirecionado para a página index.html, onde há o formulário de login
 */
if(isset($_SESSION["logado"]) && $_SESSION["logado"]) {
    $post = new Post($con);
    $nome = $post->getAdmName($_SESSION["id"]);

    require_once("headerA.php");

    echo "<h1> Fornecedores </h1>";

    $fornecedores = $post->getFornecedores();
    while ($fornecedor = mysqli_fetch_assoc($fornecedores)) {
        listFornecedorData($fornecedor);
    }

    include_once("footer.php");
}
else {
    header("Location: index.php");
}

mysqli_close($con);
?>
