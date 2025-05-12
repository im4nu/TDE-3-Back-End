<!-- filepath: /home/manu/codes/locadora-php/veiculos/confirmar.php -->
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