<?php
require_once '../config/db.php';

if (!isset($_GET['id'])) {
    die("ID do veículo não fornecido.");
}

$veiculoId = $_GET['id'];

try {
    // Atualizar o status do veículo para disponível
    $updateQuery = "UPDATE veiculos SET status = 'disponível' WHERE id = ?";
    $stmt = $pdo->prepare($updateQuery);
    $stmt->bindParam(1, $veiculoId);
    $stmt->execute();

    // Remover o aluguel associado ao veículo
    $deleteQuery = "DELETE FROM alugueis WHERE veiculo_id = ?";
    $stmt = $pdo->prepare($deleteQuery);
    $stmt->bindParam(1, $veiculoId);
    $stmt->execute();

    header("Location: index.php?message=Aluguel cancelado com sucesso");
    exit;
} catch (Exception $e) {
    die("Erro ao cancelar o aluguel: " . $e->getMessage());
}
?>