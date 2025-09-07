<?php

namespace Botfire\Responses;

use Botfire\Responses\Models\Document;

class DocumentMessageResult extends MessageResult
{

    private object $document;


    public function __construct($result)
    {
        parent::__construct($result);
        $this->document = $result['document'];
    }


    public function getDocument(): Document
    {
        return new Document($this->document);
    }
}
