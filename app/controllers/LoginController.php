<?php

declare(strict_types=1);

namespace app\controllers;

use app\database\entyties\User;
use app\resources\utils\View;
use app\models\LoginModel;

class LoginController
{
    public static function redirect()
    {
        $uri = sprintf("/login");
        header("Location: $uri");
        exit;
    }

    public static function getLogin()
    {
        echo View::render("login", []);
    }

    public static function redirectToHome(User $user)
    {
        $uri = sprintf("/home");
        header("Location: $uri");
        exit;
    }

    public static function validateUser(User $user): User |bool
    {
        return LoginModel::getUser($user) ?? false;
    }

    public static function createNewSessionForUser(User $user)
    {
        if (!isset($_SESSION)) {
            session_start();
            $userData = [];
            foreach ($user->getProperties() as $property => $value) $userData[$property] = $value;
            $_SESSION["user"] = $userData;
        }
    }
}
