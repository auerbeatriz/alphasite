<html>
    <head>
        <meta charset ="utf-8">
        <title>Menu dropdown</title>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <nav class="menu">
            <ul>
                <li><a href="home.php"> home </li>
                <li> consulta 
                    <ul>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=conFor"> fornecedores </a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=conCli"> clientes </a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=conPro"> produtos <a></li>
                        <li> vendas </li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=conCad"> caderneta </a></li>
                    </ul>
                </li>
                <li> cadastro 
                    <ul>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=cadFor"> fornecedor </a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=cadCli"> cliente </a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=cadPro"> produto <a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=cadVen"> venda </a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=cadCad"> caderneta </a></li>
                    </ul>
                </li>
                <li> gerenciar adms </li>
                <li><a href="close_session.php"> sair </a></li>
            </ul>
        </nav>

        <div>
            <img src="arquivos/alface.jpg" height="150px"><br>
            <label>ALFACE <b>R$1,00</b></label><br>
            <input type="number" name="qtd" placeholder="quantidade">
            <a id="venda" href="<?=$_SERVER['PHP_SELF']?>?"> Adicionar </a>

        </div>
    </body>
</html>