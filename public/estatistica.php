<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/home.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <title>SWC - Estatísticas</title>
</head>
<body>
    <div class="wrapper">
        <div class="back"></div>
        <video autoplay loop muted playsinline class="back-video">
            <source src="./img/mar.mp4" type="video/mp4">
        </video>
        <nav class="nav">
            <div class="nav-logo">
                <p>SWC</p>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="./home.php" class="link">Home</a></li>
                    <li><a href="#" class="link">Estatísticas</a></li>
                    <li><a href="./sobrenos.php" class="link">Sobre nós</a></li>
                </ul>
            </div>
            <div class="nav-button">
                <button class="btn" onclick="logout()">Sair</button>
            </div>
        </nav>

<!----------------------------- Conteúdo da Página Inicial ----------------------------------->    
        <div class="home-content">

            <!-- Seleção de periodo -->

            <form id="periodoForm">
                <label for="periodoSelecionado">Período:</label>
                <select name="periodo" id="periodoSelecionado">
                    <option value="diario">Diário</option>
                    <option value="semanal">Semanal</option>
                    <option value="mensal">Mensal</option>
                    <option value="anual">Anual</option>
                </select>
            </form>

            <div id="chart_div"></div>

            <script>

                async function fetchData(range) {
                    const response = await fetch(`../app/controller/consumoAguaController.php?action=consumoPeriodo&range=${range}`);
                    const data = await response.json();
                    console.log('Dados recebidos:', data);  
                    return data;
                }

                async function updateChart() {
                    const periodo = document.getElementById('periodoSelecionado').value;
                    const data = await fetchData(periodo);

                    const chartData = data.map(item => [item.label, parseFloat(item.totalLitro)]);

                    var dataTable = new google.visualization.DataTable();
                    dataTable.addColumn('string', 'Período');
                    dataTable.addColumn('number', 'Total de litros');
                    dataTable.addRows(chartData);

                    var options = {
                        title: 'Gasto de água por período',
                        width: 800,
                        height: 500
                    };

                    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                    chart.draw(dataTable, options);
                }

                document.getElementById('periodoSelecionado').addEventListener('change', updateChart);

                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(updateChart);

            </script>

        </div>
    </div>
</body>
</html>