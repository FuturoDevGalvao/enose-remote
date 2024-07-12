<?php

declare(strict_types=1);

namespace app\controllers;

use app\resources\utils\View;

class SensorsController extends AbstractController
{
    public static function redirect()
    {
    }

    public static function index(array $data)
    {
        echo View::render(
            template: "sensors",
            data: $data
        );
    }
}
