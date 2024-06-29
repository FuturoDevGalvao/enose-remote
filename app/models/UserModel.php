<?php

declare(strict_types=1);

namespace app\models;

use app\database\Connection;
use app\database\entyties\Sensor;
use app\database\entyties\User;
use \PDO;
use \PDOException;

class UserModel
{
    public static function getPahtToProfileImage(User $user): ?string
    {
        try {
            $instance = Connection::getInstance();

            $SQL = "SELECT path FROM profile_images pi WHERE pi.user_id = :id";

            $state = $instance->prepare($SQL);
            $state->bindValue(":id", $user->getId());
            $state->execute();

            $result = $state->fetch(PDO::FETCH_ASSOC);

            if ($result !== false) return $result["path"];

            return null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            Connection::closeConnection();
        }

        return null;
    }
}
