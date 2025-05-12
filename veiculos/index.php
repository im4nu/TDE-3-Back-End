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
    <title>Veículos</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #444;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff !important;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
            color: #555;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .actions a {
            margin-right: 10px;
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .text{
            font-size: 1.2rem;
            font-weight: bold;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007BFF;
            text-decoration: none;
            font-size: 1rem;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .desktop-content {
                display: none;
            }
            .mobile-message {
                display: block;
                text-align: center;
                font-size: 1.2rem;
                color: #ff0000;
                margin-top: 20px;
            }

            .mobile-message img {
                max-width: 150px; /* Aumentar o tamanho da ilustração */
            }

            .mobile-message p {
                color: #007BFF; /* Alterar a cor do texto para azul do sistema */
            }
        }

        @media (min-width: 769px) {
            .desktop-content {
                display: block;
            }
            .mobile-message {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Veículos</h1>
        <div class="mobile-message">
            <img src="../src/safe.png" alt="Ilustração de segurança" style="max-width: 100px; margin-bottom: 10px;">
            <p class="text">Disponível apenas para o administrador</p>
        </div>
        <div class="desktop-content">
            <div class="actions">
                <a href="create.php" class="btn">+ Novo Veículo</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Ano</th>
                        <th>Placa</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($veiculos as $veiculo): ?>
                        <tr>
                            <td><?= $veiculo['id'] ?></td>
                            <td><?= $veiculo['modelo'] ?></td>
                            <td><?= $veiculo['marca'] ?></td>
                            <td><?= $veiculo['ano'] ?></td>
                            <td><?= $veiculo['placa'] ?></td>
                            <td><?= $veiculo['status'] ?></td>
                            <td class="actions">
                                <a href="edit.php?id=<?= $veiculo['id'] ?>">Editar</a>
                                <a href="delete.php?id=<?= $veiculo['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                                <?php if ($veiculo['status'] == 'alugado'): ?>
                                    <a href="cancelar.php?id=<?= $veiculo['id'] ?>" onclick="return confirm('Tem certeza que deseja cancelar o aluguel?')">Cancelar Aluguel</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="../index.php" class="back-link">← Voltar</a>
        </div>
    </div>
</body>
</html>