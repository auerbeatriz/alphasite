<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");

if(isset($_SESSION["success"]) && $_SESSION["success"]) {
    echo "<script type='text/javascript'> alert('Venda cadastrada com sucesso!') </script>";
    unset($_SESSION["success"]);
}

?>

<h1> Registros de vendas </h1>

<form action="" method="post" class="busca">
    <label for="busca_nota">Número da nota:</label>
    <input type="search" id="busca_nota" name="nota">

    <label for="busca_codigo">Cliente:</label>
    <input type="search" id="busca_cliente" name="cliente">

    <label for="busca_data">Data da venda:</label>
    <input type="date" id="busca_data" name="data">

    <input type="submit" name="filtragem" value="Filtrar"></input>
</form>
<br>

<?php
if(isset($_POST["filtragem"])) {
    $nota = $_POST["nota"];
    $cliente = $_POST["cliente"];
    $data = $_POST["data"];
    $vendas = $post->getVendasInFilter($nota, $cliente, $data);
} else {
    $vendas = $post->getVendas();
}

while ($venda = mysqli_fetch_assoc($vendas)) {
  
    if(filter_var($venda["numero_nota"], FILTER_VALIDATE_INT)) {
        $numeroNota = $venda["numero_nota"];
        $obs = strtoupper(filter_var($venda["obs"], FILTER_SANITIZE_SPECIAL_CHARS));
        $data = date_format(date_create($venda["data"]), "d/m/Y");

        if(!is_null($venda["cliente"])) {
            $cliente = utf8_encode(strtoupper(filter_var($venda["cliente"], FILTER_SANITIZE_SPECIAL_CHARS)));
        } else {
            $cliente = "Não informado";
        }

        echo "
        <div class='nota'>
            </label> <label class='excluir'> <a href='excluir.php?campo=numero_nota&id=$numeroNota&op=venda'>excluir</a></label><br><br>
            <label><b>Número da nota:</b> ".$numeroNota."</label> <br>
            <label><b>Data:</b> ".$data."</label><br>
            <label><b>Cliente:</b> ".$cliente."</label><br>
            <label><b>Observação:</b> ".$obs."</label><br>

            <hr noshade='noshade'>
            
            <table class='reciboVenda'>
                <th>Qtd</th>
                <th>Descricao</th>
                <th>V. Uni.</th>
                <th>Total</th>
            ";

        $produtosVenda = $post->getProdutosVenda($numeroNota);
        while ($produto = mysqli_fetch_assoc($produtosVenda)) {
            $nomeProduto = filter_var($produto["nome_produto"], FILTER_SANITIZE_SPECIAL_CHARS);
            $qtd = $produto["qtd"];
            $preco = number_format($produto["valor_unitario"], 2);
            $total = number_format($qtd * $preco, 2);
            echo " <tr>
                        <td>$qtd</td>
                        <td>$nomeProduto</td>
                        <td>$preco</td>
                        <td>$total</td>            
            </tr>";
        }

        echo "</table>
        <hr noshade='noshade'>
            <label>Total: R$".number_format($venda["total"], 2)."</label>
        </div>";
    }
    else {
        echo "<div class='nota'>
        <label class='excluir'> <a href='excluir.php?id=$numeroNota&op=venda&campo=numero_nota'>excluir</a></label><br>
        <label>Foram encontrados dados inválidos para essa nota. Por motivos de segurança, ela não será exibida.</label>
        </div>";
    }
    
    
}

mysqli_close($con);
include_once("footer.php");
?>
