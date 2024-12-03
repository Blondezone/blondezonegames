<?php
require_once "../models/conexao.php";
require_once "../models/jogosDAO.php";
require_once "../views/header.php";
?>

<?php
$jogosDAO = new jogosDAO();
$jogos = $jogosDAO->listarJogos(); 
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

        img {
            width: 200px;
            height: auto;
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
        <button style="margin: 20px ;" onclick="toggle()" class="p-2 text-white rounded-[13px] hover:bg-zinc-900 transition w-[50px] h-[50px]">
                <img class="icon-mode" src="../imagens/sun.svg" alt="">
                <img class="moon hidden" src="../imagens/moon.svg" alt="">
        </button>
<body class="dark-mode flex flex-col items-center">
    <main class="p-5 space-y-8 flex flex-col items-center">
        <section class="text-center">
            <span class="text-4xl font-extrabold bg-gradient-to-r from-[#FF2E00] to-[#FF5C00] bg-clip-text text-transparent"> <span class="explore text-white font-normal">Explore</span> Nossos Jogos!</span>
            <p class="mt-2">Divirta-se jogando e descubra o seu novo favorito!</p>
        </section>
        <section class="gap-10 flex flex-wrap justify-center max-w-[1400px]">
            <?php foreach ($jogos as $jogo): ?>
                <a href="<?= htmlspecialchars($jogo['link']) ?>" class="game-card p-5 rounded-lg shadow-lg hover:scale-105 transition transform w-fit">
                    <img src="../imagens/<?php echo htmlspecialchars($jogo['imagem']); ?>" alt="<?= htmlspecialchars($jogo['titulo']); ?>">    
                    <h3 class="text-xl font-semibold"><?= htmlspecialchars($jogo['titulo']) ?></h3>
                    <p><?= htmlspecialchars($jogo['descricao']) ?></p>
                </a>
            <?php endforeach; ?>
        </section>
    </main>
    <footer class="p-5 text-center">
        <p>&copy; 2024 Blondezone. Todos os direitos reservados.</p>
    </footer>
    <script src="../js/script.js"></script>
</body>
</html>
