<?php
namespace Botfire\TraitMethods;

trait CaptionEntitiesTrait
{

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