<?php

function listFornecedores($post) {
    $result = $post->getFornecedoresName();
    foreach ($result as $row) {
        echo "<option value=".$row['id'].">".$row['id']. " - " . utf8_encode($row["razao_social"])."</option>";
    }
}

function listClientes($post) {
    $result = $post->getClientsName();
    foreach ($result as $row) {
        echo "<option value=".$row['id'].">".$row['id']. " - " . utf8_encode($row["nome"])."</option>";
    }
}

function listProdutos($post) {
    $result = $post->getProducts();
    foreach ($result as $row) {
        echo "<option value=".$row['id'].">".$row['id']. " - " . utf8_encode($row["nome"])."</option>";
    }
}

function limpaDocumento($documento) {
    //Primeiro retira os espaços do começo e do final.
   $documento = trim($documento);
   //Substitui o ponto por nada
    $documento = str_replace(".", "", $documento);
   //Troca o traço por nada
    $documento = str_replace("-", "", $documento);
   //Troca o espaço por nada
    $documento = str_replace(" ", "", $documento);
   //Troca a barra por nada
    $documento = str_replace("-", "", $documento);

    return $documento;
}

function validaCnpj($cnpj) {
    $cnpj = limpaDocumento($cnpj);
    if(strlen($cnpj) < 14) {
        return false;
    }

    $s1 = "543298765432";
    $s2 = "6543298765432";
    $validador = 0;
    $digitos = substr($cnpj, 0, 12);
    $verificadoresPassados = substr($cnpj, 12);

    //  fazendo a contagem do primeiro dígito
    for($i=0; $i < 12; $i++) {
        $validador += (int) substr($s1, $i, 1) * (int) substr($digitos, $i, 1);
    }
    if((int) ($validador % 11) < 2) {
        $digitos .= "0";
    } 
    else {
        $digitos .=  strval(11 - ($validador % 11));
    }

    //  fazendo a contagem do segundo dígito
    $validador = 0;
    for($i=0; $i < 13; $i++) {
        $validador += (int) substr($s2, $i, 1) * (int) substr($digitos, $i, 1);
    }
    if((int) ($validador % 11) < 2) {
        $digitos .= "0";
    } 
    else {
        $digitos .=  strval(11 - ($validador % 11));
    }

    //  comparando o dígito informado com o dígito calculado
    if(strcmp(substr($digitos, 12), $verificadoresPassados) == 0) {
        return true;
    }
    else {
        return false;
    }
}

function validaCpf($cpf) {
    $cpf = limpaDocumento($cpf);
    if(strlen($cpf) < 11) {
        return false;
    }

    $contador = 10;
    $validador = 0;
    $digitos = substr($cpf, 0, 9);
    $verificadoresPassados = substr($cpf, 9);

    //  fazendo a contagem do primeiro dígito
    for($i=0; $i < 9; $i++) {
        $validador += (int) substr($digitos, $i, 1) * $contador;
        $contador -= 1;
    }
    if((int) ($validador * 10 % 11) == 10) {
        $digitos .= "0";
    } 
    else {
        $digitos .=  strval((int) $validador * 10 % 11);
    }
 
    //  fazendo a contagem do segundo dígito
    $contador = 11;
    $validador = 0;
    for($i=0; $i < 13; $i++) {
        $validador += (int) substr($digitos, $i, 1) * $contador;
        $contador -= 1;
    }
    if((int) ($validador * 10 % 11) == 10) {
        $digitos .= "0";
    } 
    else {
        $digitos .=  strval((int) $validador * 10 % 11);
    }

    //  comparando o dígito informado com o dígito calculado
    if(strcmp(substr($digitos, 9), $verificadoresPassados) == 0) {
        return true;
    }
    else {
        return false;
    }
}

function exibeErros($erros) {
    if(!empty($erros)) {
        foreach($erros as $erro) {
            echo $erro;
        }
    }
}

?>