<?php

declare(strict_types=1);

namespace app\database;

use \PDO;
use Dotenv\Dotenv;

class Connection
{
    private static ?PDO $instance = null;
    private static string
        $dbName,
        $host,
        $user,
        $pass;

    public static function getInstance(): ?PDO
    {
        if (self::$instance === null) {
            Dotenv::createImmutable(__DIR__ . "/../../")->load();

            self::$host = $_ENV["MARIADB_HOST"];
            self::$dbName = $_ENV["DB_NAME"];

            self::$user = $_ENV["MARIADB_USER"];
            self::$pass = $_ENV["MARIADB_PASS"];

            $dsn = sprintf("mysql:dbname=%s;host=%s", self::$dbName, self::$host);
            self::$instance = new PDO($dsn, self::$user, self::$pass);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return self::$instance;
        }

        return self::$instance;
    }

    public static function closeConnection(): void
    {
        self::$instance = null;
    }
}
