<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verifica campos obrigatórios
    if (empty($nome) || empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
        exit();
    }

    // Valida email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido.";
        exit();
    }

    // Verifica tamanho da senha
    if (strlen($senha) < 6) {
        echo "A senha deve ter pelo menos 6 caracteres.";
        exit();
    }

    // Verifica se o email já existe
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "O email já está cadastrado.";
        exit();
    }

    // Insere o usuário
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    
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
    <form method="POST" action="" onsubmit="return validarFormulario()">
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
    <script>
        function validarFormulario() {
            const nome = document.getElementById('nome').value.trim();
            const email = document.getElementById('email').value.trim();
            const senha = document.getElementById('senha').value;

            if (nome === '' || email === '' || senha === '') {
                alert('Por favor, preencha todos os campos.');
                return false;
            }

            // Validação básica de email
            const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regexEmail.test(email)) {
                alert('Por favor, insira um email válido.');
                return false;
            }

            if (senha.length < 6) {
                alert('A senha deve ter pelo menos 6 caracteres.');
                return false;
            }

            return true; // Se todas as validações passarem
        }
    </script>
    <a href="listar_usuarios.php">Voltar para a Lista</a>
</body>
</html>
