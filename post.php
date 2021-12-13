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

    public function passwordIsCorrect($adm, $password) {
        $query = "SELECT * FROM administradores WHERE login = '" . $adm . "' AND senha = '" . $password . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

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

    public function getFornecedores() {
        $query = "SELECT * FROM fornecedor";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getClientes() {
        $query = "SELECT * FROM cliente";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getProdutos() {
        $query = "SELECT produto.id, produto.nome, produto.preco_venda, produto.foto, fornecedor.razao_social as fornecedor FROM produto
                INNER JOIN fornecedor ON produto.id_fornecedor = fornecedor.id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getCaderneta() {
        $query = "SELECT cliente.nome as cliente, produto.nome as produto, qtd, qtd*produto.preco_venda as total, data FROM caderneta
        INNER JOIN cliente ON caderneta.id_cliente = cliente.id
        INNER JOIN produto ON caderneta.id_produto = produto.id;";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getLastVenda() {
        $query = "SELECT numero_nota FROM venda ORDER BY numero_nota DESC LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_assoc($result);
        return $result["numero_nota"];
    }
}

?>