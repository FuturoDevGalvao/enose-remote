<?php

declare(strict_types=1);

namespace app\models;

use app\database\Connection;
use app\database\entyties\Sensor;
use \PDO;
use \PDOException;

class HomeModel
{
    public static function getActiveSensors(): ?array
    {
        try {
            $instance = Connection::getInstance();

            $SQL = "SELECT id, name FROM sensors";

            $state = $instance->prepare($SQL);
            $state->execute();

            $sensors = [];
            while ($row = $state->fetch(PDO::FETCH_ASSOC)) {
                $sensors[] = new Sensor(
                    $row["id"],
                    $row["name"]
                );
            }

            return $sensors;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            Connection::closeConnection();
        }

        return null;
    }

    public static function getData()
    {
        return [
            "title" => "Projeto Atlas",
            "nameOfProject" => "ATLAS",
            "author" => "Gabriel Galvão"
        ];
    }
}
