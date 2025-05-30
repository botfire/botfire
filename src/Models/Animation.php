<?php
namespace Botfire\Models;
use Botfire\Models\File;

class Animation extends Option{

    protected $data = [];


    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent Message is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future
     * @param mixed $audio
     */
    public function __construct($audio){
        $this->data['animation'] = $audio;
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