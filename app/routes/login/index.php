<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use app\controllers\LoginController;

$request = new app\http\Request;
$showModal = false;

if ($request->getMethod() === "post") {
    $showModal = LoginController::login();
}

LoginController::index(
    data: [
        "title" => "LOGIN",
        "showModal" => $showModal
    ]
);
