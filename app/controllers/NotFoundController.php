<?php

declare(strict_types=1);

namespace app\controllers;

class NotFoundController
{
    public static function redirect()
    {
        $uri = sprintf("/404");
        header("Location: $uri");
        exit;
    }
}
