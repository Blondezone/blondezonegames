<?php require_once "../views/header.php"; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Blondezone - Login admin</title>
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
    <link rel="shortcut icon" href="imagens/game-controller.svg" type="image/x-icon">
</head>

<?php
$msg = ["", "", ""];// armazenar mensagens de erro ou sucesso

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "../models/conexao.php";
    require_once "../models/admin.class.php";
    require_once "../models/AdminDAO.class.php";

    //valida se os campos de entrada do formulário foram preenchidos
    function validarFormulario() {
        $erro = false;

        if (empty($_POST["email"])) {
            $msg[0] = "Preencha o email";
            $erro = true;
        }

        if (empty($_POST["senha"])) {
            $msg[1] = "Preencha a senha";
            $erro = true;
        }

        return !$erro;
    }

    // Executa a validação e, se passar, faz o login
    if (validarFormulario()) {
        $admin = new admin(email: $_POST["email"], senha: md5($_POST["senha"]));

        $adminDAO = new adminDAO();
        $ret = $adminDAO->login($admin);

        if (count($ret) == 1) {
            $_SESSION["id"] = $ret[0]->id_admin;
            $_SESSION["adm"] = $ret[0]->nome;

            header("location:../views/index.php");
            exit();
        } else {
            $msg[2] = "Verifique seus dados";
        }
    }
}
?>


<body class="dark-mode flex flex-col items-center">
    <main class="p-5 space-y-8 flex flex-col items-center">
        <div class="login-box bg-[#1F1F1F] p-8 rounded-lg shadow-lg w-96 mt-[10%]">
            <h1 class="text-2xl text-white font-bold mb-4 text-center">Login</h1>
            <form action="#" method="POST" class="p-6 rounded-lg">
              <h2 class="text-white text-2xl mb-4">Faça Login</h2>
              <input
                type="email"
                name="email"
                placeholder="Email"
                required
                class="mb-4 p-2 w-full rounded bg-[#414141] text-white"
              />
              <input
                type="password"
                name="password"
                placeholder="Senha"
                required
                class="mb-4 p-2 w-full rounded bg-[#414141] text-white"
              />
              <button
                type="submit"
                class="bg-gradient-to-r from-[#FF2E00] to-[#FF5C00] text-white py-2 px-4 rounded"
              >
                Login
              </button>
            </form>
            <p class="mt-4 text-white text-center">
              Não possui uma conta?
              <a href="#" class="text-[#FF2E00] hover:underline"
                >Registrar</a
              >
            </p>
          </div>
    </main>
    <footer class="p-5 text-center absolute bottom-0">
        <p>&copy; 2024 Blondezone. Todos os direitos reservados.</p>
    </footer>
    <script src="script-login.js"></script>
</body>
</html>