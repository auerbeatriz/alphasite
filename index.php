<style>
<?php include 'CSS/style.css'; ?>
</style>
<?php
include_once("header.php");

session_start();

if(isset($_SESSION["logado"]) && $_SESSION["logado"]) {
    header("Location: home.php");
}
?>

<article>

<div id="login">
    <div id="titulo"> 
        <label>Login</label>
    </div>

    <form id="login" action="login.php" method="POST">
    <div id="erros">
       <?php
       if(!empty($_SESSION["erros"])) {
           foreach($_SESSION["erros"] as $erro) {
               echo '<p class="erro">' . $erro . '</p>';
           }
       }        
       ?>
    </div>
        <input class="campo" type="text" name="adm" placeholder="Nome de Admin"><br>
        <input class="campo" type="password" name="senha" placeholder="Senha"><br>

        <input class="botao" type="submit" name="btn-login" value="Entrar">
    </form>
</div>

</article>

<?php
include_once("footer.php");
?>