<?php
require_once '../config/db.php';

// Substituir $conn por $pdo para usar a conexão correta
$clientesQuery = "SELECT id, nome FROM clientes";
$clientesResult = $pdo->query($clientesQuery);
$clientes = $clientesResult->fetchAll(PDO::FETCH_ASSOC);

$veiculosQuery = "SELECT id, modelo FROM veiculos WHERE id NOT IN (SELECT veiculo_id FROM alugueis WHERE (data_inicio <= :data_fim AND data_fim >= :data_inicio))";
$stmt = $pdo->prepare($veiculosQuery);
$stmt->bindParam(':data_inicio', $_POST['data_inicio']);
$stmt->bindParam(':data_fim', $_POST['data_fim']);
$stmt->execute();
$veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clienteId = $_POST['cliente_id'];
    $veiculoId = $_POST['veiculo_id'];
    $dataInicio = $_POST['data_inicio'];
    $dataFim = $_POST['data_fim'];

    // Validação de datas
    if (strtotime($dataInicio) > strtotime($dataFim)) {
        $error = "A data inicial não pode ser maior que a data final.";
    } else {
        // Inserir aluguel no banco de dados
        $insertQuery = "INSERT INTO alugueis (cliente_id, veiculo_id, data_inicio, data_fim) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($insertQuery);
        $stmt->bindParam(1, $clienteId);
        $stmt->bindParam(2, $veiculoId);
        $stmt->bindParam(3, $dataInicio);
        $stmt->bindParam(4, $dataFim);
        // Adicionar logs para depuração
        error_log("Executando query de inserção: $insertQuery");
        error_log("Parâmetros: Cliente ID=$clienteId, Veículo ID=$veiculoId, Data Início=$dataInicio, Data Fim=$dataFim");
        // Adicionar verificação de erro detalhada para a execução da query
        if ($stmt->execute()) {
            // Atualizar o status do veículo para 'alugado' após a inserção
            $updateVeiculoQuery = "UPDATE veiculos SET status = 'alugado' WHERE id = ?";
            $updateStmt = $pdo->prepare($updateVeiculoQuery);
            $updateStmt->bindParam(1, $veiculoId);
            if (!$updateStmt->execute()) {
                $error = "Erro ao atualizar o status do veículo: " . implode(" ", $updateStmt->errorInfo());
            } else {
                $success = "Veículo alugado com sucesso!";
            }
        } else {
            $error = "Erro ao alugar o veículo: " . implode(" ", $stmt->errorInfo());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugar Veículo</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Alugar Veículo</h1>

        <?php if (isset($error)): ?>
            <div class="error"> <?= $error ?> </div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="success"> <?= $success ?> </div>
        <?php endif; ?>

        <form method="POST">
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" id="cliente_id" required>
                <option value="">Selecione um cliente</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['id'] ?>"> <?= $cliente['nome'] ?> </option>
                <?php endforeach; ?>
            </select>

            <label for="veiculo_id">Veículo:</label>
            <select name="veiculo_id" id="veiculo_id" required>
                <option value="">Selecione um veículo</option>
                <?php foreach ($veiculos as $veiculo): ?>
                    <option value="<?= $veiculo['id'] ?>"> <?= $veiculo['modelo'] ?> </option>
                <?php endforeach; ?>
            </select>

            <label for="data_inicio">Data de Início:</label>
            <input type="date" name="data_inicio" id="data_inicio" required>

            <label for="data_fim">Data de Fim:</label>
            <input type="date" name="data_fim" id="data_fim" required>

            <button type="submit">Alugar</button>
        </form>
    </div>
</body>
</html>