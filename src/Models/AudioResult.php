<?php
namespace Botfire\Models;
use Botfire\Models\File;

class AudioResult extends File{
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function getDuration() {
        return $this->data['duration'] ?? null;
    }

    public function getMimeType() {
        return $this->data['mime_type'] ?? null;
    }

    public function getFileSize() {
        return $this->data['file_size'] ?? null;
    }


    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
}