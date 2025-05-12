<?php
require_once '../config/db.php';

$stmt = $pdo->query("SELECT * FROM veiculos");
$veiculos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Veículos</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Veículos</h1>
    <a href="create.php">+ Novo Veículo</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th><th>Modelo</th><th>Marca</th><th>Ano</th><th>Placa</th><th>Ações</th>
        </tr>
        <?php foreach ($veiculos as $veiculo): ?>
            <tr>
                <td><?= $veiculo['id'] ?></td>
                <td><?= $veiculo['modelo'] ?></td>
                <td><?= $veiculo['marca'] ?></td>
                <td><?= $veiculo['ano'] ?></td>
                <td><?= $veiculo['placa'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $veiculo['id'] ?>">Editar</a> | 
                    <a href="delete.php?id=<?= $veiculo['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="../index.php">← Voltar</a>
</body>
</html>
