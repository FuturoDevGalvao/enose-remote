<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use app\controllers\MainController;
use app\database\entyties\User;
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
        UserModel::getPahtToProfileImage($user) ?? sprintf("../public/assets/%s.png", ucfirst(substr($user->getName(), 0, 1)));


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
    <link rel="stylesheet" href="../public/css/dashboard.css" />
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/menu-mobile.css">
    <link rel="stylesheet" href="../public/css/sidebar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <script rel="preconnect" src="https://kit.fontawesome.com/638bd1bffb.js" crossorigin="anonymous"></script>
    <title>ENOSE REMOTE - HOME</title>
</head>

<body>
    <?php include_once "../../resources/components/header.php" ?>

    <?php include_once "../../resources/components/menu-mobile.php" ?>

    <div class="contain">
        <?php include_once "../../resources/components/sidebar.php" ?>

        <main>

        </main>
    </div>

    <script type="module" src="../public/js/index.js"></script>
</body>

</html>