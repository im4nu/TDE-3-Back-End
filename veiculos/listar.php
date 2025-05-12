<!-- filepath: /home/manu/codes/locadora-php/veiculos/listar.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Veículos</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .vehicle-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 10px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .vehicle-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .vehicle-card h3 {
            margin: 10px 0;
            font-size: 1.5rem;
        }

        .vehicle-card p {
            margin: 5px 0;
            font-size: 1rem;
        }

        .vehicle-card .link {
            margin-top: 10px;
            display: inline-block;
        }

        .vehicle-card .disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Veículos</h1>
        <div class="vehicle-list">
            <?php
            // Simulação de dados (substitua por consulta ao banco de dados)
            $veiculos = [
                ['id' => 1, 'modelo' => 'Civic', 'marca' => 'Honda', 'ano' => 2020, 'imagem' => 'https://via.placeholder.com/300', 'status' => 'disponível'],
                ['id' => 2, 'modelo' => 'Corolla', 'marca' => 'Toyota', 'ano' => 2021, 'imagem' => 'https://via.placeholder.com/300', 'status' => 'alugado'],
                ['id' => 3, 'modelo' => 'Onix', 'marca' => 'Chevrolet', 'ano' => 2019, 'imagem' => 'https://via.placeholder.com/300', 'status' => 'disponível'],
            ];

            foreach ($veiculos as $veiculo) {
                echo "<div class='vehicle-card'>
                    <img src='{$veiculo['imagem']}' alt='Imagem do veículo'>
                    <h3>{$veiculo['modelo']}</h3>
                    <p><strong>Marca:</strong> {$veiculo['marca']}</p>
                    <p><strong>Ano:</strong> {$veiculo['ano']}</p>
                    <p><strong>Status:</strong> " . ucfirst($veiculo['status']) . "</p>";

                if ($veiculo['status'] === 'disponível') {
                    echo "<a href='alugar.php?id={$veiculo['id']}' class='link'>Alugar</a>";
                } else {
                    echo "<button class='link disabled' disabled>Indisponível</button>";
                }

                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>