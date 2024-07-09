<?php

declare(strict_types=1);

namespace app\controllers;

use app\database\entyties\User;
use app\models\UserModel;

class UserController
{
    public static function redirect()
    {
        $uri = sprintf("/user");
        header("Location: $uri");
        exit;
    }

    public static function getPahtToProfileImage(User $user): ?string
    {
        return UserModel::getPahtToProfileImageUser($user);
    }
}
