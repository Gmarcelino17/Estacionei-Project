<?php
    session_start();

    // Verifica se o usuário está logado
    if (!isset($_SESSION['Senha'])) {
        header("location: index.php");
        exit; 
    }

    // Inicializa a data atual e os contadores
    if (!isset($_SESSION['diaAtual'])) {
        $_SESSION['diaAtual'] = 0; // 0 = Segunda-feira
    }
    if (!isset($_SESSION['contadorEntrada']) || !is_array($_SESSION['contadorEntrada'])) {
        $_SESSION['contadorEntrada'] = [0, 0, 0, 0, 0, 0, 0]; // Contadores para cada dia da semana
    }
    if (!isset($_SESSION['contadorSaida']) || !is_array($_SESSION['contadorSaida'])) {
        $_SESSION['contadorSaida'] = [0, 0, 0, 0, 0, 0, 0]; // Contadores para cada dia da semana
    }

    // Avança a data ao clicar no botão "Avançar Data"
    if (isset($_POST['avancarData'])) {
        $_SESSION['diaAtual']++;
        if ($_SESSION['diaAtual'] > 6) { // Se for domingo (6), reseta para segunda-feira
            $_SESSION['diaAtual'] = 0;
            $_SESSION['contadorEntrada'] = [0, 0, 0, 0, 0, 0, 0]; // Zera os contadores
            $_SESSION['contadorSaida'] = [0, 0, 0, 0, 0, 0, 0]; // Zera os contadores
        }
    }

    // Atualiza os contadores ao abrir ou fechar as cancelas
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['acaoEntrada']) && $_POST['acaoEntrada'] === 'Abrir') {
            if (isset($_SESSION['contadorEntrada'][$_SESSION['diaAtual']])) {
                $_SESSION['contadorEntrada'][$_SESSION['diaAtual']]++; // Incrementa o contador de entradas para o dia atual
            }
        }
        if (isset($_POST['acaoSaida']) && $_POST['acaoSaida'] === 'Abrir') {
            if (isset($_SESSION['contadorSaida'][$_SESSION['diaAtual']])) {
                $_SESSION['contadorSaida'][$_SESSION['diaAtual']]++; // Incrementa o contador de saídas para o dia atual
            }
        }
    }

    // Dias da semana
    $diasSemana = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
?>

