<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    if ($conn->query($sql)) {
        echo "Usuário cadastrado com sucesso!";
        header('Location: listar_usuarios.php');
        exit();
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Cadastrar Novo Usuário</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <button type="submit">Cadastrar</button>
    </form>
    <a href="listar_usuarios.php">Voltar para a Lista</a>
</body>
</html>
