<?php

namespace Botfire\Responses;

class TextMessageResult extends MessageResult
{

    private string $text;
    
    
    public function __construct($result)
    {
        parent::__construct($result);
        $this->text = $result['text'];
    }

    public function getText(): string
    {
        return $this->text;
    }
}
