<?php
namespace Botfire\Responses\Models;

class PhotoItem {
    private $fileId;
    private $fileUniqueId;
    private $fileSize;
    private $width;
    private $height;

    
    public function __construct($data) {
        $this->fileId = $data['file_id'];
        $this->fileUniqueId = $data['file_unique_id'];
        $this->fileSize = $data['file_size'];
        $this->width = $data['width'];
        $this->height = $data['height'];
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
