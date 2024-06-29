<?php

declare(strict_types=1);

namespace app\models;

use app\database\Connection;
use app\database\entyties\User;
use \PDO;
use \PDOException;

class AuthModel
{
    public static function validateUserEmail(User $user)
    {
        try {
            $instance = Connection::getInstance();

            $SQL = "UPDATE users SET email_validated = 1 WHERE id = :id";
            $state = $instance->prepare($SQL);
            $state->bindValue(":id", $user->getId(), PDO::PARAM_INT);

            return $state->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            Connection::closeConnection();
        }

        return false;
    }

    public static function findByTokenAndEmail(string $email, string $token): ?User
    {
        try {
            $instance = Connection::getInstance();

            $SQL = "SELECT * FROM users u WHERE u.email = :e AND u.validation_token = :vt";
            $state = $instance->prepare($SQL);
            $state->bindValue(":e", $email);
            $state->bindValue(":vt", $token);
            $state->execute();

            $result = $state->fetch(PDO::FETCH_ASSOC);

            if ($result !== false) {
                return new User(
                    email: $result["email"],
                    password: $result["password_hash"],
                    name: $result["name"],
                    id: $result["id"],
                    emailValidated: (bool) $result["email_validated"],
                    validationToken: $result["validation_token"]
                );
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro" . $e->getMessage();
        }

        return null;
    }
}
