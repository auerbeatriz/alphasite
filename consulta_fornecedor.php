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
        
        $razaoSocial = utf8_encode(strtoupper(filter_var($fornecedor["razao_social"], FILTER_SANITIZE_SPECIAL_CHARS)));
        $logradouro = utf8_encode(filter_var($fornecedor["logradouro"], FILTER_SANITIZE_SPECIAL_CHARS));
        $complemento = utf8_encode(filter_var($fornecedor["complemento"], FILTER_SANITIZE_SPECIAL_CHARS));
        $bairro = utf8_encode(filter_var($fornecedor["bairro"], FILTER_SANITIZE_SPECIAL_CHARS));
        $cidade = utf8_encode(filter_var($fornecedor["cidade"], FILTER_SANITIZE_SPECIAL_CHARS));
        $uf = strtoupper(filter_var($fornecedor["uf"],FILTER_SANITIZE_SPECIAL_CHARS));

        if(filter_var($fornecedor["numero"], FILTER_VALIDATE_INT)) {
            echo "<label><b>".$razaoSocial."</b></label><br>
            <label class='center'>".$logradouro.", ".$fornecedor["numero"].", ".$complemento." - ".$bairro." - ".$cidade." - ".$uf." - CEP: ".$fornecedor["cep"]."</label><br>
            <label>CNPJ: ".$fornecedor["cnpj"]."<label><br>
            <label>E-mail: ".utf8_encode($fornecedor["email"])."<label><br>
            <label>Telefone: ".$fornecedor["telefone"]."<label><hr>";
        }
        else {
            echo "<label><b>".$razaoSocial."</b></label><br>
            <label>".$logradouro.", ".$complemento." - ".$bairro." - ".$cidade." - ".$uf." - CEP: ".$fornecedor["cep"]."</label><br>
            <label>CNPJ: ".$fornecedor["cnpj"]."<label><br>
            <label>E-mail: ".utf8_encode($fornecedor["email"])."<label><br>
            <label>Telefone: ".$fornecedor["telefone"]."<label><br>
            <label><i>O número do endereço não é válido. Por questões de segurança, não será exibido.</i></label><hr>";
        } 
    }

    include_once("footer.php");
}
else {
    header("Location: index.php");
}

mysqli_close($con);
?>
