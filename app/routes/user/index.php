<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use app\controllers\MainController;
use app\controllers\UserController;
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
        UserController::getPahtToProfileImage($user) ?? sprintf("../public/assets/%s.png", ucfirst(substr($user->getName(), 0, 1)));

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
    <link rel="icon" href="../public/assets/logo.png">
    <link rel="stylesheet" href="../public/css/style.css" />
    <link rel="stylesheet" href="../public/css/user.css" />
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/menu-mobile.css">
    <link rel="stylesheet" href="../public/css/sidebar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <script rel="preconnect" src="https://kit.fontawesome.com/638bd1bffb.js" crossorigin="anonymous"></script>
    <title>ENOSE REMOTE - USER</title>
</head>

<body>
    <?php include_once "../../resources/components/header.php" ?>

    <?php include_once "../../resources/components/menu-mobile.php" ?>

    <div class="contain">
        <?php include_once "../../resources/components/sidebar.php" ?>

        <main>
            <div class="user-card card">
                <div class="about">
                    <span id="name"><?= $user->getName() ?></span>
                    <span><?= $user->getEmail() ?></span>
                    <span>Entrou na ENOSE REMOTE em 11 de abril de 2023 (um ano atrás).</span>
                </div>
                <div class="profile-image">
                    <img src="<?= $pahtToProfileImage ?>" alt="user">
                </div>
            </div>

            <div class="user-info-card card">
                <div class="user-info-card-header">
                    <h2>Informações pessoais</h2>
                </div>
                <div class="table-user-data">
                    <div class="line">
                        <span class="name">nome:</span>
                        <span class="value"><?= $user->getName() ?></span>
                    </div>
                    <div class="line-blur">
                        <span class="name">e-mail:</span>
                        <span class="value"><?= $user->getEmail() ?></span>
                    </div>
                    <div class="line">
                        <span class="name">senha:</span>
                        <span class="value">
                            <input type="password" value="<?= $user->getPassword() ?>" readonly>
                        </span>
                    </div>
                    <div class="line-blur">
                        <span class="name">status do e-mail:</span>
                        <span class="value"><?= $user->getEmailValidated() ? "validado" : "não validado" ?></span>
                    </div>
                </div>
                <div class="user-info-card-footer">
                    <a href="/user/settings" id="btn-edit-user-settings">Atualizar perfil</a>
                </div>
            </div>

            <div class="delete-user-card card">
                <div class="delete-user-card-header">
                    <h2>Deletar usuário</h2>
                </div>
                <div class="delete-user-card-body">
                    Depois de excluir seu usuário, não há como voltar atrás. Por favor, tenha certeza.
                    <a href="?deleteUser=true" id="btn-delete-user">Deletar usuário</a>
                </div>
            </div>
        </main>
    </div>

    <script type="module" src="../public/js/index.js"></script>
</body>

</html>