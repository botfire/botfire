<?php
namespace Botfire;

use Botfire\Models\Audio;
use Botfire\Models\CopyMessage;
use Botfire\Models\CopyMessages;
use Botfire\Models\Document;
use Botfire\Models\EditCaption;
use Botfire\Models\EditReplyMarkup;
use Botfire\Models\EditText;
use Botfire\Models\Message;
use Botfire\Models\Photo;
use Botfire\Models\Chat;
use Botfire\Models\PhotoArray;
use Botfire\Models\Video;
use Botfire\Models\VideoNote;
use Botfire\Models\Voice;



class NewMessage
{
    private $data;

    private $sendMethod = '';

    private $sendParams = [];


    public function __construct($data)
    {
        $this->data = $data;
    }



    private function makeMethodName($type, $prefix = 'send')
    {
        if (str_starts_with($type, '@')) {
            return substr($type, 1);
        } else {
            $method = $prefix;

            $type = ucfirst($type);

            if ($type == 'Text') {
                $method .= 'Message';
            } else {
                $method .= $type;
            }

            return $method;
        }
    }





    /**
     * Use this method to send text messages.
     * @param mixed $text
     */
    public function text(Message|string $text)
    {
        if ($text instanceof Message) {
            $text->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['text'] = $text;
        }

        $this->sendMethod = 'message';

        return $this;

    }


    /**
     * Use this method to send photos.
     * On success, the sent Message is returned.
     * @param mixed $photo
     * @return NewMessage|PhotoArray
     */
    public function photo($photo = null)
    {
        if ($photo instanceof Photo) {
            $photo->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['voice'] = $photo;
        }

        $this->sendMethod = 'voice';

        return $this;
    }



    /**
     * Use this method to send audio files, 
     * if you want Telegram clients to display the file as a playable voice message.
     * For this to work, your audio must be in an .OGG file encoded with OPUS, or in .MP3 format, or in .M4A format (other formats may be sent as Audio or Document).
     * On success, the sent Message is returned.
     * Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     * 
     * @param \Botfire\Models\Voice|string $voice
     * @return static
     */
    public function voice(Voice|string $voice)
    {
        if ($voice instanceof Voice) {
            $voice->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['voice'] = $voice;
        }

        $this->sendMethod = 'voice';

        return $this;
    }


    /**
     * Use this method to send audio files,
     * if you want Telegram clients to display them in the music player.
     * Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     * 
     * For sending voice messages, use the voice method instead.
     * 
     * @param \Botfire\Models\Audio|string $audio
     * @return static
     */
    public function audio(Audio|string $audio)
    {

        if ($audio instanceof Audio) {
            $audio->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['audio'] = $audio;
        }

        $this->sendMethod = 'audio';

        return $this;
    }


    /**
     * Use this method to send general files.
     * On success, the sent Message is returned.
     * Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     * @param \Botfire\Models\Document|string $document
     * @return static
     */
    public function document(Document|string $document)
    {

        if ($document instanceof Document) {
            $document->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['document'] = $document;
        }

        $this->sendMethod = 'document';

        return $this;
    }


    /**
     * Use this method to send video files,
     * Telegram clients support MPEG4 videos (other formats may be sent as Document).
     * On success, the sent Message is returned.
     * Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     * @param \Botfire\Models\Video|string $video
     * @return static
     */
    public function video(Video|string $video)
    {
        if ($video instanceof Video) {
            $video->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['video'] = $video;
        }

        $this->sendMethod = 'video';

        return $this;
    }

    public function videoNote(VideoNote|string $video)
    {
        if ($video instanceof VideoNote) {
            $video->appendToSendParams($this->sendParams);
        } else {
            $this->sendParams['video_note'] = $video;
        }

        $this->sendMethod = 'videoNote';

        return $this;
    }


    public function copyMessage(CopyMessage $copy_message)
    {
        $copy_message->appendToSendParams($this->sendParams);
        $this->sendMethod = '@copyMessage';
        return $this;
    }

    public function copyMessages(CopyMessages $copy_messages)
    {
        $copy_messages->appendToSendParams($this->sendParams);
        $this->sendMethod = '@copyMessage';
        return $this;
    }


    /**
     * Use this method to edit text and game messages.
     * On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     * @param EditText $message
     */
    public function editMessageText(EditText $messages)
    {
        $messages->appendToSendParams($this->sendParams);
        Bot::sendMessage(json_encode($this->sendParams, JSON_PRETTY_PRINT));
        $this->sendMethod = '@editMessageText';
        return $this;
    }


    /**
     * Use this method to edit only the reply markup of messages.
     * On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned. Note that business messages that were not sent by the bot and do not contain an inline keyboard can only be edited within 48 hours from the time they were sent.
     * @param EditCaption $caption
     */
    public function editMessageCaption(EditCaption $caption)
    {
        $caption->appendToSendParams($this->sendParams);
        $this->sendMethod = '@editMessageCaption';
        return $this;
    }


    /**
     * Use this method to edit only the reply markup of messages.
     * On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     * Note that business messages that were not sent by the bot and do not contain an inline keyboard can only be edited within 48 hours from the time they were sent.
     * @param EditReplyMarkup $reply_markup
     * @return static
     */
    public function editMessageReplyMarkup(EditReplyMarkup $reply_markup)
    {
        $reply_markup->appendToSendParams($this->sendParams);
        $this->sendMethod = '@editMessageReplyMarkup';
        return $this;
    }


    /**
     * 
     * @param string|int $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     */
    public function send(string|int $chat_id = null)
    {

        if (empty($this->sendParams['chat_id'])) {

            if(Bot::getEvent()->hasFrom()){
                $this->sendParams['chat_id'] = Bot::getEvent()->getFrom()->getId();
            }
        }

        return Bot::request($this->makeMethodName($this->sendMethod), $this->sendParams);
    }
}

