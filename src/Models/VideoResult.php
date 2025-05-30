<?php
namespace Botfire\Models;
use Botfire\Models\File;

class Video extends File{
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

    public function getThumbnail():Thumbnail|null{
        if(!isset($this->data['thumbnail'])) {
            return null;
        }
        return new Thumbnail($this->data['thumbnail']);
    }
}