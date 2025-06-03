<?php
namespace Botfire\TraitMethods;

trait ShowCaptionAboveMediaTrait
{
    /**
     * Pass True, if the caption must be shown above the message media
     * @param bool $show_caption_above_media
     * @return static
     */
    public function showCaptionAboveMedia(bool $show_caption_above_media){
        $this->data['show_caption_above_media'] = $show_caption_above_media;
        return $this;
    }
}