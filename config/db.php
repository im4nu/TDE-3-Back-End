<?php
$host = '192.168.10.20';
$dbname = 'locadora';
$username = 'root';
$password = '';

$conexao = new mysqli($host, $username, $password, $dbname);

if ($conexao->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conexao->connect_error);
}