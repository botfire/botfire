<?php

namespace Botfire\Responses;

class From
{
    private int $id;
    private bool $isBot;
    private string $firstName;
    private string $username;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->isBot = $data['is_bot'];
        $this->firstName = $data['first_name'];
        $this->username = $data['username'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isBot(): bool
    {
        return $this->isBot;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}

