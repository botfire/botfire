<?php
namespace Botfire\Models;

use Botfire\Models\OptionCaption;

class CopyMessage extends Option
{

    use OptionCaption;

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




    /**
     * New start timestamp for the copied video in the message
     * @param int $video_start_timestamp
     * @return static
     */
    public function videoStartTimestamp(int $video_start_timestamp)
    {
        $this->data['video_start_timestamp'] = $video_start_timestamp;
        return $this;
    }



    /**
     * Pass True, if the caption must be shown above the message media.
     * Ignored if a new caption isn't specified.
     * @param bool $show_caption_above_media
     * @return static
     */
    public function showCaptionAboveMedia(bool $show_caption_above_media)
    {
        $this->data['show_caption_above_media'] = $show_caption_above_media;
        return $this;
    }


    /**
     * Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param int $message_thread_id
     * @return static
     */
    public function messageThreadId(int $message_thread_id)
    {
        $this->data['message_thread_id'] = $message_thread_id;
        return $this;
    }

}