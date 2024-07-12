<?php

declare(strict_types=1);

namespace app\controllers;

use app\database\entyties\User;
use app\models\UserModel;
use app\resources\utils\View;

class UserController extends AbstractController
{
    public static function redirect()
    {
        $uri = sprintf("/user");
        header("Location: $uri");
        exit;
    }

    public static function index(array $data)
    {
        echo View::render(
            template: "user",
            data: $data
        );
    }

    public static function getPahtToProfileImage(User $user): ?string
    {
        return UserModel::getPahtToProfileImageUser($user);
    }
}
