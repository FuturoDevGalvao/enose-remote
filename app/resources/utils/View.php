<?php

declare(strict_types=1);

namespace app\resources\utils;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
    public static function render(string $template, $data): string
    {
        $loader = new FilesystemLoader(__DIR__ . "/../../view/templates");
        $twig = new Environment($loader);

        return $twig->render($template . ".html.twig", $data);
    }
}
