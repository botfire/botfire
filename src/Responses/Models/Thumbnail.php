<?php
namespace Botfire\Responses\Models;

class Thumbnail {
    private $fileId;
    private $fileUniqueId;
    private $fileSize;
    private $width;
    private $height;

    public function __construct($data) {
        if (isset($data['file_id'])) {
            $this->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $this->fileUniqueId = $data['file_unique_id'];
        }
        if (isset($data['file_size'])) {
            $this->fileSize = $data['file_size'];
        }
        if (isset($data['width'])) {
            $this->width = $data['width'];
        }
        if (isset($data['height'])) {
            $this->height = $data['height'];
        }
    }

    public function getFileId() {
        return $this->fileId;
    }

    public function getFileUniqueId() {
        return $this->fileUniqueId;
    }

    public function getFileSize() {
        return $this->fileSize;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }
}