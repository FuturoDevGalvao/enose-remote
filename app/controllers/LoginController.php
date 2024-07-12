<?php

declare(strict_types=1);

namespace app\controllers;

use app\database\entyties\User;
use app\resources\utils\View;
use app\models\LoginModel;

class LoginController extends AbstractController
{
    public static function redirect()
    {
        $uri = sprintf("/login");
        header("Location: $uri");
        exit;
    }

    public static function index(array $data)
    {
        echo View::render(
            template: "login",
            data: $data
        );
    }

    public static function login()
    {
        $request = new \app\http\Request;
        $showModal = false;

        if (isset($request->getPostVars()["email"]) and isset($request->getPostVars()["password"])) {

            $postVars = $request->getPostVars();
            $user = LoginController::validateUser(new User(email: $postVars["email"], password: $postVars["password"]));

            if ($user !== false) {
                LoginController::createNewSessionForUser($user);

                if (!$user->getEmailValidated()) {
                    $sent = AuthController::sendEmailValidation($user);
                    if ($sent) AuthController::redirect();
                } else {
                    HomeController::redirect();
                }
            } else {
                return $showModal = true;
            }
        }

        return $showModal;
    }

    public static function validateUser(User $user): User | bool
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
