<?php
namespace Botfire\Models;
use Botfire\Models\OptionCaption;



class Voice extends Option{

    use OptionCaption;

    protected $data = [];


    /**
     * Audio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data
     * @param mixed $voice
     */
    public function __construct($voice){
        $this->data['voice'] = $voice;
    }



    /**
     * Duration of the audio in seconds
     * @param int $duration
     * @return static
     */
    public function duration(int $duration) {
        $this->data['duration'] = $duration;
        return $this;
    }


}