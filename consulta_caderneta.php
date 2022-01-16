<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");

if(isset($_SESSION["success"]) && $_SESSION["success"]) {
    echo "<script type='text/javascript'> alert('Registro de caderneta cadastrado com sucesso!') </script>";
    unset($_SESSION["success"]);
}

?>

<h1> Registros na caderneta </h1>

<form action="" method="post" class="busca">
        <label for="busca_cliente">Cliente:</label>
        <input type="search" id="busca_cliente" name="cliente">

        <label for="busca_data">Data:</label>
        <input type="date" id="busca_data" name="data">

        <input type="submit" name="filtragem" value="Filtrar"></input>
</form>
<br>

<table class="consulta">
    <tr>
        <th class='col'>DATA</th>
        <th class='col'>CLIENTE</th>
        <th class='col'>PRODUTO</th>
        <th class='col'>TOTAL</th>
        <th class='col'>OBS</th>
        <th class='col'>Ações</th>
</tr>

<?php

if(isset($_POST["filtragem"])) {
    $cliente = $_POST["cliente"];
    $data = $_POST["data"];
    $registros = $post->getCadernetaInFilter($cliente, $data);
} else {
    $registros = $post->getCaderneta();
}

while ($registro = mysqli_fetch_assoc($registros)) {
    
    $id = $registro["id"];
    $cliente = utf8_encode(strtoupper(filter_var($registro["cliente"], FILTER_SANITIZE_SPECIAL_CHARS)));
    $produto = utf8_encode(filter_var($registro["produto"], FILTER_SANITIZE_SPECIAL_CHARS));
    $data = date_format(date_create($registro["data"]), "d/m/Y");

    if(filter_var($registro["qtd"], FILTER_VALIDATE_FLOAT)) {
        $qtd = $registro["qtd"];
    } else { $qtd = ""; }

    echo "
        <tr class='linha'>
            <td class='col'>$data</td>
            <td class='col'>".$cliente."</td>
            <td class='col'>".$qtd." ".$produto."</td>
            <td class='col'>R$".number_format($registro["total"], 2)."</td>
            <td class='col'>".$registro["obs"]."</td>
            <td class='col'> <label class='editar'> <a href='update_caderneta.php?id=$id&op=leitura'>editar</a></label> <label class='excluir'><a href='excluir.php?campo=id&id=$id&op=caderneta'>excluir</a></label> </td>
        </tr>";
}?></table><?php

mysqli_close($con);
include_once("footer.php");
?>
