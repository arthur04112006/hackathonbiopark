<?php
session_start();
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - HeadSubmit</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="imagex/png" href="img/logoaba.jpg">
</head>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    
    // Validação simples no cliente
    if (email.trim() === '' || senha.trim() === '') {
        e.preventDefault();
        alert('Por favor, preencha todos os campos!');
        return false;
    }
    
    return true;
});
</script>
<body>
    <section class="login-container">
        <h2>Login</h2>
        <form id="loginForm" action="./php/processaLogin.php" method="post">
            <label for="email">E-mail:</label>
            <!-- Altere os inputs para incluir o atributo name -->
            <input type="email" id="email" name="email" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Entrar</button>
        </form>
    </section>
</body>
</html>

