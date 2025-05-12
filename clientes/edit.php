<?php
require_once '../config/db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE clientes SET nome = ?, email = ?, telefone = ? WHERE id = ?");
    $stmt->execute([$_POST['nome'], $_POST['email'], $_POST['telefone'], $id]);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Editar Cliente</h1>
    <form method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= $cliente['nome'] ?>" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $cliente['email'] ?>"><br>
        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="<?= $cliente['telefone'] ?>"><br><br>
        <button type="submit">Atualizar</button>
    </form>
    <br>
    <a href="index.php">← Voltar</a>
</body>
</html>
