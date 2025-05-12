<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO veiculos (modelo, marca, ano, placa, imagem, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['modelo'],
        $_POST['marca'],
        $_POST['ano'],
        $_POST['placa'],
        $_POST['imagem'],
        'disponível'
    ]);
    header('Location: listar.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Veículo</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Veículo</h1>
        <form action="salvar.php" method="POST">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required><br><br>

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required><br><br>

            <label for="ano">Ano:</label>
            <input type="number" id="ano" name="ano" required><br><br>

            <label for="placa">Placa:</label>
            <input type="text" id="placa" name="placa" placeholder="Exemplo: ABC-1234" required><br><br>

            <label for="imagem">Link da Imagem:</label>
            <input type="url" id="imagem" name="imagem" placeholder="Exemplo: https://exemplo.com/imagem.jpg" required><br><br>

            <button type="submit" class="link">Salvar</button>
        </form>
    </div>
</body>
</html>