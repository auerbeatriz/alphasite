<?php

include_once("header.php");
session_start();

?>
    <h1>Login</h1>

    <div id="erros">
        <?php
        if(!empty($_SESSION["erros"])) {
            foreach($_SESSION["erros"] as $erro) {
                echo $erro;
            }
        }        
        ?>
    </div>

    <form id="login" action="login.php" method="POST">
        <label for="adm">Nome de adm: </label>
        <input type="text" name="adm"> <br>

        <label for="senha">Senha: </label>
        <input type="password" name="senha"> <br>

        <input type="submit" name="btn-login" value="Entrar">
    </form>
</body>
</html>
