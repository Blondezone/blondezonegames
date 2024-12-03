<?php
require_once "../views/header.php";
require_once "../models/conexao.php";
require_once "../models/jogos.class.php";
require_once "../models/jogosDAO.php";

$erro = false;
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
            id_adm: $_SESSION['id'],  // Usando o ID do administrador da sessão
        );

        $jogosDAO = new jogosDAO();
        $jogosDAO->cadastrar($jogos); 
        
        //var_dump($jogos);
    }
}

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

        .modal {
            display: none; 
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4); 
        }

        .modal-conteudo {
            background-color: #111;
            margin: 10% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 50%; 
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .fechar {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .fechar:hover,
        .fechar:focus {
            color: #000;
            text-decoration: none;
        }

        .btn-cadastro {
            background-color: #FF4E00;
            padding: 10px 20px;
            border-radius: 10px;
        }

        input {
            color: #111;
        }

    </style>
    <link rel="shortcut icon" href="imagens/game-controller.svg" type="image/x-icon">
</head>
<body class="dark-mode flex flex-col items-center">
    <main class="p-5 space-y-8 flex flex-col items-center">
        <section class="text-center">
            <span class="text-4xl font-extrabold bg-gradient-to-r from-[#FF2E00] to-[#FF5C00] bg-clip-text text-transparent"> <span class="explore text-white font-normal">Cadastre seus</span> Jogos!</span>
            <p class="mt-2">Clique no botão abaixo e cadastre seus melhores jogos no nosso site!</p>
        </section>
    </main>

    <button class="btn-cadastro" id="abrirModalBtn">Cadastrar jogo</button>

    <section class="gap-10 flex flex-wrap justify-center max-w-[1400px]">
        <?php foreach ($jogos as $jogo): ?>
            <a href="<?= htmlspecialchars($jogo['link']) ?>" class="game-card p-5 rounded-lg shadow-lg hover:scale-105 transition transform w-fit">
                <img src="../imagens/<?php echo htmlspecialchars($jogo['imagem']); ?>" alt="<?= htmlspecialchars($jogo['titulo']); ?>">    
                <h3 class="text-xl font-semibold"><?= htmlspecialchars($jogo['titulo']) ?></h3>
                <p><?= htmlspecialchars($jogo['descricao']) ?></p>
            </a>
        <?php endforeach; ?>
    </section>


        <div id="modal" class="modal">
            <div class="modal-conteudo">
                <span class="fechar" id="fecharModalBtn">&times;</span>
                <h2>Cadastro de Jogo</h2>
                <form action="cadastroGame.php" method="POST" enctype="multipart/form-data">
                    <label for="text" id="label">Título:</label>
                    <input type="text" name="titulo" placeholder="Nome do jogo" ><br>

                    <label for="text" id="label">Link:</label>
                    <input type="text" name="link" placeholder="Link para o jogo" ><br>

                    <label for="text" id="label">Descrição:</label>
                    <input type="text" name="descricao" placeholder="Breve descrição do jogo"><br>

                    <label for="imagem" id="label">Imagem:</label>
                    <input type="file" name="imagem" id="imagem"><br>

                    <input type="hidden" name="id_adm" value="<?php echo $_SESSION['id']; ?>">

                    <button class="btn-cadastro" type="submit">Confirmar cadastro</button>
                </form>
            </div>
        </div>

    <footer class="p-5 text-center">
        <p>&copy; 2024 Blondezone. Todos os direitos reservados.</p>
    </footer>
    <script src="script.js"></script>

    <script>
        const modal = document.getElementById('modal');
        const abrirModalBtn = document.getElementById('abrirModalBtn'); 
        const fecharModalBtn = document.getElementById('fecharModalBtn');

        function abrirModal() {
            modal.style.display = 'block';
        }

        function fecharModal() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                fecharModal();
            }
        };

        // Adiciona os eventos
        if (abrirModalBtn) abrirModalBtn.addEventListener('click', abrirModal);
        if (fecharModalBtn) fecharModalBtn.addEventListener('click', fecharModal);
    </script>
</body>
</html>
