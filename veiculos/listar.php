<?php
require_once '../config/db.php';

$stmt = $pdo->query("SELECT * FROM veiculos");
$veiculos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Veículos</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Veículos</h1>
        <div class="vehicle-list">
            <?php foreach ($veiculos as $veiculo): ?>
                <div class="vehicle-card">
                    <img src="<?= htmlspecialchars($veiculo['imagem']) ?>" alt="Imagem do veículo">
                    <h3><?= htmlspecialchars($veiculo['modelo']) ?></h3>
                    <p><strong>Marca:</strong> <?= htmlspecialchars($veiculo['marca']) ?></p>
                    <p><strong>Ano:</strong> <?= htmlspecialchars($veiculo['ano']) ?></p>
                    <p><strong>Placa:</strong> <?= htmlspecialchars($veiculo['placa']) ?></p>
                    <p><strong>Status:</strong> <?= htmlspecialchars(ucfirst($veiculo['status'])) ?></p>
                    <?php if ($veiculo['status'] === 'disponível'): ?>
                        <a href="alugar.php?id=<?= $veiculo['id'] ?>" class="link">Alugar</a>
                    <?php else: ?>
                        <button class="link disabled" disabled>Indisponível</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>