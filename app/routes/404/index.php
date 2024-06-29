<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use app\controllers\NotFoundController;

$goToHome = false;

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $goToHome = true;
} else {
    /*     die("Você não pode acessar essa página, pois não está logado. Faça o login <a href='/login'>fazer login</a>");
 */
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../public/assets/logo.png">
    <link rel="stylesheet" href="../public/css/style.css" />
    <link rel="stylesheet" href="../public/css/404.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <script rel="preconnect" src="https://kit.fontawesome.com/638bd1bffb.js" crossorigin="anonymous"></script>
    <title>ENOSE REMOTE - 404</title>
</head>

<body>
    <div class="contain">
        <main>
            <div class="animation">
                <img src="../public/assets/404.svg" alt="" width=400>
            </div>
            <div class="error-msg">
                <h1>Ops! página não encontrada</h1>
                <p>
                    A página que você está tentando acessar não existe ou foi movida.
                    Tente voltar para nossa página inicial.
                </p>
                <?php if ($goToHome) : ?>
                    <a href="/home">ir para a página inicial</a>
                <?php else : ?>
                    <a href="/login">ir para a página de login</a>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script type="module" src="../public/js/index.js"></script>
</body>



</html>