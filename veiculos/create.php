<!-- filepath: /home/manu/codes/locadora-php/veiculos/cadastrar.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Veículo</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Veículo</h1>
        <form action="salvar.php" method="POST">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required><br><br>

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required><br><br>

            <label for="ano">Ano:</label>
            <input type="number" id="ano" name="ano" required><br><br>

            <label for="imagem">Link da Imagem:</label>
            <input type="url" id="imagem" name="imagem" placeholder="Exemplo: https://exemplo.com/imagem.jpg" required><br><br>

            <button type="submit" class="link">Salvar</button>
        </form>
    </div>
</body>
</html>