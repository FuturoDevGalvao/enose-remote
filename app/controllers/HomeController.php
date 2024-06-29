<?php

declare(strict_types=1);

namespace app\controllers;

use app\resources\utils\View;
use app\models\HomeModel;

class HomeController
{
    public static function redirect()
    {
        $uri = sprintf("/home");
        header("Location: $uri");
        exit;
    }

    public static function getHome(array $userData = null)
    {
        if ($userData !== null) {
            echo View::render("home", [...$userData, ...HomeModel::getData()]);
        } else {
            echo View::render("home", HomeModel::getData());
        }
    }
}
