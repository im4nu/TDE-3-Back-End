<?php
require_once '../config/db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM veiculos WHERE id = ?");
$stmt->execute([$id]);
$veiculo = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE veiculos SET modelo = ?, marca = ?, ano = ?, placa = ? WHERE id = ?");
    $stmt->execute([$_POST['modelo'], $_POST['marca'], $_POST['ano'], $_POST['placa'], $id]);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Veículo</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Editar Veículo</h1>
    <form method="post">
        <label>Modelo:</label><br>
        <input type="text" name="modelo" value="<?= $veiculo['modelo'] ?>" required><br>
        <label>Marca:</label><br>
        <input type="text" name="marca" value="<?= $veiculo['marca'] ?>"><br>
        <label>Ano:</label><br>
        <input type="number" name="ano" value="<?= $veiculo['ano'] ?>"><br>
        <label>Placa:</label><br>
        <input type="text" name="placa" value="<?= $veiculo['placa'] ?>"><br><br>
        <button type="submit">Atualizar</button>
    </form>
    <br>
    <a href="index.php">← Voltar</a>
</body>
</html>
