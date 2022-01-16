<?php

class POST {

    private $conn;
    
    public function __construct($db){
		$this->conn = $db;
	}

    public function admExists($adm) {
        $query = "SELECT login FROM administradores WHERE login = '" . $adm . "'";
        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return (mysqli_num_rows($result) > 0);
    }

    public function admIsRegistered($id) {
        $query = "SELECT id FROM administradores WHERE id = '" . $id . "'";
        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return (mysqli_num_rows($result) > 0);
    }

    public function passwordIsCorrect($adm, $password) {
        $query = "SELECT * FROM administradores WHERE login = '" . $adm . "' AND senha = '" . $password . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    /* consultas */

    public function getAdmName($id) {
        $query = "SELECT nome FROM administradores WHERE id = " . $id . ";";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_array($result)["nome"];
    }

    public function getFornecedoresName() {
        $query = "SELECT id, razao_social FROM fornecedor;";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getClientsName() {
        $query = "SELECT id, nome FROM cliente;";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getProductsName() {
        $query = "SELECT id, nome FROM produto;";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getAdms() {
        $query = "SELECT id, nome, login FROM administradores;";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getFornecedores() {
        $query = "SELECT * FROM fornecedor";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getSpecificFornecedor($id){
        $query = "SELECT * FROM fornecedor WHERE id = $id;";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_array($result);
    }

    public function getClientes() {
        $query = "SELECT * FROM cliente";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getSpecificCliente($id) {
        $query = "SELECT * FROM cliente WHERE id = $id;";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_array($result);
    }

    public function getProdutos() {
        $query = "SELECT produto.id, produto.nome, produto.preco_venda, produto.foto, fornecedor.razao_social as fornecedor, codigo_barras FROM produto
                LEFT JOIN fornecedor ON produto.id_fornecedor = fornecedor.id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getProdutoName($id) {
        $query = "SELECT nome FROM produto WHERE id=$id;";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_array($result)["nome"];
    }

    public function getSpecificProduto($id) {
        $query = "SELECT * FROM produto WHERE id = $id;";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_array($result);
    }

    public function getCaderneta() {
        $query = "SELECT caderneta.id, cliente.nome as cliente, caderneta.nome_produto as produto, qtd, total, obs, data FROM caderneta
        LEFT JOIN cliente ON caderneta.id_cliente = cliente.id;";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getSpecificCaderneta($id) {
        $query = "SELECT * FROM caderneta WHERE id = $id;";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_array($result);
    }

    public function getLastVenda() {
        $query = "SELECT numero_nota FROM venda ORDER BY numero_nota DESC LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_assoc($result);
        return $result["numero_nota"];
    }

    public function getVendas() {
        $query = "SELECT numero_nota, data, cliente.nome as cliente, total, obs FROM venda 
        LEFT JOIN cliente on venda.id_cliente = cliente.id
        ORDER BY data DESC;";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getSpecificVenda($id) {
        $query = "SELECT * FROM venda WHERE numero_nota = $id;";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_array($result);
    }

    public function getProdutosVenda($numeroNota) {
        $query = "SELECT qtd, nome_produto, valor_unitario FROM produtos_da_venda
        WHERE numero_nota = $numeroNota;";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getValorTotalVendas() {
        $query = "SELECT sum(total) as total FROM venda;";
        $result = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_assoc($result);
        return $result["total"];
    }

    public function getValorTotalCaderneta() {
        $query = "SELECT sum(total) as total FROM caderneta;";
        $result = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_assoc($result);
        return $result["total"];
    }

    /* cadastros */

    public function registerFornecedor($razaoSocial, $cnpj, $email, $telefone, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf) {
        $query = "INSERT INTO 
        `fornecedor` (`razao_social`, `cnpj`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `email`, `telefone`)
        VALUES ('$razaoSocial', '$cnpj', '$cep', '$logradouro', '$numero', '$complemento', '$bairro', '$cidade', '$uf', '$email', '$telefone');";
        return mysqli_query($this->conn, $query);
    }

    public function registerCliente($nome, $email, $telefone, $cpf, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf) {
        $query = "INSERT INTO `cliente` (`nome`, `email`, `telefone`, `cpf`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`) VALUES ('$nome', '$email', '$telefone', '$cpf', '$cep', '$logradouro', '$numero', '$complemento', '$bairro', '$cidade', '$uf');";
        return mysqli_query($this->conn, $query);
    }

    public function registerProduto($codigo_barras, $nome, $preco, $foto, $fornecedor) {
        $query = "INSERT INTO `produto` (`codigo_barras`, `nome`, `preco_venda`, `foto`, `id_fornecedor`) VALUES ('$codigo_barras', '$nome', '$preco', '$foto', '$fornecedor');";
        return mysqli_query($this->conn, $query);
    }

    public function registerVenda($numeroNota, $data, $cliente, $total, $obs, $produtos) {
        mysqli_query($this->conn, "SET AUTOCOMMIT=0");
        mysqli_query($this->conn, "START TRANSACTION");

        $result[] = mysqli_query($this->conn, "INSERT INTO venda VALUES ($numeroNota, '$data', $cliente, $total, '$obs');");
         
        foreach($produtos as $key=>$value) {
            if(!empty($value["id"]) && !empty($value["qtd"])) {

                $nome = utf8_encode($value['nome']);
                $preco = $value["preco"];
                $qtd = $value['qtd'];
                $result[] =  mysqli_query($this->conn, "INSERT INTO `produtos_da_venda`(`numero_nota`, `nome_produto`, `valor_unitario`, `qtd`) VALUES ($numeroNota,'$nome', $preco, $qtd);");
            }
        }

        if(in_array(false, $result)) {
            mysqli_query($this->conn, "ROLLBACK");
            return false;
        } else {        
            mysqli_query($this->conn, "COMMIT");
            return true;
        }
    }

    public function registerCaderneta($cliente, $produto, $nomeProduto, $qtd, $data, $total, $obs) {
        $query = "INSERT INTO `caderneta` (`id_cliente`, `id_produto`, `nome_produto`, `qtd`, `data`, `total`, `obs`) VALUES ('$cliente', $produto, '$nomeProduto', '$qtd', '$data', '$total', '$obs');";
        return mysqli_query($this->conn, $query);
    }

    public function registerAdm($nome, $login, $senha) {
        $query = "INSERT INTO `administradores` (`nome`, `login`, `senha`) VALUES ('$nome', '$login', '$senha')";
        return mysqli_query($this->conn, $query);
    }

    /* exclusao */

    public function exclude($campo, $id, $tabela) {
        $query = "DELETE FROM `$tabela` WHERE `$campo`='$id';";
        return mysqli_query($this->conn, $query);
    }

    /* edicao */

    public function updateCaderneta($cliente, $produto, $nomeProduto, $qtd, $data, $total, $obs, $id){
        $query = "UPDATE caderneta SET id_cliente=$cliente, id_produto=$produto, nome_produto='$nomeProduto', qtd=$qtd, data='$data', total=$total, obs='$obs' WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }

    public function updateCliente($nome, $email, $telefone, $cpf, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf, $id) {
        $query = "UPDATE `cliente` SET `nome`='$nome',`email`='$email',`telefone`='$telefone',`cpf`='$cpf',`cep`='$cep',`logradouro`='$logradouro',`numero`=$numero,`complemento`='$complemento',`bairro`='$bairro',`cidade`='$cidade',`uf`='$uf' WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }

    public function updateFornecedor($razaoSocial, $cnpj, $email, $telefone, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf, $id) {
        $query = "UPDATE `fornecedor` SET `razao_social`='$razaoSocial',`cnpj`='$cnpj',`cep`='$cep',`logradouro`='logradouro',`numero`=$numero,`complemento`='$complemento',`bairro`='$bairro',`cidade`='$cidade',`uf`='$uf',`email`='$email',`telefone`='$telefone' WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }

    public function updateProduto($codigo, $nome, $preco, $foto, $fornecedor, $id) {
        $query = "UPDATE `produto` SET `codigo_barras`='$codigo',`nome`='$nome',`preco_venda`=$preco,`foto`='$foto',`id_fornecedor`=$fornecedor WHERE id=$id;";
        return mysqli_query($this->conn, $query);
    }

    public function updateAdm($id, $nome, $login, $senha) {
        $query = "UPDATE `administradores` SET `nome`='$nome',`login`='$login',`senha`='$senha' WHERE id=$id;";
        return mysqli_query($this->conn, $query);
    }

    /* filtragem */

    public function getFornecedoresInFilter($razaoSocial, $cnpj) {
        if(empty($razaoSocial) && !empty($cnpj)) {
            $query = "SELECT * FROM fornecedor WHERE cnpj='$cnpj';";
        }
        elseif(empty($cnpj)  && !empty($razaoSocial)) {
            $query = "SELECT * FROM fornecedor WHERE razao_social LIKE '%$razaoSocial%';";
        }
        elseif(!empty($cnpj)  && !empty($razaoSocial)) {
            $query = "SELECT * FROM fornecedor WHERE razao_social LIKE '%$razaoSocial%' and cnpj=$cnpj;";
        }
        else {
            $query = "SELECT * FROM fornecedor;";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getClientesInFilter($nome, $cpf) {
        if(empty($nome) && !empty($cpf)) {
            $query = "SELECT * FROM cliente WHERE cpf='$cpf';";
        }
        elseif(empty($cpf)  && !empty($nome)) {
            $query = "SELECT * FROM cliente WHERE nome LIKE '%$nome%';";
        }
        elseif(!empty($nome)  && !empty($cpf)) {
            $query = "SELECT * FROM cliente WHERE nome LIKE '%$nome%' AND cpf='$cpf';";
        }
        else {
            $query = "SELECT * FROM cliente;";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getProdutosInFilter($nome, $codigo, $fornecedor) {
        //apenas fornecedor
        if(empty($nome) && empty($codigo) && !empty($fornecedor)) {
            $query = "SELECT produto.id, codigo_barras, nome, preco_venda, foto, fornecedor.razao_social as fornecedor FROM produto
            INNER JOIN fornecedor ON produto.id_fornecedor = fornecedor.id
            WHERE fornecedor.razao_social LIKE '%$fornecedor%';";
        }
        //apenas nome
        elseif(empty($codigo)  && empty($fornecedor) && !empty($nome)) {
            $query = "SELECT produto.id, codigo_barras, nome, preco_venda, foto, fornecedor.razao_social as fornecedor FROM produto
            INNER JOIN fornecedor ON produto.id_fornecedor = fornecedor.id
            WHERE nome LIKE '%$nome%';";
        }
        //apenas o codigo
        elseif(empty($nome)  && empty($fornecedor) && !empty($codigo)) {
            $query = "SELECT produto.id, codigo_barras, nome, preco_venda, foto, fornecedor.razao_social as fornecedor FROM produto
            LEFT JOIN fornecedor ON produto.id_fornecedor = fornecedor.id
            WHERE codigo_barras='$codigo';";
        }
        //apenas fornecedor e codigo
        elseif(empty($nome)  && !empty($fornecedor) && !empty($codigo)) {
            $query = "SELECT produto.id, codigo_barras, nome, preco_venda, foto, fornecedor.razao_social as fornecedor FROM produto
            INNER JOIN fornecedor ON produto.id_fornecedor = fornecedor.id
            WHERE fornecedor.razao_social LIKE '%$fornecedor%'
            AND codigo_barras='$codigo';";
        }
        //apenas nome e codigo
        elseif(empty($fornecedor)  && !empty($nome) && !empty($codigo)) {
            $query = "SELECT produto.id, codigo_barras, nome, preco_venda, foto, fornecedor.razao_social as fornecedor FROM produto
            LEFT JOIN fornecedor ON produto.id_fornecedor = fornecedor.id
            WHERE nome LIKE '%$nome%'
            AND codigo_barras='$codigo';";
        }
        //apenas nome e fornecedor
        elseif(empty($codigo)  && !empty($fornecedor) && !empty($nome)) {
            $query = "SELECT produto.id, codigo_barras, nome, preco_venda, foto, fornecedor.razao_social as fornecedor FROM produto
            INNER JOIN fornecedor ON produto.id_fornecedor = fornecedor.id
            WHERE fornecedor.razao_social LIKE '%$fornecedor%'
            AND nome LIKE '%$nome%';";
        }
        //todos
        elseif(!empty($codigo)  && !empty($fornecedor) && !empty($nome)) {
            $query = "SELECT produto.id, codigo_barras, nome, preco_venda, foto, fornecedor.razao_social as fornecedor FROM produto
            INNER JOIN fornecedor ON produto.id_fornecedor = fornecedor.id
            WHERE fornecedor.razao_social LIKE '%$fornecedor%'
            AND nome LIKE '%$nome%'
            AND codigo_barras='$codigo';";
        }
        else {
            $query = "SELECT produto.id, produto.nome, produto.preco_venda, produto.foto, fornecedor.razao_social as fornecedor, codigo_barras FROM produto
            LEFT JOIN fornecedor ON produto.id_fornecedor = fornecedor.id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getVendasInFilter($nota, $cliente, $data) {
        //apenas nota
        if(empty($cliente) && empty($data) && !empty($nota)) {
            $query = "SELECT numero_nota, data, cliente.nome as cliente, total, obs FROM venda 
            LEFT JOIN cliente ON venda.id_cliente = cliente.id
            WHERE numero_nota=$nota
            ORDER BY data DESC;";
        }
        //apenas cliente
        elseif(empty($nota)  && empty($data) && !empty($cliente)) {
            $query = "SELECT numero_nota, data, cliente.nome as cliente, total, obs FROM venda 
            INNER JOIN cliente ON venda.id_cliente = cliente.id
            WHERE cliente.nome LIKE '%$cliente%'
            ORDER BY data DESC;";
        }
        //apenas data
        elseif(empty($nota)  && empty($cliente) && !empty($data)) {
            $query = "SELECT numero_nota, data, cliente.nome as cliente, total, obs FROM venda 
            LEFT JOIN cliente ON venda.id_cliente = cliente.id
            WHERE data='$data'
            ORDER BY data DESC;";
        }
        //apenas nota e cliente
        elseif(empty($data)  && !empty($nota) && !empty($cliente)) {
            $query = "SELECT numero_nota, data, cliente.nome as cliente, total, obs FROM venda 
            INNER JOIN cliente ON venda.id_cliente = cliente.id
            WHERE cliente.nome LIKE '%$cliente%'
            AND numero_nota=$nota
            ORDER BY data DESC;";
        }
        //apenas nota e data
        elseif(empty($cliente)  && !empty($nota) && !empty($data)) {
            $query = "SELECT numero_nota, data, cliente.nome as cliente, total, obs FROM venda 
            LEFT JOIN cliente ON venda.id_cliente = cliente.id
            WHERE numero_nota=$nota
            AND data='$data'
            ORDER BY data DESC;";
        }
        //apenas cliente e data
        elseif(empty($nota)  && !empty($cliente) && !empty($data)) {
            $query = "SELECT numero_nota, data, cliente.nome as cliente, total, obs FROM venda 
            INNER JOIN cliente ON venda.id_cliente = cliente.id
            WHERE cliente.nome LIKE '%$cliente%'
            AND data='$data'
            ORDER BY data DESC;";
        }
        //todos
        elseif(!empty($nota)  && !empty($cliente) && !empty($data)) {
            $query = "SELECT numero_nota, data, cliente.nome as cliente, total, obs FROM venda 
            INNER JOIN cliente ON venda.id_cliente = cliente.id
            WHERE cliente.nome LIKE '%$cliente%'
            AND numero_nota=$nota
            AND data='$data'
            ORDER BY data DESC;";
        }
        else {
            $query = "SELECT numero_nota, data, cliente.nome as cliente, total, obs FROM venda 
            LEFT JOIN cliente on venda.id_cliente = cliente.id
            ORDER BY data DESC;";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getCadernetaInFilter($cliente, $data) {
        if(empty($cliente) && !empty($data)) {
            $query = "SELECT caderneta.id, cliente.nome as cliente, caderneta.nome_produto as produto, qtd, total, obs, data FROM caderneta
            LEFT JOIN cliente ON caderneta.id_cliente = cliente.id
            WHERE data='$data';";
        }
        elseif(empty($data)  && !empty($cliente)) {
            $query = "SELECT caderneta.id, cliente.nome as cliente, caderneta.nome_produto as produto, qtd, total, obs, data FROM caderneta
            INNER JOIN cliente ON caderneta.id_cliente = cliente.id
            WHERE cliente.nome LIKE '%$cliente%';";
        }
        elseif(!empty($cliente)  && !empty($data)) {
            $query = "SELECT caderneta.id, cliente.nome as cliente, caderneta.nome_produto as produto, qtd, total, obs, data FROM caderneta
            INNER JOIN cliente ON caderneta.id_cliente = cliente.id
            WHERE cliente.nome LIKE '%$cliente%'
            AND data='$data';";
        }
        else {
            $query = "SELECT caderneta.id, cliente.nome as cliente, caderneta.nome_produto as produto, qtd, total, obs, data FROM caderneta
            LEFT JOIN cliente ON caderneta.id_cliente = cliente.id;";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

}

?>