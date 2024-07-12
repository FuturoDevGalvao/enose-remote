<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use app\controllers\HomeController;
use app\controllers\UserController;
use app\database\entyties\User;

$request = new app\http\Request;

/* "revivendo" a variável de sessão */
if (!isset($_SESSION)) {
    session_start();
}

if (isset($request->getQueryParams()["session_destroy"])) {
    UserController::logout(session_destroy: true);
}

if (isset($_SESSION["user"])) {

    $user = User::fromArray($_SESSION["user"]);
    $pathToProfileImage = UserController::getPahtToProfileImage($user) ?? sprintf("../public/assets/%s.png", ucfirst(substr($user->getName(), 0, 1)));

    HomeController::index([
        "title" => "HOME",
        "userName" => $user->getName(),
        "pathToProfileImage" => $pathToProfileImage
    ]);
} else {
    die("Você não pode acessar essa página, pois não está logado. Faça o login <a href='/login'>fazer login</a>");
}
