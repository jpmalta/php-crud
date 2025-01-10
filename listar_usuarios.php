<?php
require 'conexao.php';

// Consulta para buscar todos os usuários
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Lista de Usuários</h1>
    <a href="cadastrar_usuario.php">Cadastrar Novo Usuário</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="editar_usuario.php?id=<?php echo $row['id']; ?>">Editar</a> |
                            <a href="excluir_usuario.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum usuário encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
