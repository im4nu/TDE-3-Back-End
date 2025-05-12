<?php
require_once '../config/db.php';

$stmt = $pdo->query("SELECT * FROM clientes");
$clientes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clientes</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Clientes</h1>
    <a href="create.php">+ Novo Cliente</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th>
        </tr>
        <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= $cliente['id'] ?></td>
                <td><?= $cliente['nome'] ?></td>
                <td><?= $cliente['email'] ?></td>
                <td><?= $cliente['telefone'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $cliente['id'] ?>">Editar</a> | 
                    <a href="delete.php?id=<?= $cliente['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="../index.php">← Voltar</a>
</body>
</html>
