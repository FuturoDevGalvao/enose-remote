<?php

declare(strict_types=1);

namespace app\controllers;

use app\resources\utils\View;
use app\models\HomeModel;

class HomeController extends AbstractController
{
    public static function redirect()
    {
        $uri = sprintf("/home");
        header("Location: $uri");
        exit;
    }

    public static function index(array $data = [])
    {
        echo View::render(
            template: "home",
            data: $data
        );
    }
}
