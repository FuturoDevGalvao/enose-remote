<?php

declare(strict_types=1);

namespace app\core;

use app\controllers\NotFoundController;
use InvalidArgumentException;
use app\http\Request;
use \Exception;

class Router
{
    const CONTROLLER_NAMESPACE = "app\\controllers\\";

    private static function load(string $controller, string $method)
    {
        $controllerClass = Router::CONTROLLER_NAMESPACE . $controller;

        if (!class_exists($controllerClass)) {
            throw new InvalidArgumentException("O controller $controller não existe.");
        }

        $controllerInstance = new $controllerClass;

        if (!method_exists($controllerInstance, $method)) {
            throw new InvalidArgumentException("O método $method não existe no controller $controller.");
        }

        $controllerInstance->$method();
    }

    public static function routes()
    {
        return [
            "get" => [
                "/" => fn () => self::load("LoginController", "redirect"),
                "/home" => fn () => self::load("HomeController", "redirect"),
                "/sensors" => fn () => self::load("SensorsController", "redirect"),
                "/login" => fn () => self::load("LoginController", "redirect"),
                "/user" => fn () => self::load("UserController", "redirect")
            ],
            "post" => [
                "/login" => fn () => self::load("LoginController", "redirect")
            ]
        ];
    }

    public static function execute()
    {
        $request = new Request;
        $routes = self::routes();
        $method = $request->getMethod();
        $uri = $request->getURI("path");

        if (!isset($routes[$method])) {
            NotFoundController::redirect();
            throw new Exception("A rota não existe");
        }

        if (!array_key_exists($uri, $routes[$method])) {
            NotFoundController::redirect();
            throw new Exception("A rota não existe");
        }

        $routes[$method][$uri]();
    }
}
