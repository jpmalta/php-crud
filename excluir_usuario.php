<?php
require 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id = $id";

    if ($conn->query($sql)) {
        echo "Usuário excluído com sucesso!";
        header('Location: listar_usuarios.php');
        exit();
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>
