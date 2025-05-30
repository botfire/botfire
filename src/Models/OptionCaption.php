<?php
namespace Botfire\Models;

trait OptionCaption
{

    protected $data = [];



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



    /**
     * 	A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param string $caption_entities
     * @return static
     */
    public function captionEntities($caption_entities)
    {
        $this->data['caption_entities'] = $caption_entities;
        return $this;
    }


}