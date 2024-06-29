<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

use app\controllers\{LoginController, AuthController, HomeController};
use app\database\entyties\User;
use app\models\LoginModel;

$request = new \app\http\Request;
$showModal = false;

if (isset($request->getPostVars()["email"]) and isset($request->getPostVars()["password"])) {

    $postVars = $request->getPostVars();
    $user = LoginModel::getUser(new User(email: $postVars["email"], password: $postVars["password"]));

    if ($user !== null) {
        LoginController::createNewSessionForUser($user);

        if (!$user->getEmailValidated()) {
            $sent = AuthController::sendEmailValidation($user);
            if ($sent) AuthController::redirect();
        } else {
            HomeController::redirect();
        }
    } else {
        $showModal = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../public/assets/logo.png">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <script rel="preconnect" src="https://kit.fontawesome.com/638bd1bffb.js" crossorigin="anonymous"></script>
    <title>ENOSE REMOTE - LOGIN</title>
</head>


<body>
    <?php if ($showModal) : ?>
        <div class="modal-contain">
            <div class="modal">
                <div class="header-modal">
                    <img src="../public/assets/logo.png" alt="" width="80px">
                </div>
                <div class="body-modal">
                    <h3>
                        Infelizmente não foi possível prosseguir
                    </h3>
                    <p>Por favor, confira as informações cedidas e tente novamente.</p>
                </div>
                <div class="footer-modal">
                    <button>OK</button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <form action="" method="post" id="log-in-form">
        <div class="header-log-in-form">
            <img src="../public/assets/enose.png" alt="logo">
            <!--<span>Don't have am account? <a href="">Sign up</a></span>
 -->
        </div>

        <div class="body-log-in-form">
            <div class="box">
                <input type="email" name="email" id="input-email" placeholder="Informe seu email">
                <label for="">email</label>
            </div>
            <div class="error-message" id="email-error-message">
                <span>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    preencha o campo acima
                </span>
            </div>
            <div class="box">
                <input type="password" name="password" id="input-password" placeholder="Informe sua senha">
                <label for="">senha</label>
                <i class="fa-regular fa-eye" id="btn-show-password"></i>
            </div>
            <div class="error-message" id="password-error-message">
                <span>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    preencha o campo acima
                </span>
            </div>
        </div>
        <div class="footer-log-in-form">
            <button type="s">Log in</button>
        </div>
    </form>

    <script src="../public/js/login.js"></script>
</body>

</html>