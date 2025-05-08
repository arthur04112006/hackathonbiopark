<?php
session_start();
$usuario_logado = isset($_SESSION['logado']) && $_SESSION['logado'] === true;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeadSubmit - Plataforma Científica</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="imagex/png" href="img/logoaba.jpg">
</head>
<body>
    <header>
        <nav class="navbar">
            <h1>HeadSubmit</h1>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="sobre.html">Sobre</a></li>
                <li><a href="eventos.php">Eventos</a></li>
                <li><a href="publicacoes.html">Artigos</a></li>
            </ul>
            <div class="nav-buttons">
                <?php if ($usuario_logado): ?>
                    <a href="perfil.php">
                        <button class="login">Meu Perfil</button>
                    </a>
                    <a href="php/logout.php">
                        <button class="criar-conta">Sair</button>
                    </a>
                <?php else: ?>
                    <a href="login.html">
                        <button class="login">Login</button>
                    </a>
                    <a href="cadastro.html">
                        <button class="criar-conta">Criar Conta</button>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <section class="banner">
        <h2>Submeta, Avalie e Publique sua Pesquisa Científica</h2>
        <p>Participe da Semana Científica na Faculdade Biopark</p>
        <div class="cta">
            <?php if ($usuario_logado): ?>
                <a href="submissao.html">
                    <button class="submeter">Submeter Artigo</button>
                </a>
                <a href="eventos.php">
                    <button class="ver-eventos">Ver Eventos</button>
                </a>
            <?php else: ?>
                <p class="login-message">Faça login para submeter artigos e ver eventos</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="eventos">
        <h3>Eventos Ativos</h3>
        <div class="cards">
            <div class="card">
                <h4>Semana Científica 2025</h4>

                <?php if ($usuario_logado): ?>
                    <a href="submissao.html">
                        <button class="submeter">Submeter</button>
                    </a>
                    <button class="ver-eventos">Ver Detalhes</button>
                <?php else: ?>
                    <p class="login-message">Faça login para participar</p>
                <?php endif; ?>
            </div>
            <div class="card">
                <h4>Simpósio de Inovação</h4>

                <?php if ($usuario_logado): ?>
                    <a href="submissao.html">
                        <button class="submeter">Submeter</button>
                    </a>
                    <button class="ver-eventos">Ver Detalhes</button>
                <?php else: ?>
                    <p class="login-message">Faça login para participar</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ... (o restante do seu footer permanece igual) ... -->

    <script src="script.js"></script>
</body>
</html>