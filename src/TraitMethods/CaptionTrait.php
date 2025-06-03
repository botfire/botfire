<?php
namespace Botfire\TraitMethods;

trait CaptionTrait
{

    /**
     * New caption for media, 0-1024 characters after entities parsing. If not specified, the original caption is kept
     * @param string $caption
     * @return static
     */
    public function caption(string $caption)
    {
        $this->data['caption'] = $caption;
        return $this;
    }


}