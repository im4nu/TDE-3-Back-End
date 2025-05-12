<?php
require_once '../config/db.php';

// Atualizar a consulta para garantir que o status atualizado seja refletido
$stmt = $pdo->query("SELECT * FROM veiculos");
$veiculos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locadora de Veículos - Elegância e Conforto</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Estilos modernos e elegantes */
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            color: #333;
            background-color: #f9f9f9;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20%;
            height: 70px;
        }

        .navbar a {
            text-decoration: none;
            color: #333;
            margin: 0 15px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #007bff;
        }

        .hero {
            height: 70vh;
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .hero video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .hero_mask {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            background: #000;
            opacity: 0.7;
            z-index: -1;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 70%;
            z-index: 1;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }

        .hero-content h1 {
            font-size: 4rem;
            color: white;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .about {
            padding: 80px 20px;
            text-align: center;
            background: #fff;
        }

        .about h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .about p {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        .vehicle-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 50px 20px;
        }

        .vehicle-card {
            width: 250px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .vehicle-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .vehicle-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .vehicle-card h3 {
            margin: 10px;
            font-size: 1.2rem;
        }

        .vehicle-card p {
            margin: 5px 10px;
            font-size: 0.9rem;
            color: #555;
        }

        .vehicle-card .status {
            font-weight: bold;
            color: #ff0000;
        }

        .vehicle-card .status.disponivel {
            color: #28a745;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">Locadora</div>
        <div class="links">
            <a href="../veiculos/index.php">Veículos</a>
            <a href="../clientes/index.php">Clientes</a>
        </div>
    </div>

    <div class="hero" id="hero">
        <video autoplay muted loop>
            <source src="../src/hero.mp4" type="video/mp4">
            Seu navegador não suporta o elemento de vídeo.
        </video>
        <div class="hero_mask"></div>
        <div class="hero-content">
            <h1>Bem-vindo à Locadora</h1>
            <p>Encontre o veículo perfeito para você!</p>
        </div>
    </div>

    <div class="about" id="about">
        <h2>Sobre Nós</h2>
        <p>Somos uma locadora de veículos focada em oferecer a melhor experiência para nossos clientes. Com uma frota diversificada e atendimento de qualidade, garantimos sua satisfação.</p>
    </div>

    <div class="container" id="veiculos">
        <h2>Carros Disponíveis</h2>
        <div class="vehicle-list">
            <?php
            $stmt = $pdo->query("SELECT * FROM veiculos");
            $veiculos = $stmt->fetchAll();

            foreach ($veiculos as $veiculo): ?>
                <div class="vehicle-card">
                    <img src="<?= htmlspecialchars($veiculo['imagem']) ?>" alt="Imagem do veículo">
                    <h3><?= htmlspecialchars($veiculo['modelo']) ?></h3>
                    <p><strong>Marca:</strong> <?= htmlspecialchars($veiculo['marca']) ?></p>
                    <p><strong>Ano:</strong> <?= htmlspecialchars($veiculo['ano']) ?></p>
                    <p><strong>Placa:</strong> <?= htmlspecialchars($veiculo['placa']) ?></p>
                    <p class="status <?= $veiculo['status'] === 'disponível' ? 'disponivel' : '' ?>">
                        <strong>Status:</strong> <?= htmlspecialchars(ucfirst($veiculo['status'])) ?>
                    </p>
                    <?php if ($veiculo['status'] === 'disponível'): ?>
                        <a href="alugar.php?id=<?= $veiculo['id'] ?>" class="link">Alugar</a>
                    <?php else: ?>
                        <button class="link disabled" disabled>Indisponível</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Locadora de Veículos. Todos os direitos reservados.</p>
    </div>
</body>
</html>