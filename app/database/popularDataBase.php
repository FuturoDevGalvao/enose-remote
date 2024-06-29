<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use app\database\Connection;
use app\database\entyties\User;

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

    echo $state ? "INSERIDO COM SUCESSO" : "ERRO AO INSERIR" . PHP_EOL;
}
