<?php
require_once '../models/Conexao.php';
require_once '../models/adminDAO.class.php';
require_once '../models/Admin.class.php';
require_once "../views/header.php"; 

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
            
            // Recupera o id do admin recém-cadastrado
            $id_adm = $adminDAO->getLastInsertedId();  // Você precisa garantir que este método esteja implementado para pegar o ID do admin inserido
            
            $_SESSION['id'] = $id_adm;
            $_SESSION['adm'] = $nome;

            echo "Administrador cadastrado com sucesso!";
            
            // Redireciona para o cadastro do jogo
            header("Location: ../views/cadastroGame.php");
            exit(); // Importante para garantir que o restante do script não seja executado
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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Cadastrar Administrador</title>
    <style>
        body {
            transition: background-color 0.5s, color 0.5s;
        }

        .light-mode{
            background-color: #f3f4f6;
            color: #111827;
        }
        .dark-mode {
            background-color: #030303;
            color: #f3f4f6;
        }
        .game-card {
            background-color: #141414; 
        }

        header{
            background-color: #030303;
            border-bottom: 1px solid rgb(46, 46, 46);
        }

        .light-mode .game-card{
            background-color: #e5e7eb; 
            color: #111827;
        }

        .light-mode header{
            background-color: #ffffff; 
            border-bottom: 1px solid rgb(216, 216, 216);
        }

        header::before{
            content: "";
            width: 700px;
            height: 100px;
            background-color: white;
            position: absolute;
            z-index: -1;
            border-radius: 50%;
            top: -50px;
            filter: blur(100px) opacity(40%);
        }

    </style>
</head>

<body class="dark-mode flex flex-col items-center">

    <main class="p-5 space-y-8 flex flex-col items-center">
        <div class="login-box bg-[#1F1F1F] p-8 rounded-lg shadow-lg w-96 mt-[10%]">
            <h1 class="text-2xl text-white font-bold mb-4 text-center">Cadastrar Novo Administrador</h1>
            <form action="../views/cadastro.php" method="POST" class="p-6 rounded-lg">
                <input
                    type="text"
                    name="adm"
                    placeholder="Nome do Administrador"
                    required
                    class="mb-4 p-2 w-full rounded bg-[#414141] text-white"
                />
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                    class="mb-4 p-2 w-full rounded bg-[#414141] text-white"
                />
                <input
                    type="password"
                    name="senha"
                    placeholder="Senha"
                    required
                    class="mb-4 p-2 w-full rounded bg-[#414141] text-white"
                />
                <button
                    type="submit"
                    class="bg-gradient-to-r from-[#FF2E00] to-[#FF5C00] text-white py-2 px-4 rounded w-full"
                >
                    Cadastrar
                </button>
            </form>
        </div>
    </main>

    <footer class="p-5 text-center absolute bottom-0 w-full">
        <p class="text-white">&copy; 2024 Blondezone. Todos os direitos reservados.</p>
    </footer>

    <script src="script-login.js"></script>
</body>
</html>
