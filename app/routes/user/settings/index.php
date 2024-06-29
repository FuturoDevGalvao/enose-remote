<?php

require_once __DIR__ . "/../../../../vendor/autoload.php";

use app\controllers\MainController;
use app\database\entyties\User;
use app\models\HomeModel;
use app\models\UserModel;

$request = new app\http\Request;

/* "revivendo" a variável de sessão */
if (!isset($_SESSION)) {
    session_start();
}

if (isset($request->getQueryParams()["session_destroy"])) {
    MainController::logout(session_destroy: true);
}

if (isset($_SESSION["user"])) {
    $user = User::fromArray($_SESSION["user"]);

    $pahtToProfileImage =
        UserModel::getPahtToProfileImage($user) ?? sprintf("../../public/assets/%s.png", ucfirst(substr($user->getName(), 0, 1)));

    /*     echo "<pre>";
    echo "/home => line 24: </br>";
    print_r($user);
    echo "</pre>";
 */

    // $sensors = HomeModel::getActiveSensors();
} else {
    die("Você não pode acessar essa página, pois não está logado. Faça o login <a href='/login'>fazer login</a>");
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../public/assets/logo.png">
    <link rel="stylesheet" href="../../public/css/style.css" />
    <link rel="stylesheet" href="../../public/css/settings.css" />
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/menu-mobile.css">
    <link rel="stylesheet" href="../../public/css/sidebar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <script rel="preconnect" src="https://kit.fontawesome.com/638bd1bffb.js" crossorigin="anonymous"></script>
    <title>ENOSE REMOTE - USER SETTINGS</title>
</head>

<body>
    <header>
        <div class="logo-contain">
            <img src="../../public/assets/logo.png" alt="logo">
            <span class="separator">
                /
            </span>
            <span id="user">
                <?= "Olá, {$user->getName()} " ?>
            </span>
        </div>
        <div class="services-contain">
            <div class="notification">
                <a href="/notifications">
                    <i class="fa-solid fa-bell"></i>
                </a>
            </div>
            <div class="about">
                <a href="">
                    <i class="fa-solid fa-circle-info"></i>
                </a>
            </div>
            <div class="user">
                <a href="/user">
                    <img src="<?= $pahtToProfileImage ?>" alt="user">
                </a>
            </div>
        </div>

        <i class="fa-solid fa-bars" id="btn-menu-mobile"></i>
    </header>

    <?php include_once "../../../resources/components/menu-mobile.php" ?>

    <div class="contain">
        <?php include_once "../../../resources/components/sidebar.php" ?>

        <main>
            <form method="post" enctype="multipart/form-data" class="user-info-card card">
                <div class="user-info-card-header">
                    <h2>Informações pessoais</h2>
                </div>
                <div class="table-user-data">
                    <div class="line-blur">
                        <span class="name">avatar:</span>
                        <span class="value">
                            <img src="../../public/assets/M.png" alt="user-image" width="50px">
                            <input type="file" name="profileImage" id="inputProfileImage" readonly>
                        </span>
                    </div>
                    <div class="line">
                        <span class="name">nome:</span>
                        <span class="value">
                            <input type="text" name="name" value="<?= $user->getName() ?>" id="inputName" readonly>
                        </span>
                    </div>
                    <div class="line-blur">
                        <span class="name">e-mail:</span>
                        <span class="value">
                            <input type="email" name="email" value="<?= $user->getEmail() ?>" id="inputEmail" readonly>
                        </span>
                    </div>
                    <div class="line">
                        <span class="name">senha:</span>
                        <span class="value">
                            <input type="password" value="<?= $user->getPassword() ?>" id="inputPassword" readonly>
                        </span>
                    </div>
                </div>
                <div class="user-info-card-footer">
                    <button id="btn-edit-user-settings" type="button">Editar informações</button>
                    <div class="contain-btns-action">
                        <button id="btn-save-edit-user-settings" type="button">Salvar</button>
                        <button id="btn-calcel-edit-user-settings" type="button">Cancelar</button>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <div class="modal-contain">
        <div class="modal">
            <div class="header-modal">
                <img src="../public/assets/logo.png" alt="" width="80px">
            </div>
            <div class="body-modal">
                <h3>
                    Alterar informações pessoais?
                </h3>
                <p>Essa ação atualizará suas informações de usuário.</p>
            </div>
            <div class="footer-modal">
                <button id="btn-confirm-edition">sim, alterar</button>
                <button id="btn-cancel-edition">não, mudei de ideia</button>
            </div>
        </div>
    </div>


    <script type="module" src="../../public/js/index.js"></script>
</body>

</html>