<?php
namespace Botfire\Models;


class Photo {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function fileId() {
        return $this->data['file_id'] ?? null;
    }
}