<?php
namespace Botfire\Models;
use Botfire\Models\File;

class VideoNote extends Option{

    protected $data = [];


    /**
     * Video note to send.
     * Pass a file_id as String to send a video note that exists on the Telegram servers (recommended) or upload a new video using multipart/form-data.
     * @param mixed $audio
     */
    public function __construct($video_note){
        $this->data['video_note'] = $video_note;
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
     * Video width and height, i.e. diameter of the video message
     * @param int $length
     * @return static
     */
    public function length(int $length) {
        $this->data['length'] = $length;
        return $this;
    }

    

}