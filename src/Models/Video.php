<?php
namespace Botfire\Models;
use Botfire\Models\OptionCaption;

class Video extends Option{

    use OptionCaption;

    protected $data = [];


    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent Message is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future
     * @param mixed $audio
     */
    public function __construct($audio){
        $this->data['video'] = $audio;
    }




    /**
     * Start timestamp for the video in the message
     * @param int $start_timestamp
     * @return static
     */
    public function startTimestamp(int $start_timestamp){
        $this->data['start_timestamp'] = $start_timestamp;
        return $this;
    }


    /**
     * Cover for the video in the message. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
     * @param mixed $cover
     * @return static
     */
    public function cover($cover){
        $this->data['cover'] = $cover;
        return $this;
    }

    /**
     * Animation width
     * @param int $width
     * @return static
     */
    public function width(int $width){
        $this->data['width'] = $width;
        return $this;
    }


    /**
     * Animation height
     * @param int $height
     * @return static
     */
    public function height(int $height){
        $this->data['height'] = $height;
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
     * Pass True, if the caption must be shown above the message media
     * @param bool $show_caption_above_media
     * @return static
     */
    public function showCaptionAboveAedia(bool $show_caption_above_media){
        $this->data['show_caption_above_media'] = $show_caption_above_media;
        return $this;
    }    

    /**
     * Pass True if the animation needs to be covered with a spoiler animation
     * @param bool $has_spoiler
     * @return static
     */
    public function hasSpoiler(bool $has_spoiler){
        $this->data['has_spoiler'] = $has_spoiler;
        return $this;
    }


}