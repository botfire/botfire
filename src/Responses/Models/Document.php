<?php
namespace Botfire\Responses\Models;

use Botfire\Responses\Models\Thumbnail;


class Document {
    private $fileName;
    private $mimeType;
    private $thumbnail;
    private $thumb;
    private $fileId;
    private $fileUniqueId;
    private $fileSize;

    public function __construct($data) {
        if (isset($data['file_name'])) {
            $this->fileName = $data['file_name'];
        }
        if (isset($data['mime_type'])) {
            $this->mimeType = $data['mime_type'];
        }
        if (isset($data['thumbnail'])) {
            $this->thumbnail = new Thumbnail($data['thumbnail']);
        }
        if (isset($data['thumb'])) {
            $this->thumb = new Thumbnail($data['thumb']);
        }
        if (isset($data['file_id'])) {
            $this->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $this->fileUniqueId = $data['file_unique_id'];
        }
        if (isset($data['file_size'])) {
            $this->fileSize = $data['file_size'];
        }
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function getMimeType() {
        return $this->mimeType;
    }

    public function getThumbnail() {
        return $this->thumbnail;
    }

    public function getThumb() {
        return $this->thumb;
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
}