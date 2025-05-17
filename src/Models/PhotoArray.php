<?php
namespace Botfire\Models;

use Botfire\Models\Photo;

class PhotoArray {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function first() {
        return new Photo($this->data[0] ?? []);
    }

    public function latest() {
        return new Photo(end($this->data) ?: []);
    }

    public function indexOf($index) {
        return new Photo($this->data[$index] ?? []);
    }

    public function count() {
        return count($this->data);
    }

    public function asArray() {
        return $this->data;
    }
}