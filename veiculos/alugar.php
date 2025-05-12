<?php
require_once '../config/db.php';

// Obter lista de clientes
$clientesQuery = "SELECT id, nome FROM clientes";
$clientesResult = $pdo->query($clientesQuery);
$clientes = $clientesResult->fetchAll(PDO::FETCH_ASSOC);

// Capturar o ID do veículo da rota
$veiculoId = isset($_GET['id']) ? $_GET['id'] : null;
if ($veiculoId) {
    $veiculoQuery = "SELECT modelo FROM veiculos WHERE id = ?";
    $stmt = $pdo->prepare($veiculoQuery);
    $stmt->bindParam(1, $veiculoId);
    $stmt->execute();
    $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$veiculo) {
        die("Veículo não encontrado.");
    }
} else {
    die("ID do veículo não fornecido.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clienteId = $_POST['cliente_id'];
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
        if ($stmt->execute()) {
            // Atualizar o status do veículo para 'alugado'
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
    
    // Após o sucesso, redirecionar para a tela de confirmação
    if (isset($success)) {
        header("Location: confirmar.php?id=$veiculoId");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugar Veículo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Alugar Veículo</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"> <?= $error ?> </div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"> <?= $success ?> </div>
        <?php endif; ?>

        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="cliente_id" class="form-label">Cliente:</label>
                <select name="cliente_id" id="cliente_id" class="form-select" required>
                    <option value="">Selecione um cliente</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente['id'] ?>"> <?= $cliente['nome'] ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="veiculo" class="form-label">Veículo:</label>
                <input type="text" id="veiculo" class="form-control" value="<?= $veiculo['modelo'] ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="data_inicio" class="form-label">Data de Início:</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="data_fim" class="form-label">Data de Fim:</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Alugar</button>
        </form>
    </div>
</body>
</html>