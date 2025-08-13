<?php

namespace Botfire\Models;

use Botfire\Bot;
use Botfire\Helper\MarkdownBuilder;
use Botfire\Helper\ParseMode;
use Botfire\TraitMethods\AllowPaidBroadcastTrait;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\DisableNotificationTrait;
use Botfire\TraitMethods\EntitiesTrait;
use Botfire\TraitMethods\LinkPreviewOptionsTrait;
use Botfire\TraitMethods\MessageEffectIdTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;
use Botfire\TraitMethods\ParseModeTrait;
use Botfire\TraitMethods\ProtectContentTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;
use Botfire\TraitMethods\ReplyParametersTrait;

class Message extends Option
{

    use BusinessConnectionIdTrait, MessageThreadIdTrait, ParseModeTrait;
    use EntitiesTrait, LinkPreviewOptionsTrait, DisableNotificationTrait;
    use ProtectContentTrait, AllowPaidBroadcastTrait, MessageEffectIdTrait;
    use ReplyParametersTrait, ReplyMarkupTrait;



    protected $data = [];


    /**
     * Text of the message to be sent, 1-4096 characters after entities parsing
     * @param mixed $text
     */
    public function __construct(string|MarkdownBuilder $text)
    {
        if ($text instanceof MarkdownBuilder) {
            $text = $text->build();
            $this->parseMode(ParseMode::MarkdownV2);
        }

        $this->data['text'] = $text;
    }


    /**
     * Create a new Message instance
     *
     * @param string $text The text of the message to be sent
     * @return Message
     */
    public static function create(string|MarkdownBuilder $text): static
    {
        return new static($text);
    }


    /**
     * Use this method to send text messages.
     */
    public function send()
    {
        return Bot::sendMessage($this);
    }
}
