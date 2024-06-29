<?php

declare(strict_types=1);

namespace app\database\entyties;

class User
{
    private int $id;
    private bool $emailValidated;
    private string
        $name,
        $email,
        $password,
        $validationToken,
        $pathToProfileImage;

    public function __construct(
        string $email,
        string $password,
        string $name = "",
        int $id = 0,
        bool $emailValidated = false,
        string $validationToken = "",
        string $pathToProfileImage = ""
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->emailValidated = $emailValidated;
        $this->validationToken = $validationToken;
        $this->pathToProfileImage = $pathToProfileImage;
    }

    public function getProperties(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "emailValidated" => $this->emailValidated,
            "validationToken" => $this->validationToken,
        ];
    }

    public static function fromArray(array $array): User
    {
        return new User(
            email: $array["email"],
            password: $array["password"],
            name: $array["name"],
            id: (int) $array["id"],
            emailValidated: (bool) $array["emailValidated"],
            validationToken: $array["validationToken"],
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getEmailValidated(): int
    {
        return $this->emailValidated ? 1 : 0;
    }

    public function getValidationToken(): string
    {
        return $this->validationToken;
    }

    public function getPathToProfileImage(): string
    {
        return $this->pathToProfileImage;
    }
}
