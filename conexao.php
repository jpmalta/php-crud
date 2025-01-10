<?php
$host = 'localhost';
$user = 'root'; // Usuário padrão do MySQL no XAMPP
$password = ''; // Sem senha padrão no XAMPP
$database = 'desafio';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die('Falha na conexão: ' . $conn->connect_error);
}
?>
