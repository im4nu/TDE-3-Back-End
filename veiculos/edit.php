<!-- filepath: /home/manu/codes/locadora-php/veiculos/edit.php -->
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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Veículo</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Reutilizando os estilos da página de criação */
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Veículo</h1>
        <form method="post">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" value="<?= $veiculo['modelo'] ?>" required>

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" value="<?= $veiculo['marca'] ?>">

            <label for="ano">Ano:</label>
            <input type="number" id="ano" name="ano" value="<?= $veiculo['ano'] ?>">

            <label for="placa">Placa:</label>
            <input type="text" id="placa" name="placa" value="<?= $veiculo['placa'] ?>">

            <button type="submit">Atualizar</button>
        </form>
        <a href="index.php" class="back-link">← Voltar</a>
    </div>
</body>
</html>