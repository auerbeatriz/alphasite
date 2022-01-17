<?php
require_once("config.php");
require_once("post.php");
$post = new Post($con);

if(isset($_GET["nome"]) && isset($_GET["cpf"])) {
	$nome = $_GET["nome"];
	$cpf = $_GET["cpf"];

	$result = $post->getClientesInFilter($nome, $cpf);
} else {
	$result = $post->getClientes();
}

$num = mysqli_num_rows($result);

if ($num > 0){
	$response = array();
	$response['clientes'] = array();

	while($row = mysqli_fetch_assoc($result)){
		$cliente = array(
			'id' => $row["id"],
			'nome' => utf8_encode($row["nome"]),
			'cpf' => $row["cpf"],
			'endereco' => "Cep: ". $row["cep"] . ", " .utf8_encode($row["logradouro"]) .", ". $row["numero"] .", ". utf8_encode($row["complemento"]).", ". utf8_encode($row["bairro"])." - ". utf8_encode($row["cidade"]).", ".strtoupper($row["uf"]),
			'email' => $row["email"],
			'telefone' => $row["telefone"],
		);
		
		array_push($response['clientes'],$cliente);
	}

	$response["success"] = 1;
	echo json_encode($response);
	
}else{
	$response["success"] = 0;
	$response["message"] = "Não foi possível executar a ação.";
	echo json_encode($response);
}

?>