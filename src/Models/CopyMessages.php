<?php
namespace Botfire\Models;

use Botfire\TraitMethods\DisableNotificationTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;
use Botfire\TraitMethods\ProtectContentTrait;


class CopyMessages extends Option
{

    use MessageThreadIdTrait, DisableNotificationTrait, ProtectContentTrait;

    protected $data = [];



    /**
     * Use this method to copy messages of any kind.
     * If some of the specified messages can't be found or copied, they are skipped.
     * Service messages, paid media messages, giveaway messages, giveaway winners messages, and invoice messages can't be copied.
     * A quiz poll can be copied only if the value of the field correct_option_id is known to the bot.
     * The method is analogous to the method forwardMessages, but the copied messages don't have a link to the original message.
     * Album grouping is kept for copied messages.
     * On success, an array of MessageId of the sent messages is returned.
     * @param int|string $from_chat_id
     * @param array $message_ids
     */
    public function __construct(int|string $from_chat_id, array $message_ids)
    {
        $this->data['from_chat_id'] = $from_chat_id;
        $this->data['message_ids'] = $message_ids;
    }



    /**
     * Pass True to copy the messages without their captions
     * @param bool $remove_caption
     * @return static
     */
    public function removeCaption(bool $remove_caption = true){
        $this->data['remove_caption'] = $remove_caption;
        return $this;
    }
}