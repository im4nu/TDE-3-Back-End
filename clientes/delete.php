<?php
require_once '../config/db.php';

$id = $_GET['id'];

// Verificar se o cliente possui um aluguel ativo
$stmt = $pdo->prepare("SELECT veiculo_id FROM alugueis WHERE cliente_id = ?");
$stmt->execute([$id]);
$aluguel = $stmt->fetch(PDO::FETCH_ASSOC);

if ($aluguel) {
    $veiculoId = $aluguel['veiculo_id'];

    // Remover o aluguel associado ao cliente
    $stmt = $pdo->prepare("DELETE FROM alugueis WHERE cliente_id = ?");
    $stmt->execute([$id]);

    // Liberar o veículo associado ao aluguel
    $stmt = $pdo->prepare("UPDATE veiculos SET status = 'disponível' WHERE id = ?");
    $stmt->execute([$veiculoId]);
}

// Excluir o cliente
$stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
