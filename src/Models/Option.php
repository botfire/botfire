<?php
namespace Botfire\Models;
use Botfire\InlineKeyboard;
use Botfire\MarkupKeyboard;
use Botfire\Models\File;

class Option
{

    protected $data = [];



    /**
     * To use this mode, pass MarkdownV2 in the parse_mode field. 
     * @var string
     */
    public const FormattingMarkdownV2 = 'MarkdownV2';


    /**
     * To use this mode, pass HTML in the parse_mode field
     * @var string
     */
    public const FormattingHTML = 'HTML';


    /**
     * This is a legacy mode, retained for backward compatibility
     * @var string
     */
    public const FormattingMarkdown = 'Markdown';




    /**
     * Mode for parsing entities in the document caption. See formatting options for more details.
     * @param string $parse_mode
     * @return static
     */
    public function parseMode(string $parse_mode)
    {
        $this->data['parse_mode'] = $parse_mode;
        return $this;
    }



    // /**
    //  * New caption for media, 0-1024 characters after entities parsing. If not specified, the original caption is kept
    //  * @param string $caption
    //  * @return static
    //  */
    // public function caption(string $caption)
    // {
    //     $this->data['caption'] = $caption;
    //     return $this;
    // }



    // /**
    //  * 	A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
    //  * @param string $caption_entities
    //  * @return static
    //  */
    // public function captionEntities($caption_entities)
    // {
    //     $this->data['caption_entities'] = $caption_entities;
    //     return $this;
    // }



    /**
     * Unique identifier of the business connection on behalf of which the message will be sent
     * @param string $business_connection_id
     * @return static
     */
    public function businessConnectionId(string $business_connection_id)
    {
        $this->data['business_connection_id'] = $business_connection_id;
        return $this;
    }


    /**
     * Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files »
     * @param mixed $thumbnail
     * @return static
     */
    public function thumbnail($thumbnail)
    {
        $this->data['thumbnail'] = $thumbnail;
        return $this;
    }


    /**
     * Sends the message silently. Users will receive a notification with no sound.
     * @param mixed $disable_notification
     * @return static
     */
    public function disableNotification(bool $disable_notification)
    {
        $this->data['disable_notification'] = $disable_notification;
        return $this;
    }




    /**
     * Protects the contents of the sent message from forwarding and saving
     * @param bool $protect
     * @return static
     */
    public function protectContent(bool $protect)
    {
        $this->data['protect_content'] = $protect;
        return $this;
    }



    /**
     * Pass True to allow up to 1000 messages per second, ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be withdrawn from the bot's balance
     * @param bool $allow_paid_broadcast
     * @return static
     */
    public function allowPaidBroadcast(bool $allow_paid_broadcast)
    {
        $this->data['allow_paid_broadcast'] = $allow_paid_broadcast;
        return $this;
    }



    /**
     * Unique identifier of the message effect to be added to the message; for private chats only
     * @param string $message_effect_id
     * @return static
     */
    public function messageEffectId(string $message_effect_id)
    {
        $this->data['message_effect_id'] = $message_effect_id;
        return $this;
    }



    /**
     * Description of the message to reply to
     * @param mixed $reply_parameters
     * @return void
     */
    public function replyParameters($reply_parameters)
    {
        $this->data['reply_parameters'] = $reply_parameters;
    }



    /**
     * Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from the user
     * @param mixed $reply_markup
     * @return static
     */
    public function replyMarkup(InlineKeyboard|MarkupKeyboard $reply_markup)
    {
        $this->data['reply_markup'] = $reply_markup->toJson();
        return $this;
    }
    

    public function appendToSendParams(&$data)
    {
        foreach ($this->data as $key => $value) {
            $data[$key] = $value;
        }
    }


    public function toArray(){
        return $this->data;
    }
}