<?php

declare(strict_types=1);

namespace app\controllers;

abstract class AbstractController
{
    abstract public static function redirect();

    abstract public static function index(array $data);

    public static function logout(bool $session_destroy)
    {
        if ($session_destroy) {
            // Limpa todas as variáveis da sessão
            $_SESSION = [];

            // Se deseja destruir completamente a sessão, exclua também o cookie de sessão.
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }

            // Finalmente, destrua a sessão
            session_destroy();

            // Redireciona para a página de login ou outra página apropriada
            header("Location: /login");
            exit();
        }
    }
}
