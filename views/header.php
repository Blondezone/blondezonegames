<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        .btn-cadastrar {
            margin-left: 30px;
        }
    </style>
</head>
<header class="p-5 flex justify-center items-center w-screen">
        <div class="center-header max-w-[1300px] flex justify-between w-[80%]">
            <div class="logo-name flex items-center gap-4">
            <a href="../views/index.php"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256" class="fill-[#FF2E00] w-[50px] h-[50px]"><path d="M176,112H152a8,8,0,0,1,0-16h24a8,8,0,0,1,0,16ZM104,96H96V88a8,8,0,0,0-16,0v8H72a8,8,0,0,0,0,16h8v8a8,8,0,0,0,16,0v-8h8a8,8,0,0,0,0-16ZM241.48,200.65a36,36,0,0,1-54.94,4.81c-.12-.12-.24-.24-.35-.37L146.48,160h-37L69.81,205.09l-.35.37A36.08,36.08,0,0,1,44,216,36,36,0,0,1,8.56,173.75a.68.68,0,0,1,0-.14L24.93,89.52A59.88,59.88,0,0,1,83.89,40H172a60.08,60.08,0,0,1,59,49.25c0,.06,0,.12,0,.18l16.37,84.17a.68.68,0,0,1,0,.14A35.74,35.74,0,0,1,241.48,200.65ZM172,144a44,44,0,0,0,0-88H83.89A43.9,43.9,0,0,0,40.68,92.37l0,.13L24.3,176.59A20,20,0,0,0,58,194.3l41.92-47.59a8,8,0,0,1,6-2.71Zm59.7,32.59-8.74-45A60,60,0,0,1,172,160h-4.2L198,194.31a20.09,20.09,0,0,0,17.46,5.39,20,20,0,0,0,16.23-23.11Z"></path></svg></a> <!-- Espaço para a logo -->
            <a href="../views/index.php"><h1 class="text-3xl select-none"><span class="font-bold bg-gradient-to-r from-[#FF2E00] to-[#FF5C00] bg-clip-text text-transparent">BLONDE</span><span class="zone italic">ZONE</span> </h1></a>
            </div>
        </div>
        <?php 

            if (isset($_SESSION["id"])) {
                $id_usuario = $_SESSION["id"];
                $nome = isset($_SESSION["adm"]) ? htmlspecialchars($_SESSION["adm"]) : "Usuário";

                echo "<a href='../models/logout.php'>Bem-vindo, $nome</a>";
            } else {
                echo "<a href='../views/loginAdm.php'>Login</a>";
                echo "<a href='../views/cadastro.php' class='btn-cadastrar'>Cadastrar-se</a>";
            }

        ?>
    </header>

    <script src="../js/script.js"></script>

</html>
