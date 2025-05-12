<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluguel Confirmado</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .container {
            max-width: 70%; /* Ajustar a largura do conteúdo para 90% */
            margin: 50px auto;
            text-align: center; /* Centralizar todo o conteúdo */
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center; /* Centralizar horizontalmente */
            justify-content: center; /* Centralizar verticalmente */
            
        }

        .vehicle-card {
            width: 200px; /* Diminuir o tamanho do card */
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .vehicle-card:hover {
            transform: scale(1.05);
        }

        .vehicle-card img {
            max-width: 100%;
            border-radius: 8px;
        }

        .vehicle-card h3 {
            margin: 15px 0;
            color: #333;
        }

        .vehicle-card p {
            margin: 5px 0;
            color: #555;
        }

        .success-message {
            font-size: 1.5rem;
            color: #007BFF; /* Alterar a cor do texto para azul do sistema */
            margin-bottom: 20px;
            animation: fadeIn 1s ease;
            display: flex;
            flex-direction: column;
            align-items: center; /* Centralizar horizontalmente */
            justify-content: center; /* Centralizar verticalmente */
            text-align: center; /* Centralizar o texto */
            width: 100%; /* Garantir que a mensagem ocupe toda a largura */
            font-weight: bold; /* Deixar o texto em negrito */
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require_once '../config/db.php';

        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("ID do veículo não fornecido.");
        }

        $stmt = $pdo->prepare("SELECT * FROM veiculos WHERE id = ?");
        $stmt->execute([$id]);
        $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$veiculo) {
            die("Veículo não encontrado.");
        }

        $stmt = $pdo->prepare("SELECT data_fim FROM alugueis WHERE veiculo_id = ? ORDER BY id DESC LIMIT 1");
        $stmt->execute([$id]);
        $aluguel = $stmt->fetch(PDO::FETCH_ASSOC);

        $dataFim = $aluguel['data_fim'] ?? 'Desconhecida';
        ?>

        <div class="success-message">
            🎉 Parabéns! O veículo foi alugado com sucesso!
            <!-- <img src="../src/congratulations.png" alt="Parabéns" style="max-width: 150px; margin-bottom: 10px;"> -->
        </div>

        <div class="vehicle-card">
            <img src="<?= htmlspecialchars($veiculo['imagem'], ENT_QUOTES, 'UTF-8') ?>" alt="Imagem do veículo">
            <h3><?= htmlspecialchars($veiculo['modelo'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p><strong>Marca:</strong> <?= htmlspecialchars($veiculo['marca'], ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong>Ano:</strong> <?= htmlspecialchars($veiculo['ano'], ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong>Placa:</strong> <?= htmlspecialchars($veiculo['placa'], ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong>Alugado até:</strong> <?= htmlspecialchars($dataFim, ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <a href="../index.php" class="back-link">Voltar à página inicial</a>
    </div>
</body>
</html>
