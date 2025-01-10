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
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome']; ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>" required>
        <br>
        <button type="submit">Salvar Alterações</button>
    </form>
    <a href="listar_usuarios.php">Voltar para a Lista</a>
</body>
</html>
