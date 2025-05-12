<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locadora</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #444;
        }

        .links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .link {
            display: inline-block;
            padding: 15px 30px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
        }

        .link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo à Locadora</h1>
        <p>Escolha uma das opções abaixo para gerenciar ou alugar veículos:</p>
        <div class="links">
            <a href="clientes/index.php" class="link">Clientes</a>
            <a href="veiculos/index.php" class="link">Veículos</a>
            <a href="veiculos/listar.php" class="link">Alugar Veículo</a>
        </div>
    </div>
</body>
</html>