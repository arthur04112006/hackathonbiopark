<?php

include_once ("conexao.php");

// // Verificar conexão
// if ($conn->connect_error) {
//     die("Falha na conexão: " . $conn->connect_error);
// }
// echo "Conexão bem-sucedida!";
// // conexao foi estabelecida!!!!!!!!!!!

// A CONEXAO ESTA ESTABELCIDA!!!!

$email = $_POST['email'];
$senha = $_POST['senha'];
// Verifica se o usuário existe no banco de dados
$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$result = $conn->query($sql);
// Verifica se o usuário foi encontrado
if ($result->num_rows > 0) {
    // Inicia a sessão
    session_start();
    // Armazena o email do usuário na sessão
    $_SESSION['email'] = $email;
    // Redireciona para a página de boas-vindas
    header("Location: index.html");
    exit();
} else {
    echo "Email ou senha incorretos.";
}

?>