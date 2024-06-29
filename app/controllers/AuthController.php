<?php

declare(strict_types=1);

namespace app\controllers;

use app\database\entyties\User;
use app\models\AuthModel;
use app\resources\utils\Email;

class AuthController
{
    public static function redirect()
    {
        $uri = sprintf("/auth/email");
        header("Location: $uri");
        exit;
    }

    public static function sendEmailValidation(User $user): bool
    {
        $validationLink = sprintf("http://127.0.0.1:8080/auth/validation/email/?email=%s&token=%s", $user->getEmail(), $user->getValidationToken());

        $body = "
            <!DOCTYPE html>
            <html lang='pt-br'>
                <head>
                    <meta charset='UTF-8' />
                    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                    <style>
                    * {
                        padding: 0;
                        margin: 0;
                        box-sizing: border-box;
                    }

                    body {
                        display: flex;
                        padding: 40px 0px;
                        align-items: center;
                        justify-content: center;
                        font-family: Arial, Helvetica, sans-serif;
                        background-color: #060b10;
                    }

                    .contain {
                        width: 600px;
                        flex-direction: column;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background-color: #12181f;
                        border-radius: 8px;
                    }

                    .header-contain {
                        width: 100%;
                        display: flex;
                        padding: 20px 10px;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        gap: 20px;
                        border-bottom: 1px solid #272f38;
                    }

                    .header-contain img {
                        border-radius: 5px;
                    }

                    .header-contain h1 {
                        font-size: max(2rem, 2vw);
                        color: #f0f8ff;
                    }

                    .body-contain {
                        padding: 40px;
                        display: flex;
                        flex-direction: column;
                        gap: 30px;
                        text-align: justify;
                    }

                    .body-contain h1 {
                        font-size: max(1.3rem, 1.5vw);
                        font-weight: 700;
                        color: #f0f8ff;
                    }

                    p {
                        color: #abb5bf;
                    }

                    a {
                        text-decoration: none;
                        color: #2e51ed;
                    }

                    #btn-validate-email {
                        width: 200px;
                        text-align: center;
                        padding: 15px 10px;
                        color: #f0f8ff;
                        border-radius: 5px;
                        font-weight: 700;
                        background-color: #2e51ed;
                        transition: 0.3s;
                    }

                    #btn-validate-email:hover {
                        background-color: #0056b3;
                        transition: 0.3s;
                    }
                    </style>
                </head>
                <body>
                    <div class='contain'>
                    <div class='header-contain'>
                        <img src='http://127.0.0.1:8080/public/assets/logo.png' alt='logo' width='100' />
                        <h1>Olá, {$user->getName()} 👋</h1>
                    </div>
                    <div class='body-contain'>
                        <h1>Confirme seu endereço de e-mail para começar a usar o ENOSE REMOTE</h1>
                        <p>
                        Depois de confirmar que <a href=''>{$user->getEmail()}</a> é seu endereço de e-mail, redirecionaremos você para a
                        página inicial do sistema. Confirme seu e-mail clicando no link abaixo:
                        </p>
                        <a href='{$validationLink}' id='btn-validate-email'>confirmar meu e-mail</a>
                        <p>Se você não solicitou esta ação, por favor ignore este e-mail.</p>
                    </div>
                    </div>
                </body>
            </html>";

        $altBody = "
            Olá, {$user->getName()} 👋\n\nConfirme seu endereço de e-mail para começar a usar o ENOSE REMOTE\n\n
            Depois de confirmar que {$user->getEmail()} é seu endereço de e-mail, redirecionaremos você para a página inicial do sistema. Confirme seu e-mail clicando no link abaixo:
            \n\nconfirme seu e-mail: {$validationLink}'
            \n\nSe você não solicitou esta ação, por favor ignore este e-mail.";

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
