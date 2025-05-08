<?php
// Habilitar exibição de erros (apenas para desenvolvimento)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inicia a sessão
session_start();

// Inclui o arquivo de conexão PDO
require_once 'conexao.php';

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../login.html");
    exit();
}

// Coletar os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Validações básicas
if (empty($email) || empty($senha)) {
    $_SESSION['erro_login'] = "Por favor, preencha todos os campos!";
    header("Location: ../login.html");
    exit();
}

try {
    // Busca o usuário no banco de dados
    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    
    // Verifica se encontrou o usuário
    if ($stmt->rowCount() === 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido - armazena dados na sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['logado'] = true;
            
            // Redireciona para a página restrita
            header("Location: ../painel_avaliador.html");
            exit();
        }
    }
    
    // Se chegou aqui, login falhou
    $_SESSION['erro_login'] = "E-mail ou senha incorretos!";
    header("Location: ../login.html");
    exit();

} catch (PDOException $e) {
    // Log do erro (em produção, grave em um arquivo de log)
    error_log("Erro no login: " . $e->getMessage());
    
    $_SESSION['erro_login'] = "Erro no sistema. Por favor, tente novamente.";
    header("Location: ../login.html");
    exit();
}
?>