<?php

class POST {

    private $conn;
    
    public function __construct($db){
		$this->conn = $db;
	}

    public function admExists($adm) {
        $query = "SELECT login FROM administradores WHERE login = '" . $adm . "'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result) > 0;
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

    public function getProducts() {
        $query = "SELECT id, nome FROM produto;";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
}

?>