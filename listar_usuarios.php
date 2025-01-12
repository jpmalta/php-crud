<?php
require 'conexao.php';

// Consulta para buscar todos os usuários
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $query = $pdo->prepare("SELECT * FROM usuarios WHERE nome LIKE :search OR email LIKE :search");
    $query->bindValue(':search', '%' . $search . '%');
} else {
    $query = $pdo->prepare("SELECT * FROM usuarios");
}

$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
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
    <header>
        <h1>Lista de Usuários</h1>
        <a href="cadastrar_usuario.php">Cadastrar Novo Usuário</a>
        <a href="index.php" class="back-button">Voltar para a Tela Principal</a>
    </header>
    <!-- Formulário de Busca -->
    <form method="GET" action="listar_usuarios.php" style="text-align: center; margin-bottom: 20px;">
            <input 
                type="text" 
                name="search" 
                placeholder="Digite o nome ou email" 
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" 
                style="padding: 10px; width: 300px;"
            >
            <button type="submit" style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px;">Buscar</button>
        </form>
    <!-- Tabela de Usuários -->   
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
            <?php if (count($usuarios) > 0) {
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>{$usuario['id']}</td>";
                    echo "<td>{$usuario['nome']}</td>";
                    echo "<td>{$usuario['email']}</td>";
                    echo "<td>
                            <a href='editar_usuario.php?id={$usuario['id']}'>Editar</a> | 
                            <a href='excluir_usuario.php?id={$usuario['id']}'>Excluir</a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum usuário encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
