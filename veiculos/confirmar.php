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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id) {
                // Atualizar o status do veículo para "alugado"
                $stmt = $pdo->prepare("UPDATE veiculos SET status = 'alugado' WHERE id = ?");
                $stmt->execute([$id]);

                echo "<h1>Aluguel Confirmado!</h1>";
                echo "<p>O veículo com ID {$id} foi alugado com sucesso.</p>";
                echo "<a href='listar.php' class='link'>Voltar à Lista de Veículos</a>";
            } else {
                echo "<h1>Erro</h1>";
                echo "<p>Erro ao processar o aluguel. Por favor, tente novamente.</p>";
                echo "<a href='listar.php' class='link'>Voltar</a>";
            }
        }
        ?>
    </div>
</body>
</html>