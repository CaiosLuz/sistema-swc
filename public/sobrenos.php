<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css'>
    <link rel='stylesheet' href='https://static.fontawesome.com/css/fontawesome-app.css'>
    <link rel='stylesheet' href='https://pro.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,700'>
    <link rel="stylesheet" href="./css/sobrenos.css">
    <title>SWC - Sobre nós</title>
</head>
<body>
    <div class="wrapper">
        <div class="back"></div>
        <video autoplay loop muted playsinline class="back-video">
            <source src="./img/boiando.mp4" type="video/mp4">
        </video>
        <nav class="nav">
            <div class="nav-logo">
            <p>SWC</p>
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="../home/home.html" class="link">Home</a></li>
                <li><a href="../" class="link">Estatísticas</a></li>
                <li><a href="#" class="link active">Sobre nós</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <button class="btn" onclick="logout()">Sair</button>
        </div>
    </nav>

    <div class="home-content">
        <h1>Os membros do projeto!</h1>
        <div class="options">
        <div class="option active" style="--optionBackground:url(../images/Matheus.png);">
            <div class="shadow"></div>
            <div class="label">
            <div class="info">
                <div class="main">Matheus</div>
                <div class="sub">Frontend</div>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/matheus" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/matheus" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://github.com/matheus" target="_blank"><i class="fab fa-github"></i></a>
                </div>
            </div>
            </div>
        </div>
        <div class="option" style="--optionBackground:url(../images/Caio.png);">
            <div class="shadow"></div>
            <div class="label">
            <div class="info">
                <div class="main">Caio</div>
                <div class="sub">Backend e QA</div>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/caio" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/caio" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://github.com/caio" target="_blank"><i class="fab fa-github"></i></a>
                </div>
            </div>
            </div>
        </div>
        <div class="option" style="--optionBackground:url(../images/J.png);">
            <div class="shadow"></div>
            <div class="label">
            <div class="info">
                <div class="main">João</div>
                <div class="sub">Documentação</div>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/joao" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/joao" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://github.com/joao" target="_blank"><i class="fab fa-github"></i></a>
                </div>
            </div>
            </div>
        </div>
        <div class="option" style="--optionBackground:url(../images/Henrique.jpg);">
            <div class="shadow"></div>
            <div class="label">
            <div class="info">
                <div class="main">Henrique</div>
                <div class="sub">Database</div>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/henrique" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/henrique" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://github.com/henrique" target="_blank"><i class="fab fa-github"></i></a>
                </div>
            </div>
            </div>
        </div>
        <div class="option" style="--optionBackground:url(../images/Felix.jpg);">
            <div class="shadow"></div>
            <div class="label">
            <div class="info">
                <div class="main">Matheus Felix</div>
                <div class="sub">Hardware</div>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/matheus-felix" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/matheus-felix" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://github.com/Felixx10" target="_blank"><i class="fab fa-github"></i></a>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src="script.js"></script>
</div>   
<script>
    function logout() {
        alert("Logout realizado com sucesso!");
    }
</script>
<script src="./js/sobrenos.js"></script>

</body>
</html>
