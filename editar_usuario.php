<?php
require 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $result = $conn->query($sql);
    $usuario = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if (empty($nome) || empty($email)) {
        echo "Por favor, preencha todos os campos.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido.";
        exit();
    }

    // Verifica se o email já está em uso por outro usuário
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND id != $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "O email já está em uso por outro usuário.";
        exit();
    }

    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = $id";

    if ($conn->query($sql)) {
        echo "Usuário atualizado com sucesso!";
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
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Editar Usuário</h1>
    <a href="index.php" class="back-button">Voltar para a Tela Principal</a>
    <form method="POST" action="" onsubmit="return validarFormulario()">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome']; ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>" required>
        <br>
        <button type="submit">Salvar Alterações</button>
    </form>
    <script>
        function validarFormulario() {
            const nome = document.getElementById('nome').value.trim();
            const email = document.getElementById('email').value.trim();

            if (nome === '' || email === '') {
                alert('Por favor, preencha todos os campos.');
                return false;
            }

            const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regexEmail.test(email)) {
                alert('Por favor, insira um email válido.');
                return false;
            }

            return true;
        }
    </script>
    <a href="listar_usuarios.php">Voltar para a Lista</a>
</body>
</html>
