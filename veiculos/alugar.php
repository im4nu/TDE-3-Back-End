<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Aluguel</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .modern-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        .modern-select:focus {
            border-color: #007bff;
            outline: none;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 25px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 25px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 19px;
            width: 19px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #007bff;
        }

        input:checked + .slider:before {
            transform: translateX(25px);
        }
    </style>
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

            <h2>Cliente</h2>
            <label for="cliente">Selecione um cliente:</label>
            <select id="cliente" name="cliente" class="modern-select" required>
                <option value="">Selecione um cliente</option>
                <?php
                require_once '../config/db.php';
                $stmt = $pdo->query("SELECT id, nome FROM usuarios");
                $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($clientes as $cliente) {
                    echo "<option value='{$cliente['id']}'>{$cliente['nome']}</option>";
                }
                ?>
            </select>

            <h2>Período de Aluguel</h2>
            <label for="data_inicio">Data de Início:</label>
            <input type="date" id="data_inicio" name="data_inicio" required>

            <label for="data_fim">Data de Término:</label>
            <input type="date" id="data_fim" name="data_fim" required>

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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const nomeInput = document.getElementById('nome');
            const emailInput = document.getElementById('email');
            const telefoneInput = document.getElementById('telefone');
            const suggestions = document.createElement('div');
            suggestions.style.position = 'absolute';
            suggestions.style.background = '#fff';
            suggestions.style.border = '1px solid #ccc';
            suggestions.style.zIndex = '9999';
            suggestions.style.width = `${nomeInput.offsetWidth}px`;
            suggestions.style.display = 'none'; // Inicialmente oculto
            nomeInput.parentNode.style.position = 'relative';
            nomeInput.parentNode.appendChild(suggestions);

            const updateSuggestionsPosition = () => {
                const rect = nomeInput.getBoundingClientRect();
                suggestions.style.top = `${nomeInput.offsetTop + nomeInput.offsetHeight}px`;
                suggestions.style.left = `${nomeInput.offsetLeft}px`;
            };

            nomeInput.addEventListener('input', async () => {
                const query = nomeInput.value;
                if (query.length < 2) {
                    suggestions.style.display = 'none';
                    suggestions.innerHTML = '';
                    return;
                }

                try {
                    const response = await fetch(`../clientes/buscar_cliente.php?nome=${query}`);
                    const clientes = await response.json();

                    suggestions.innerHTML = '';
                    if (clientes.length > 0) {
                        suggestions.style.display = 'block';
                        clientes.forEach(cliente => {
                            const suggestion = document.createElement('div');
                            suggestion.textContent = cliente.nome;
                            suggestion.style.padding = '10px';
                            suggestion.style.cursor = 'pointer';
                            suggestion.style.borderBottom = '1px solid #ddd';

                            suggestion.addEventListener('click', () => {
                                nomeInput.value = cliente.nome;
                                emailInput.value = cliente.email;
                                telefoneInput.value = cliente.telefone;
                                suggestions.style.display = 'none';
                                suggestions.innerHTML = '';
                            });

                            suggestions.appendChild(suggestion);
                        });
                    } else {
                        suggestions.style.display = 'none';
                    }
                } catch (error) {
                    console.error('Erro ao buscar clientes:', error);
                    suggestions.style.display = 'none';
                }
            });

            document.addEventListener('click', (e) => {
                if (!nomeInput.contains(e.target) && !suggestions.contains(e.target)) {
                    suggestions.style.display = 'none';
                    suggestions.innerHTML = '';
                }
            });

            document.getElementById('cliente').addEventListener('change', async function () {
                const clienteId = this.value;
                if (!clienteId) return;

                try {
                    const response = await fetch(`../clientes/buscar_cliente.php?id=${clienteId}`);
                    const cliente = await response.json();

                    if (cliente) {
                        document.getElementById('nome').value = cliente.nome;
                        document.getElementById('email').value = cliente.email;
                        document.getElementById('telefone').value = cliente.telefone;
                    }
                } catch (error) {
                    console.error('Erro ao buscar cliente:', error);
                }
            });

            const switchCliente = document.getElementById('switch-cliente');
            const switchLabel = document.getElementById('switch-label');
            const selectCliente = document.getElementById('select-cliente');
            const cadastroCliente = document.getElementById('cadastro-cliente');

            switchCliente.addEventListener('change', () => {
                if (switchCliente.checked) {
                    switchLabel.textContent = 'Sim';
                    selectCliente.style.display = 'block';
                    cadastroCliente.style.display = 'none';
                } else {
                    switchLabel.textContent = 'Não';
                    selectCliente.style.display = 'none';
                    cadastroCliente.style.display = 'block';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const switchCliente = document.getElementById('switch-cliente');
            const switchLabel = document.getElementById('switch-label');
            const selectCliente = document.getElementById('select-cliente');
            const cadastroCliente = document.getElementById('cadastro-cliente');
            const nomeInput = document.getElementById('nome');
            const emailInput = document.getElementById('email');
            const telefoneInput = document.getElementById('telefone');
            const clienteSelect = document.getElementById('cliente');
            const form = document.querySelector('form');

            const toggleRequiredFields = (isCadastro) => {
                if (isCadastro) {
                    nomeInput.setAttribute('required', 'true');
                    emailInput.setAttribute('required', 'true');
                    telefoneInput.setAttribute('required', 'true');
                    clienteSelect.removeAttribute('required');
                } else {
                    nomeInput.removeAttribute('required');
                    emailInput.removeAttribute('required');
                    telefoneInput.removeAttribute('required');
                    clienteSelect.setAttribute('required', 'true');
                }
            };

            switchCliente.addEventListener('change', () => {
                if (switchCliente.checked) {
                    switchLabel.textContent = 'Sim';
                    selectCliente.style.display = 'block';
                    cadastroCliente.style.display = 'none';
                    toggleRequiredFields(false);
                } else {
                    switchLabel.textContent = 'Não';
                    selectCliente.style.display = 'none';
                    cadastroCliente.style.display = 'block';
                    toggleRequiredFields(true);
                    clienteSelect.value = ''; // Limpa a seleção do cliente
                }
            });

            clienteSelect.addEventListener('change', async function () {
                const clienteId = this.value;
                if (!clienteId) {
                    nomeInput.value = '';
                    emailInput.value = '';
                    telefoneInput.value = '';
                    return;
                }

                try {
                    const response = await fetch(`../clientes/buscar_cliente.php?id=${clienteId}`);
                    const cliente = await response.json();

                    if (cliente) {
                        nomeInput.value = cliente.nome;
                        emailInput.value = cliente.email;
                        telefoneInput.value = cliente.telefone;
                    }
                } catch (error) {
                    console.error('Erro ao buscar cliente:', error);
                }
            });

            // Remover validação de campos ocultos ao enviar o formulário
            form.addEventListener('submit', (event) => {
                if (switchCliente.checked) {
                    nomeInput.removeAttribute('required');
                    emailInput.removeAttribute('required');
                    telefoneInput.removeAttribute('required');
                } else {
                    clienteSelect.removeAttribute('required');
                }
            });

            // Inicializa os campos obrigatórios corretamente
            toggleRequiredFields(!switchCliente.checked);
        });
    </script>
</body>
</html>