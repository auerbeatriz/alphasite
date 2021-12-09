<?php

include_once("header.php");
require_once("config.php");
require_once("post.php");

session_start();

$post = new Post($con);
?>

<!-- Aqui alteramos o titulo da página para o nome do usuário logado -->
<script type="text/javascript">
    document.title = "<?=$post->getAdmName($_SESSION["adm"]);?>"
</script> 

<div id="cabeçalho">
    <figure></figure>
    <nav>

    </nav>
</div>
</body>
</html>