<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Painel de Controle - Estacionei</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js -->
        <style>
            /* Estilos básicos para o painel em modo escuro */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #121212; /* Fundo preto */
                color: #f4f4f9; /* Texto claro */
                display: flex;
            }

            .sidebar {
                width: 250px;
                background-color: #1e1e1e; /* Cinza escuro */
                height: 100vh;
                padding: 20px;
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
            }

            .sidebar h2 {
                color: #ffcc00; /* Amarelo */
                margin-bottom: 20px;
            }

            .sidebar a {
                display: block;
                color: #f4f4f9;
                text-decoration: none;
                margin-bottom: 10px;
                padding: 10px;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            .sidebar a:hover {
                background-color: #ffcc00; /* Amarelo */
                color: #121212; /* Preto */
            }

            .content {
                flex: 1;
                padding: 20px;
            }

            .navbar {
                background-color: #1e1e1e; /* Cinza escuro */
                color: #f4f4f9;
                padding: 15px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .navbar h1 {
                margin: 0;
                font-size: 24px;
                color: #ffcc00; /* Amarelo */
            }

            .navbar form {
                margin: 0;
            }

            .navbar button {
                padding: 10px 20px;
                font-size: 16px;
                border-radius: 5px;
                border: none;
                cursor: pointer;
                background-color: #ffcc00; /* Amarelo */
                color: #121212; /* Preto */
                font-weight: bold;
            }

            .navbar button:hover {
                background-color: #e6b800; /* Amarelo mais escuro */
            }

            .chart-container {
                margin-bottom: 20px;
                background-color: #1e1e1e; /* Cinza escuro */
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
                max-width: 600px; /* Reduz o tamanho do gráfico */
                margin: 0 auto; /* Centraliza o gráfico */
            }

            .chart-container h2 {
                color: #ffcc00; /* Amarelo */
                text-align: center;
            }

            .card {
                background-color: #1e1e1e; /* Cinza escuro */
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
                padding: 20px;
                margin-bottom: 20px;
                color: #f4f4f9;
            }

            .card h2 {
                margin-top: 0;
                color: #ffcc00; /* Amarelo */
            }

            .status-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
            }

            .status-container label {
                font-size: 18px;
                font-weight: bold;
            }

            .status-container button {
                padding: 10px 20px;
                font-size: 16px;
                border-radius: 5px;
                border: none;
                cursor: pointer;
                background-color: #ffcc00; /* Amarelo */
                color: #121212; /* Preto */
                font-weight: bold;
            }

            .status-container button:hover {
                background-color: #e6b800; /* Amarelo mais escuro */
            }
        </style>
    </head>
    <body>
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Menu</h2>
            <a href="#">Dashboard</a>
            <a href="#">Controle de Acesso</a>
            <a href="#">Relatórios</a>
            <a href="index.php">Sair</a>
        </div>

        <!-- Conteúdo principal -->
        <div class="content">
            <div class="navbar">
                <h1>Estacionei - Painel de Controle</h1>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="avancarData">Avançar Data</button>
                </form>
            </div>

            <!-- Gráfico de movimentação -->
            <div class="chart-container">
                <h2>Fluxo Semanal</h2>
                <canvas id="movimentacaoGrafico"></canvas>
            </div>

            <!-- Card para controle de acesso -->
            <div class="card">
                <h2>Controle de Acesso</h2>
                <div class="status-container">
                    <label>Cancela de Entrada: <?php echo $diasSemana[$_SESSION['diaAtual']] . ' - ' . $_SESSION['contadorEntrada'][$_SESSION['diaAtual']]; ?></label>
                    <form method="POST" style="display: inline;">
                        <button type="submit" name="acaoEntrada" value="Abrir">Abrir</button>
                        <button type="submit" name="acaoEntrada" value="Fechar">Fechar</button>
                    </form>
                </div>
                <div class="status-container">
                    <label>Cancela de Saída: <?php echo $diasSemana[$_SESSION['diaAtual']] . ' - ' . $_SESSION['contadorSaida'][$_SESSION['diaAtual']]; ?></label>
                    <form method="POST" style="display: inline;">
                        <button type="submit" name="acaoSaida" value="Abrir">Abrir</button>
                        <button type="submit" name="acaoSaida" value="Fechar">Fechar</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            // Dados para o gráfico
            const data = {
                labels: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'], // Dias da semana
                datasets: [
                    {
                        label: 'Entradas',
                        data: <?php echo json_encode($_SESSION['contadorEntrada']); ?>, // Dados de entradas
                        backgroundColor: 'rgba(255, 204, 0, 0.7)', // Amarelo
                        borderColor: '#ffcc00',
                        borderWidth: 1
                    },
                    {
                        label: 'Saídas',
                        data: <?php echo json_encode($_SESSION['contadorSaida']); ?>, // Dados de saídas
                        backgroundColor: 'rgba(0, 255, 0, 0.7)', // Verde
                        borderColor: '#00ff00',
                        borderWidth: 1
                    }
                ]
            };

            // Configuração do gráfico
            const config = {
                type: 'bar', // Tipo de gráfico
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: '#f4f4f9' // Cor do texto da legenda
                            }
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#f4f4f9' // Cor dos rótulos do eixo X
                            }
                        },
                        y: {
                            min: 0, // Início do eixo Y
                            max: 100, // Fim do eixo Y
                            ticks: {
                                color: '#f4f4f9', // Cor dos rótulos do eixo Y
                                stepSize: 10 // Exibe os valores de 10 em 10
                            }
                        }
                    },
                    plugins: [
                        {
                            id: 'highlightCurrentDay',
                            beforeDraw: (chart) => {
                                const ctx = chart.ctx;
                                const xAxis = chart.scales.x;
                                const yAxis = chart.scales.y;
                                const currentDayIndex = <?php echo $_SESSION['diaAtual']; ?>;

                                // Coordenadas da bolinha
                                const x = xAxis.getPixelForTick(currentDayIndex);
                                const y = yAxis.bottom + 10;

                                // Desenha a bolinha
                                ctx.beginPath();
                                ctx.arc(x, y, 5, 0, 2 * Math.PI); // Bolinha com raio 5
                                ctx.fillStyle = '#ffcc00'; // Cor amarela
                                ctx.fill();
                                ctx.closePath();
                            }
                        }
                    ]
                }
            };

            // Renderiza o gráfico
            const ctx = document.getElementById('movimentacaoGrafico').getContext('2d');
            const movimentacaoGrafico = new Chart(ctx, config);
        </script>
    </body>
</html>
