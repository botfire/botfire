<?php

namespace Botfire\Models;

use Botfire\Bot;
use Botfire\Helper\MarkdownBuilder;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\EntitiesTrait;
use Botfire\TraitMethods\InlineMessageIdTrait;
use Botfire\TraitMethods\LinkPreviewOptionsTrait;
use Botfire\TraitMethods\MessageIdTrait;
use Botfire\TraitMethods\ParseModeTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;

class EditText extends Option
{

    use BusinessConnectionIdTrait, InlineMessageIdTrait, ParseModeTrait;
    use ReplyMarkupTrait, LinkPreviewOptionsTrait, EntitiesTrait;
    use MessageIdTrait;



    protected $data = [];




    /**
     * New text of the message, 1-4096 characters after entities parsing
     * @param mixed $text
     */
    public function __construct(string|MarkdownBuilder $text)
    {
        $this->data['text'] = $text;
    }



    public static function create(string|MarkdownBuilder $text): static
    {
        return new static($text);
    }



    public function send()
    {
        return Bot::editMessageText($this);
    }
}
