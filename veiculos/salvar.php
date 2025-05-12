<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modelo = $_POST['modelo'] ?? '';
    $marca = $_POST['marca'] ?? '';
    $ano = $_POST['ano'] ?? '';
    $placa = $_POST['placa'] ?? '';
    $imagem = $_POST['imagem'] ?? '';

    if ($modelo && $marca && $ano && $placa && $imagem) {
        $stmt = $pdo->prepare("INSERT INTO veiculos (modelo, marca, ano, placa, imagem, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$modelo, $marca, $ano, $placa, $imagem, 'disponível']);
        header('Location: listar.php');
        exit;
    } else {
        echo "<p>Erro: Todos os campos são obrigatórios.</p>";
        echo "<a href='create.php'>Voltar</a>";
    }
} else {
    header('Location: create.php');
    exit;
}
?>