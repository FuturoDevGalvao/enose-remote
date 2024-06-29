<?php

declare(strict_types=1);

namespace app\controllers;

class UserController
{
    public static function redirect()
    {
        $uri = sprintf("/user");
        header("Location: $uri");
        exit;
    }
}
