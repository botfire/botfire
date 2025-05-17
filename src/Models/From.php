<?php
namespace Botfire\Models;


class From
{

    private $data = null;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function id(): int
    {
        return $this->data['id'] ?? 0;
    }

    public function isBot(): bool
    {
        return $this->data['is_bot'] ?? false;
    }

    public function firstName(): string
    {
        return $this->data['first_name'] ?? '';
    }
    public function lastName(): string
    {
        return $this->data['last_name'] ?? '';
    }

    public function username(): string
    {
        return $this->data['username'] ?? '';
    }

    public function asArray(): array
    {
        return $this->data;
    }

}
