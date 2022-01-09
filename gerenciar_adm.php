<?php

require_once("config.php");
include_once("util.php");
require_once("post.php");

session_start();

if(isset($_SESSION["logado"]) && $_SESSION["logado"]) {

    $post = new Post($con);
    $nome = $post->getAdmName($_SESSION["id"]);

    require_once("headerA.php");

    /* exiição dos adms cadastrados no sistema */
    echo "<h1>Administradores do sistema</h1>";

    echo "<table>
    <tr>
        <th>Nome</th>
        <th>Login</th>
    </tr>";
    $adms = $post->getAdms();
    while ($adm = mysqli_fetch_assoc($adms)) {
        listAdm($adm);
    }
    echo "</table>";

    /* formulário para criar um novo adm */

?>
   <h2>Adicionar novo administrador do sistema</h2>

   <div class="erros">
        <?=exibeErros($_SESSION["erros"])?>
    </div><br>

   <form action="cadastro_adm.php" class="cad" method="POST">
    <div class = table>
    <p>
       <label for="nome">Nome: </label>
       <input class="campo" type="text" name="nome"></br>
    </p>
    <p>
       <label for="login">Login: </label>
       <input class="campo" type="text" name="login"></br>
    </p>
    <p>
       <label for="nome">Senha: </label>
       <input class="campo" type="password" name="senha"></br>
    </p>
    </div>
       <input class="botao" type="submit" name="cad-adm" value="Cadastrar"></br>
   </form>

<?php
    include_once("footer.php");
}
else {
    header("Location: index.php");
}
mysqli_close($con);
?>