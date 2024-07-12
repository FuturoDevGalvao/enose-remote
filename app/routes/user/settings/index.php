<?php

require_once __DIR__ . "/../../../../vendor/autoload.php";

use app\controllers\SettingsController;
use app\controllers\UserController;
use app\database\entyties\User;

$request = new app\http\Request;

/* "revivendo" a variável de sessão */
if (!isset($_SESSION)) {
    session_start();
}

if (isset($request->getQueryParams()["session_destroy"])) {
    SettingsController::logout(session_destroy: true);
}

if (isset($_SESSION["user"])) {

    $user = User::fromArray($_SESSION["user"]);
    $pathToProfileImage = UserController::getPahtToProfileImage($user) ?? sprintf("../../public/assets/%s.png", ucfirst(substr($user->getName(), 0, 1)));

    SettingsController::index([
        "title" => "SETTINGS",
        "userName" => $user->getName(),
        "userEmail" => $user->getEmail(),
        "pathToProfileImage" => $pathToProfileImage,
        "userPassword" => $user->getPassword(),
    ]);
} else {
    die("Você não pode acessar essa página, pois não está logado. Faça o login <a href='/login'>fazer login</a>");
}
