<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluguel Confirmado</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <?php
        require_once '../config/db.php';

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'] ?? null;
                $cliente_id = $_POST['cliente'] ?? null;
                $nome = $_POST['nome'] ?? '';
                $email = $_POST['email'] ?? '';
                $telefone = $_POST['telefone'] ?? '';
                $data_inicio = $_POST['data_inicio'] ?? '';
                $data_fim = $_POST['data_fim'] ?? '';

                if (!$id || !$data_inicio || !$data_fim) {
                    throw new Exception("Campos obrigatórios não foram preenchidos.");
                }

                if ($cliente_id) {
                    // Registrar o aluguel para um cliente existente
                    $stmt = $pdo->prepare("INSERT INTO alugueis (cliente_id, veiculo_id, data_inicio, data_fim) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$cliente_id, $id, $data_inicio, $data_fim]);
                } else {
                    if (!$nome || !$email || !$telefone) {
                        throw new Exception("Dados do cliente não foram preenchidos.");
                    }

                    // Verificar se o cliente já existe pelo email
                    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
                    $stmt->execute([$email]);
                    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($cliente) {
                        $cliente_id = $cliente['id'];
                    } else {
                        // Cadastrar novo cliente
                        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, telefone) VALUES (?, ?, ?)");
                        $stmt->execute([$nome, $email, $telefone]);
                        $cliente_id = $pdo->lastInsertId();
                    }

                    // Registrar o aluguel para o novo cliente
                    $stmt = $pdo->prepare("INSERT INTO alugueis (cliente_id, veiculo_id, data_inicio, data_fim) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$cliente_id, $id, $data_inicio, $data_fim]);
                }

                // Obter informações do veículo
                $stmt = $pdo->prepare("SELECT * FROM veiculos WHERE id = ?");
                $stmt->execute([$id]);
                $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);

                echo "<h1>Aluguel Confirmado!</h1>";
                echo "<p>O veículo com ID {$id} foi alugado com sucesso até {$data_fim}.</p>";
                echo "<div class='vehicle-card'>";
                echo "<img src='" . htmlspecialchars($veiculo['imagem'], ENT_QUOTES, 'UTF-8') . "' alt='Imagem do veículo' style='width: 100%; max-width: 300px;'>";
                echo "<h3>" . htmlspecialchars($veiculo['modelo'], ENT_QUOTES, 'UTF-8') . "</h3>";
                echo "<p><strong>Marca:</strong> " . htmlspecialchars($veiculo['marca'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p><strong>Ano:</strong> " . htmlspecialchars($veiculo['ano'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p><strong>Placa:</strong> " . htmlspecialchars($veiculo['placa'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "</div>";
                echo "<a href='listar.php' class='link'>Voltar à Lista de Veículos</a>";
            }
        } catch (Exception $e) {
            echo "<h1>Erro</h1>";
            echo "<p>Ocorreu um erro: " . $e->getMessage() . "</p>";
            echo "<a href='listar.php' class='link'>Voltar</a>";
        }
        ?>
    </div>
</body>
</html>