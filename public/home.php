<?php 

    $config = require_once '../config/database.php';
    $db = new PDO("mysql:host={$config['host']};dbname{$config['dbname']}", $config['username'], $config['password']);

    require_once '../app/controller/consumoAguaController.php';
    $controller = new ConsumoAguaController($db);
    $consumoAguaDia = $controller->model->getConsumoAguaDia();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/home.css">
    <title>SWC - Página Inicial</title>
</head>
<body>
<div class="wrapper">
    <div class="back"></div>
    <video autoplay loop muted playsinline class="back-video">
        <source src="./img/mar.mp4" type="video/mp4">
    </video>
    <nav class="nav">
        <div class="nav-logo">
            <p><img src="./img/logo-swc.png" alt="Logo SWC"></p>
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="#" class="link active">Home</a></li>
                <li><a href="./estatistica.php" class="link">Estatísticas</a></li>
                <li><a href="./sobrenos.php" class="link">Sobre nós</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <button class="btn" onclick="logout()">Sair</button>
        </div>
    </nav>

<!----------------------------- Conteúdo da Página Inicial ----------------------------------->    
    <div class="home-content">
        <h1>Monitore seu consumo diário de água!</h1>
        <div class="windows">
            <div class="window" id="window1"><?= $resultado['totalLitros'] ?></div>
        </div>
    </div>
</div>   

<script>

    // Função para atualizar a pagina automaticamente para obter resultado simultaneo
    setTimeout(function() {
        location.reload();
    }, 60000);

    function logout() {
        // Aqui você pode adicionar a lógica para fazer logout, se necessário
        alert("Logout realizado com sucesso!");
        // Exemplo de redirecionamento para a página de login:
        // window.location.href = "login.html";
    }

    // Seleciona todas as windows
    var windows = document.querySelectorAll('.window');

    // Cria a gota e o texto
    var dropImage = document.createElement('img');
    dropImage.src = 'images/gota.png'; // Coloque o caminho real da sua imagem
    dropImage.alt = 'Gota';
    dropImage.classList.add('drop-image');

    var dropText = document.createElement('p');
    dropText.classList.add('drop-text');
    dropText.textContent = 'Seu texto aqui';

    // Itera sobre cada window
    windows.forEach(function(window) {
        // Adiciona evento de mouseover
        window.addEventListener('mouseover', function() {
            this.style.transform = 'scale(1.2)'; // Aumenta o tamanho da janela quando o mouse está sobre ela
            this.style.backgroundColor = '#07343d'; // Altera a cor de fundo da janela

            // Adiciona a gota e o texto à window
            this.appendChild(dropImage.cloneNode(true));
            this.appendChild(dropText.cloneNode(true));
        });

        // Adiciona evento de mouseout
        window.addEventListener('mouseout', function() {
            this.style.transform = 'scale(1)'; // Retorna o tamanho da janela ao normal quando o mouse sai dela
            this.style.backgroundColor = '#010a1b'; // Restaura a cor de fundo original da janela

            // Remove a gota e o texto quando o mouse sai da window
            var dropImageInstance = this.querySelector('.drop-image');
            var dropTextInstance = this.querySelector('.drop-text');
            if (dropImageInstance) dropImageInstance.remove();
            if (dropTextInstance) dropTextInstance.remove();
        });
    });

</script>

</body>
</html>
