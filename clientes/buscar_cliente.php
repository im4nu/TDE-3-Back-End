<?php
require_once '../config/db.php';

header('Content-Type: application/json');

if (isset($_GET['nome'])) {
    $nome = $_GET['nome'] . '%';

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nome LIKE ? LIMIT 5");
    $stmt->execute([$nome]);
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($clientes);
} else {
    echo json_encode([]);
}
?>