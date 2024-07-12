<?php

declare(strict_types=1);

namespace app\controllers;

use app\database\entyties\User;
use app\models\AuthModel;
use app\resources\utils\Email;
use app\resources\utils\View;

class AuthController extends AbstractController
{
    public static function redirect()
    {
        $uri = sprintf("/auth/email");
        header("Location: $uri");
        exit;
    }

    public static function index($data)
    {
        echo View::render("auth", $data);
    }

    public static function sendEmailValidation(User $user): bool
    {
        $validationLink = sprintf("http://127.0.0.1:8080/auth/email/?email=%s&token=%s", $user->getEmail(), $user->getValidationToken());

        $userData = [
            "userName" => $user->getName(),
            "userEmail" => $user->getEmail(),
            "validationLink" => $validationLink
        ];

        $body = View::render("body-email", $userData);
        $altBody = View::render("alt-body-email", $userData);

        $email = new Email;

        return $email->senEmail(
            address: "joe@example.com",
            subject: "ENOSE REMOTE - VALIDAÇÃO DE E-MAIL",
            body: $body,
            altBody: $altBody,
            user: $user
        );
    }

    public static function validateEmail(array $queryParams, User $user)
    {
        $token = $queryParams['token'];
        $userEmail = $queryParams['email'];

        $user = AuthModel::findByTokenAndEmail($userEmail, $token);

        if ($user) {
            AuthModel::validateUserEmail($user); // Função para atualizar o status de validação no banco de dados
            HomeController::redirect();
        } else {
            echo "Token de validação inválido.";
        }
    }
}
