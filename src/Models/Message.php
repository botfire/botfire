<?php
namespace Botfire\Models;

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
    public function __construct($text)
    {
        $this->data['text'] = $text;
    }


    /**
     * Create a new Message instance
     *
     * @param string $text The text of the message to be sent
     * @return Message
     */
    public static function create(string $text)
    {
        return new self($text);
    }

}