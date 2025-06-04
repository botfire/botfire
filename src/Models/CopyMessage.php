<?php
namespace Botfire\Models;

use Botfire\TraitMethods\AllowPaidBroadcastTrait;
use Botfire\TraitMethods\CaptionAndParseModeTrait;
use Botfire\TraitMethods\CaptionEntitiesTrait;
use Botfire\TraitMethods\DisableNotificationTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;
use Botfire\TraitMethods\ProtectContentTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;
use Botfire\TraitMethods\ReplyParametersTrait;
use Botfire\TraitMethods\ShowCaptionAboveMediaTrait;
use Botfire\TraitMethods\VideoStartTimestampTrait;

class CopyMessage extends Option
{

    use MessageThreadIdTrait, VideoStartTimestampTrait,CaptionAndParseModeTrait;
    use CaptionEntitiesTrait, ShowCaptionAboveMediaTrait, DisableNotificationTrait;
    use ProtectContentTrait, AllowPaidBroadcastTrait, ReplyMarkupTrait, ReplyParametersTrait;

    protected $data = [];


    /**
     * Use this method to copy messages of any kind.
     * Service messages, paid media messages, giveaway messages, giveaway winners messages, and invoice messages can't be copied. A quiz poll can be copied only if the value of the field correct_option_id is known to the bot.
     * The method is analogous to the method forwardMessage, but the copied message doesn't have a link to the original message.
     * Returns the MessageId of the sent message on success.
     * @param int|string $from_chat_id
     * @param int $message_id
     */
    public function __construct(int|string $from_chat_id, int $message_id)
    {
        $this->data['from_chat_id'] = $from_chat_id;
        $this->data['message_id'] = $message_id;
    }



}