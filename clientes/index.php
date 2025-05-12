<?php
require_once '../config/db.php';

$stmt = $pdo->query("SELECT * FROM clientes");
$clientes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Clientes</h1>
        <div class="actions">
            <a href="create.php" class="btn">+ Novo Cliente</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= $cliente['id'] ?></td>
                        <td><?= $cliente['nome'] ?></td>
                        <td><?= $cliente['email'] ?></td>
                        <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                        <td class="actions">
                            <a href="edit.php?id=<?= $cliente['id'] ?>">Editar</a>
                            <a href="delete.php?id=<?= $cliente['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../index.php" class="back-link">← Voltar</a>
    </div>
</body>
</html>