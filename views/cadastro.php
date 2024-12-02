<?php
require_once '../models/Conexao.php';
require_once '../models/adminDAO.class.php';
require_once '../models/Admin.class.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adm = $_POST['adm'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Valida os campos básicos
    if (empty($adm) || empty($email) || empty($senha)) {
        echo "Todos os campos são obrigatórios.";
    } else {
        // Criptografa a senha antes de armazenar
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        // Cria uma instância do Admin
        $admin = new Admin(0, $adm, $email, $senhaCriptografada);

        // Cria uma instância do adminDAO e cadastra o admin
        $adminDAO = new adminDAO();
        try {
            $adminDAO->cadastrar($admin);
            echo "Administrador cadastrado com sucesso!";
        } catch (Exception $e) {
            echo "Erro ao cadastrar administrador: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Administrador</title>
</head>
<body>
    <h1>Cadastrar Novo Administrador</h1>
    <form action="../views/cadastro.php" method="POST">
    <label for="adm">Nome do Administrador:</label><br>
        <input type="text" id="adm" name="adm" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
