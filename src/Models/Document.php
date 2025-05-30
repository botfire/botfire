<?php
namespace Botfire\Models;
use Botfire\Models\OptionCaption;


class Document extends Option
{

    use OptionCaption;


    protected $data = [];


    /**
     * 	File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.
     * @param mixed $document
     * @return void
     */
    public function __construct($document)
    {
        $this->data['document'] = $document;
    }




}