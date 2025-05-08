<?php
include 'config.php';

// // Verificar conexão
// if ($conn->connect_error) {
//     die("Falha na conexão: " . $conn->connect_error);
// }
// echo "Conexão bem-sucedida!";

//conexao foi estabelecida!!!!!!!!!!!

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];


// // Insere o novo usuário no banco de dados
$sql = "INSERT INTO usuarios ('nome', 'email', 'telefone', 'senha') VALUES ('$nome', '$email','$telefone' '$senha')";
// Conexão com o banco de dados
if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
    header ("Location: login.html");
    exit();
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
$conn->close();

?>

