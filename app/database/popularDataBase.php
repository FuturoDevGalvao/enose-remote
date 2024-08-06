<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use app\database\Connection;
use app\database\entyties\User;
use app\database\entyties\Sensor;

/* Lógica para popular corretamente o banco de dados */

/**
 * 
 * @param int $size tamanho em bits para o token a ser gerado, para 16 bits => 32 characteres
 * @return string retorna o token gerado
 */
function generateToken(int $size): string
{
    return bin2hex(random_bytes($size));
}

$instance = Connection::getInstance();

$users = [];
$sensors = [];

$users[] = new User(
    email: "tete@gmail.com",
    password: "12345678",
    name: "Matheus",
    validationToken: generateToken(16)
);

$users[] = new User(
    email: "pepe@gmail.com",
    password: "123456",
    name: "Pedro",
    validationToken: generateToken(16)
);

$sensors[] = new Sensor(name: "MQ5");

$sensors[] = new Sensor(name: "MQ5");

foreach ($users as $indice => $user) {
    $state = $instance->prepare(
        "INSERT INTO users (email, password_hash, name, email_validated, validation_token) VALUES (:e, :ph, :n, :ev, :vt)"
    );

    $state->bindValue(":e", $user->getEmail());
    $state->bindValue(":ph", $user->getPassword());
    $state->bindValue(":n", $user->getName());
    $state->bindValue(":ev", $user->getEmailValidated());
    $state->bindValue(":vt", $user->getValidationToken());

    $state->execute();

    echo $state ? "NEW USER INSERIDO COM SUCESSO" : "ERRO AO INSERIR NEW USE" . PHP_EOL;
}


foreach ($sensors as $key => $value) {
    $state = $instance->prepare(
        "INSERT INTO sensors (name) VALUES (:n)"
    );

    $state->bindValue(":n", $value->getName());

    $state->execute();

    echo $state ? "NEW SENSOR INSERIDO COM SUCESSO" : "ERRO AO INSERIR NEW SENSOR" . PHP_EOL;
}
