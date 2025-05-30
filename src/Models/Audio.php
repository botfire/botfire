<?php
namespace Botfire\Models;
use Botfire\Models\OptionCaption;

class Audio extends Option{

    use OptionCaption;

    protected $data = [];


    /**
     * Audio file to send. Pass a file_id as String to send an audio file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an audio file from the Internet, or upload a new one using multipart/form-data
     * @param mixed $audio
     */
    public function __construct($audio){
        $this->data['audio'] = $audio;
    }


    /**
     * Track name
     * @param string $title
     * @return static
     */
    public function title(string $title){
        $this->data['title'] = $title;
        return $this;
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

    
    /**
     * Performer
     * @param string $performer
     * @return static
     */
    public function performer(string $performer){
        $this->data['performer'] = $performer;
        return $this;
    }


}