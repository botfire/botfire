<?php
namespace Botfire\Models;

class User {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function id() {
        return $this->data['id'] ?? null;
    }

    public function isBot() {
        return $this->data['is_bot'] ?? false;
    }

    public function username() {
        return $this->data['username'] ?? null;
    }
}