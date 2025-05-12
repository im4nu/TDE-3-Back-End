<?php
$host = '127.0.0.1';
$dbname = 'locadora_2';
$user = 'root';
$pass = 'nova_senha';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>