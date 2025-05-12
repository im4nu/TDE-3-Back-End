<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO veiculos (modelo, marca, ano, placa) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['modelo'], $_POST['marca'], $_POST['ano'], $_POST['placa']]);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Novo Veículo</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Novo Veículo</h1>
    <form method="post">
        <label>Modelo:</label><br>
        <input type="text" name="modelo" required><br>
        <label>Marca:</label><br>
        <input type="text" name="marca"><br>
        <label>Ano:</label><br>
        <input type="number" name="ano"><br>
        <label>Placa:</label><br>
        <input type="text" name="placa"><br><br>
        <button type="submit">Salvar</button>
    </form>
    <br>
    <a href="index.php">← Voltar</a>
</body>
</html>
