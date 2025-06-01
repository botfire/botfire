<?php
namespace Botfire\Models;

use Botfire\Models\OptionAppendToParams;

class CopyMessages
{

    use OptionAppendToParams;


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


    /**
     * Sends the messages silently.
     * Users will receive a notification with no sound.
     * @param bool $disable_notification
     * @return static
     */
    public function disableNotification(bool $disable_notification)
    {
        $this->data['disable_notification'] = $disable_notification;
        return $this;
    }


    /**
     * Protects the contents of the sent messages from forwarding and saving
     * @param bool $protect_content
     * @return static
     */
    public function protectContent(bool $protect_content)
    {
        $this->data['protect_content'] = $protect_content;
        return $this;
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