<?php

class POST {

    private $conn;
    
    public function __construct($db){
		$this->conn = $db;
	}

    public function admExists($adm) {
        $query = "SELECT adm FROM administradores WHERE adm = '" . $adm . "'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result) > 0;
    }

    public function passwordIsCorrect($adm, $password) {
        $query = "SELECT * FROM administradores WHERE adm = '" . $adm . "' AND senha = '" . $password . "'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result) > 0;
    }

    public function getAdmName($adm) {
        $query = "SELECT nome FROM administradores WHERE adm = '" . $adm . "';";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_array($result)["nome"];
    }
}

?>