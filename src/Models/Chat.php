<?php
namespace Botfire\Models;

class Chat {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function id() {
        return $this->data['id'] ?? null;
    }

    public function type() {
        return $this->data['type'] ?? null;
    }

    public function asArray() {
        return $this->data;
    }

}