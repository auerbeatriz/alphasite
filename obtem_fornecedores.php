<?php
require_once("config.php");
require_once("post.php");
$post = new Post($con);

if(isset($_GET["razaoSocial"]) && isset($_GET["cnpj"])) {
	$razaoSocial = $_GET["razaoSocial"];
	$cnpj = $_GET["cnpj"];

	$result = $post->getFornecedoresInFilter($razaoSocial, $cnpj);
} else {
	$result = $post->getFornecedores();
}

$num = mysqli_num_rows($result);

if ($num > 0){
	$response = array();
	$response['fornecedores'] = array();

	while($row = mysqli_fetch_assoc($result)){
		$fornecedor = array(
			'id' => $row["id"],
			'razao_social' => utf8_encode($row["razao_social"]),
			'cnpj' => $row["cnpj"],
			'endereco' => "Cep: ". $row["cep"] . ", " .utf8_encode($row["logradouro"]) .", ". $row["numero"] .", ". utf8_encode($row["complemento"]).", ". utf8_encode($row["bairro"])." - ". utf8_encode($row["cidade"]).", ".strtoupper($row["uf"]),
			'email' => $row["email"],
			'telefone' => $row["telefone"],
		);
		
		array_push($response['fornecedores'],$fornecedor);
	}

	$response["success"] = 1;
	echo json_encode($response);
	
}else{
	$response["success"] = 0;
	$response["message"] = "Não foi possível executar a ação.";
	echo json_encode($response);
}

?>