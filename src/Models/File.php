<?php
namespace Botfire\Models;

use Botfire\Bot;
use Botfire\Models\GetFile;

class File
{

    protected $data;

    public function getFileId()
    {
        return $this->data['file_id'] ?? null;
    }

    public function getFileSize()
    {
        return $this->data['file_size'] ?? null;
    }



    public function getFile(): GetFile
    {
        $file = Bot::getParser()->request('getFile', [
            'file_id' => $this->getFileId()
        ]);

        return new GetFile($file);
    }


    public function download($save_to, $custom_file_name = false): array
    {
        $file = $this->getFile();

        if ($file->status() == false) {
            return ['status' => false, 'message' => ''];
        }

        $file_name = $file->getFileName();
        $file_path = $file->getFilePath();
        $content = Bot::getParser()->requestFile($file_path);

        if ($custom_file_name != false) {
            $file_name = $custom_file_name;
            $file_name = str_replace('@name', $file->getFileName(), $file_name);
        }

        $dir = rtrim($save_to, '/\\') . DIRECTORY_SEPARATOR . $file_name;
        file_put_contents($dir, $content);
        return ['status' => $file->status(), 'dir' => $dir, 'file_name' => $file_name];
    }


    public function asArray()
    {
        return $this->data;
    }
}