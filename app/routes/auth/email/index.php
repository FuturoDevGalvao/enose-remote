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
    $queryParams = $request->getQueryParams();

    if (isset($queryParams["email"]) and isset($queryParams["token"])) {
        AuthController::validateEmail($queryParams, $user);
    }

    AuthController::index([
        "title" => "EMAIL VERIFY",
        "userEmail" => $user->getEmail()
    ]);
} else {
    die("Você não pode acessar essa página, pois não está logado. Faça o login <a href='/login'>fazer login</a>");
}
