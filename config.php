<?php

$servername = "localhost";
$dbname = "obahortifruti";
$username = "root";
$password = "usbw";

$con = mysqli_connect($servername, $username, $password, $dbname);

if(mysqli_connect_error()) {
    echo "Falha na conexão: " .mysqli_connect_error();
}

?>