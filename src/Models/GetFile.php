<?php
namespace Botfire\Models;

use Botfire\Bot;


class GetFile
{

    private $file;
    private $status = false;

    public function __construct($file)
    {

        if ($file['ok']) {
            $this->status = true;
            $this->file = $file['result'];
        }
    }

    public function status()
    {
        return $this->status;
    }


    public function getFileId()
    {
        return $this->file['file_id'] ?? null;
    }

    public function getFilePath()
    {
        return $this->file['file_path'] ?? null;
    }

    public function getFileSize()
    {
        return $this->file['file_size'] ?? null;
    }
    
    public function getFileUniqueId()
    {
        return $this->file['file_unique_id'] ?? null;
    }

    public function getAsArray()
    {
        return $this->file;
    }


    public function getType(): string|null
    {
        return explode('/', $this->getFilePath())[0] ?? null;
    }

    public function getFileName(): string|null
    {
        return end(explode('/', $this->getFilePath())) ?? null;
    }
}