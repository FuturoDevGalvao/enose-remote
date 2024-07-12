<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use app\controllers\DashboardController;
use app\controllers\UserController;
use app\database\entyties\User;

$request = new app\http\Request;

/* "revivendo" a variável de sessão */
if (!isset($_SESSION)) {
    session_start();
}

if (isset($request->getQueryParams()["session_destroy"])) {
    DashboardController::logout(session_destroy: true);
}

if (isset($_SESSION["user"])) {

    $user = User::fromArray($_SESSION["user"]);
    $pathToProfileImage = UserController::getPahtToProfileImage($user) ?? sprintf("../public/assets/%s.png", ucfirst(substr($user->getName(), 0, 1)));

    DashboardController::index([
        "title" => "DASHBOARD",
        "userName" => $user->getName(),
        "pathToProfileImage" => $pathToProfileImage
    ]);
} else {
    die("Você não pode acessar essa página, pois não está logado. Faça o login <a href='/login'>fazer login</a>");
}
