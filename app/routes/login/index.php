<?php

use app\controllers\LoginController;

require_once __DIR__ . "/../../../vendor/autoload.php";

$request = new app\http\Request;
$logged = false;

if ($request->getMethod() === "post") {
    $logged = LoginController::login();
}

LoginController::getView(showModal: $logged);
