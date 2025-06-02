<?php
namespace Botfire\Models;
use Botfire\Models\OptionMessageId;

class EditMessage extends Option{

    use OptionMessageId;

    protected $data = [];


    /**
     * New text of the message, 1-4096 characters after entities parsing
     * @param mixed $text
     */
    public function __construct($text){
        $this->data['text'] = $text;
    }



    /**
     * A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
     * @param mixed $entities
     * @return static
     */
    public function entities($entities){
        $this->data['entities'] = $entities;
        return $this;
    }


    /**
     * Link preview generation options for the message
     * @param mixed $link_preview_options
     * @return static
     */
    public function linkPreviewOptions($link_preview_options){
        $this->data['link_preview_options'] = $link_preview_options;
        return $this;
    }

}