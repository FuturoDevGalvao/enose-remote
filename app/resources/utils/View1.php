<?php

declare(strict_types=1);

namespace app\resources\utils;

class View1
{
    private static function getContentView(string $nameView): string
    {
        $pathToView = __DIR__ . "/../../views/pages/$nameView.html";
        return file_exists($pathToView) ? file_get_contents($pathToView) : "";
    }

    public static function render(string $nameView, array $dataView): string
    {
        $viewContent = self::getContentView($nameView);

        $keys = array_keys($dataView);

        $keys = array_map(fn ($key) => "{{ " . $key . " }}", $keys);

        return str_replace(
            $keys,
            array_values($dataView),
            $viewContent
        );
    }
}
