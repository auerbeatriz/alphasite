<!DOCTYPE html>
  <html>
    <head>
        <meta charset ="utf-8">
        <title> Pomar Hortifruti </title>
        <link href="css/style.css" rel="stylesheet">
        <!-- Aqui alteramos o titulo da página para o nome do usuário logado -->
        <script type="text/javascript">
            document.title = "<?=$nome?>"
        </script> 
    </head>
    <body>
        <figure></figure>
        <nav class="menu">
            <ul>
                <li><a href="home.php"> home </li>
                <li> consulta 
                    <ul>
                        <li> fornecedores </li>
                        <li> clientes </li>
                        <li> produtos </li>
                        <li> vendas </li>
                        <li> caderneta </li>
                    </ul>
                </li>
                <li> cadastro 
                    <ul>
                        <li><a href="form_cad_fornecedor.php"> fornecedor </a></li>
                        <li><a href="form_cad_cliente.php"> cliente </a></li>
                        <li><a href="form_cad_produto.php"> produto <a></li>
                        <li><a href="form_cad_venda.php"> venda </a></li>
                        <li><a href="form_cad_caderneta.php"> caderneta </a></li>
                    </ul>
                </li>
                <li> gerenciar adms </li>
                <li><a href="close_session.php"> sair </a></li>
            </ul>
        </nav>
