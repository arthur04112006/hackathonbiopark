<?php
// Arquivo: php/processaCadastro.php

// Habilitar exibição de erros (apenas para desenvolvimento)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclui o arquivo de conexão PDO
require_once 'conexao.php';

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.html");
    exit();
}

// Coletar os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// Validações básicas
if (empty($nome) || empty($email) || empty($senha)) {
    die("Por favor, preencha todos os campos obrigatórios!");
}

// Hash da senha usando bcrypt
$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

try {
    // Prepara e executa a query usando PDO
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $pdo->prepare($sql);
    
    // Bind dos parâmetros
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
    
    // Executa a query
    if ($stmt->execute()) {
        // Cadastro bem-sucedido
        header("Location: ../login.html");
        exit();
    }
} catch (PDOException $e) {
    // Tratamento de erro
    if ($e->getCode() == 23000) {
        // Erro de duplicação (email já cadastrado)
        die("Este e-mail já está cadastrado!");
    } else {
        die("Erro ao cadastrar: " . $e->getMessage());
    }
}
?>