<?php
namespace Botfire\Models;
use Botfire\Models\File;

class Photo extends File{
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }


    public function getWidth(){
        return $this->data['width'] ?? null;
    }

    public function getHeight(){
        return $this->data['height'] ?? null;
    }


}