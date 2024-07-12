<?php

declare(strict_types=1);

namespace app\controllers;

use app\resources\utils\View;

class DashboardController extends AbstractController
{
    public static function redirect()
    {
    }

    public static function index(array $data)
    {
        echo View::render(
            template: "dashboard",
            data: $data
        );
    }
}
