<?php
namespace Botfire;

use Botfire\Models\From;

class Callback {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }
    
    public function id() {
        return $this->data['id'] ?? null;
    }

    public function from(){
        return new From($this->data['from'] ?? []);
    }

    public function chatInstance(){
        return $this->data['chat_instance'] ?? '';
    }

    public function data(){
        return $this->data['data'] ?? '';
    }

}