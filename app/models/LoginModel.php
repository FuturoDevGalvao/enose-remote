<?php

declare(strict_types=1);

namespace app\models;

use app\database\Connection;
use app\database\entyties\User;
use \PDO;
use \PDOException;

class LoginModel
{
    public static function getUser(User $user): ?User
    {
        try {
            $instance = Connection::getInstance();

            $SQL = "SELECT * FROM users u WHERE u.email = :e AND u.password_hash = :p";

            $state = $instance->prepare($SQL);
            $state->bindValue(":e", $user->getEmail());
            $state->bindValue(":p", $user->getPassword());
            $state->execute();

            $result = $state->fetch(PDO::FETCH_ASSOC);

            if ($result !== false) {
                return new User(
                    email: $result["email"],
                    password: $result["password_hash"],
                    name: $result["name"],
                    id: $result["id"],
                    emailValidated: (bool) $result["email_validated"],
                    validationToken: $result["validation_token"],
                );
            }

            return null;
        } catch (PDOException $e) {
            echo "Error: " .  $e->getMessage();
        } finally {
            Connection::closeConnection();
        }

        return null;
    }
}
