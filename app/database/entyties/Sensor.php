<?php

declare(strict_types=1);

namespace app\database\entyties;

class Sensor
{
    public function __construct(
        private int $id = 0,
        private string $name
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
