<?php

namespace Botfire\Responses;


class Chat
{
    private int $id;
    private string $firstName;
    private string $username;
    private string $type;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->firstName = $data['first_name'];
        $this->username = $data['username'];
        $this->type = $data['type'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getType(): string
    {
        return $this->type;
    }
}

