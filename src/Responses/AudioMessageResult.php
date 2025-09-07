<?php

namespace Botfire\Responses;

use Botfire\Responses\Models\Audio;

class AudioMessageResult extends MessageResult
{

    private $audio;


    public function __construct($result)
    {
        parent::__construct($result);
        $this->audio = $result['audio'];
    }


    public function getAudio(): Audio
    {
        return new Audio($this->audio);
    }
}
