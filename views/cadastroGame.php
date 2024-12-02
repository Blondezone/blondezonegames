<?php

require_once "../models/conexao.php";
require_once "../models/jogos.class.php";
require_once "../models/jogosDAO.php";

$msg = ["", "", ""];
$empresasCadastradas = [];
$imgpadrao = '../imagens/imgnull.webp';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validação dos campos obrigatórios
    if (empty($_POST["titulo"])) {
        $msg[0] = "Preencha o título do jogo";
        $erro = true;
    }

    if (empty($_POST["link"])) {
        $msg[1] = "Preencha o link";
        $erro = true;
    }

    if (empty($_POST["descricao"])) {
        $msg[2] = "Preencha a descrição";
        $erro = true;
    }

    // Upload da imagem
    $imagem = $imgpadrao;
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["tmp_name"]) {
        $diretorio = "../imagens/";
        $imagem = basename($_FILES["imagem"]["name"]);
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $diretorio . $imagem);
    }

    if (!$erro) {
        // Criação do objeto jogos
        $jogos = new Jogos(
            titulo: $_POST["titulo"],
            link: $_POST["link"],
            descricao: $_POST["descricao"],
            imagem: $imagem,
            id_adm: $_POST["id_adm"],
        );

        $jogosDAO = new jogosDAO();
        $jogosDAO->cadastrar($jogos); 
        
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Blondezone - Jogos</title>
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
<body class="dark-mode flex flex-col items-center">
    <header class="p-5 flex justify-center items-center w-screen">
        <div class="center-header max-w-[1300px] flex justify-between w-[80%]">
            <div class="logo-name flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256" class="fill-[#FF2E00] w-[50px] h-[50px]"><path d="M176,112H152a8,8,0,0,1,0-16h24a8,8,0,0,1,0,16ZM104,96H96V88a8,8,0,0,0-16,0v8H72a8,8,0,0,0,0,16h8v8a8,8,0,0,0,16,0v-8h8a8,8,0,0,0,0-16ZM241.48,200.65a36,36,0,0,1-54.94,4.81c-.12-.12-.24-.24-.35-.37L146.48,160h-37L69.81,205.09l-.35.37A36.08,36.08,0,0,1,44,216,36,36,0,0,1,8.56,173.75a.68.68,0,0,1,0-.14L24.93,89.52A59.88,59.88,0,0,1,83.89,40H172a60.08,60.08,0,0,1,59,49.25c0,.06,0,.12,0,.18l16.37,84.17a.68.68,0,0,1,0,.14A35.74,35.74,0,0,1,241.48,200.65ZM172,144a44,44,0,0,0,0-88H83.89A43.9,43.9,0,0,0,40.68,92.37l0,.13L24.3,176.59A20,20,0,0,0,58,194.3l41.92-47.59a8,8,0,0,1,6-2.71Zm59.7,32.59-8.74-45A60,60,0,0,1,172,160h-4.2L198,194.31a20.09,20.09,0,0,0,17.46,5.39,20,20,0,0,0,16.23-23.11Z"></path></svg> <!-- Espaço para a logo -->
            <h1 class="text-3xl select-none"><span class="font-bold bg-gradient-to-r from-[#FF2E00] to-[#FF5C00] bg-clip-text text-transparent">BLONDE</span><span class="zone italic">ZONE</span> </h1>
            </div>
            <button onclick="toggle()" class="p-2 text-white rounded-[13px] hover:bg-zinc-900 transition w-[50px] h-[50px]">
                <img class="icon-mode" src="imagens/sun.svg" alt="">
                <img class="moon hidden" src="imagens/moon.svg" alt="">
            </button>
        </div>
    </header>
    <main class="p-5 space-y-8 flex flex-col items-center">
        <section class="text-center">
            <span class="text-4xl font-extrabold bg-gradient-to-r from-[#FF2E00] to-[#FF5C00] bg-clip-text text-transparent"> <span class="explore text-white font-normal">Cadastre seus</span> Jogos!</span>
            <p class="mt-2">Clica no botão abaixo e cadastre seus melhores jogos no nosso site!</p>
        </section>
        
    </main>
    <footer class="p-5 text-center">
        <p>&copy; 2024 Blondezone. Todos os direitos reservados.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>