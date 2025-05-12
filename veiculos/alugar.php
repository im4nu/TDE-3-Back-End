<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Aluguel</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Confirmar Aluguel</h1>
        <?php
        // Simulação de dados (substitua por consulta ao banco de dados)
        $veiculos = [
            1 => ['modelo' => 'Civic', 'marca' => 'Honda', 'ano' => 2020, 'imagem' => 'https://via.placeholder.com/300'],
            2 => ['modelo' => 'Corolla', 'marca' => 'Toyota', 'ano' => 2021, 'imagem' => 'https://via.placeholder.com/300'],
            3 => ['modelo' => 'Onix', 'marca' => 'Chevrolet', 'ano' => 2019, 'imagem' => 'https://via.placeholder.com/300'],
        ];

        $id = $_GET['id'] ?? null;

        if ($id && isset($veiculos[$id])) {
            $veiculo = $veiculos[$id];
            echo "<div class='vehicle-card'>
                <img src='{$veiculo['imagem']}' alt='Imagem do veículo'>
                <h3>{$veiculo['modelo']}</h3>
                <p><strong>Marca:</strong> {$veiculo['marca']}</p>
                <p><strong>Ano:</strong> {$veiculo['ano']}</p>
            </div>";
        } else {
            echo "<p>Veículo não encontrado.</p>";
            exit;
        }
        ?>

        <form action="confirmar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="link">Confirmar Aluguel</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id) {
                // Atualize o status do veículo no banco de dados para "alugado"
                // Exemplo de mensagem de sucesso
                echo "<h1>Aluguel confirmado!</h1>";
                echo "<p>O veículo com ID {$id} foi alugado com sucesso.</p>";
                echo "<a href='listar.php' class='link'>Voltar à lista de veículos</a>";
            } else {
                echo "<p>Erro ao processar o aluguel.</p>";
            }
        }
        ?>
    </div>
</body>
</html>