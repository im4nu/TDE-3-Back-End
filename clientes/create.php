<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO clientes (nome, email, telefone) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['nome'], $_POST['email'], $_POST['telefone']]);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Novo Cliente</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Novo Cliente</h1>
    <form method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br>
        <label>Email:</label><br>
        <input type="email" name="email"><br>
        <label>Telefone:</label><br>
        <input type="text" name="telefone"><br><br>
        <button type="submit">Salvar</button>
    </form>
    <br>
    <a href="index.php">← Voltar</a>
</body>
</html>
