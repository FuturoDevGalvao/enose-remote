<?php

require_once __DIR__ . "/../../../../vendor/autoload.php";

use app\controllers\AuthController;
use app\database\entyties\User;

$request = new app\http\Request;

/* "revivendo" a variável de sessão */

if (!isset($_SESSION)) {
    session_start();
};

if (isset($_SESSION["user"])) {
    $user = User::fromArray($_SESSION["user"]);
} else {
    die("Você não pode acessar essa página, pois não está logado. Faça o login <a href='/login'>fazer login</a>");
}

if (isset($_SESSION["user"]) and (isset($request->getQueryParams()["email"]) and isset($request->getQueryParams()["token"]))) {
    AuthController::validateEmail($request->getQueryParams(), $user);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../public/assets/logo.png">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <script rel="preconnect" src="https://kit.fontawesome.com/638bd1bffb.js" crossorigin="anonymous"></script>
    <title>ENOSE REMOTE - EMAIL VERIFY</title>
</head>

<body>
    <!--     <div class="left">
                <img src="../../../public/assets/enose.png" alt="">
    </div>
 -->
    <div class="right">
        <h1>Validação de E-mail</h1>
        <p>Para prosseguirmos, precisamos antes validar o seu e-mail. Por favor, clique no link que enviamos para <span><?= $user->getEmail() ?></span> e confirme seu e-mail.</p>
        <p>siga as etapas a seguir:</p>
        <div class="tutor">
            <div class="stage">
                <span class="stage-number">1</span>
                <p>
                    Certifique-se de estar logado na conta de e-mail espeficifada. No seu caso, o endereço de e-mail é <span><?= $user->getEmail() ?></span>.
                </p>
            </div>
            <div class="stage">
                <span class="stage-number">2</span>
                <p>
                    Acesse sua caixa de email, procure pelo email enviado por <span>ENOSE REMOTE</span> e clique no link de confirmação para prosseguir.
                </p>
            </div>
            <div class="stage">
                <span class="stage-number">3</span>
                <p>
                    Caso o e-mail não esteja na sua caixa de e-mail, confira na caixa de spam e siga o mesmo processo da etapa 2.
                </p>
            </div>
        </div>
        <p style="text-align: center; font-size: max(.7rem, 1vw);">
            <i class="fa-solid fa-lock"></i>
            Esta é uma medida para termos certeza que ninguém está utilizando seu enderço de e-mail sem o seu conhecimento.
            <i class="fa-solid fa-lock"></i>
        </p>
    </div>
</body>

</html>