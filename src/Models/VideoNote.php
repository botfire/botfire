<?php

namespace Botfire\Models;

use Botfire\Bot;
use Botfire\Helper\MarkdownBuilder;
use Botfire\TraitMethods\AllowPaidBroadcastTrait;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\DisableNotificationTrait;
use Botfire\TraitMethods\DurationTrait;
use Botfire\TraitMethods\LengthTrait;
use Botfire\TraitMethods\MessageEffectIdTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;
use Botfire\TraitMethods\ProtectContentTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;
use Botfire\TraitMethods\ReplyParametersTrait;
use Botfire\TraitMethods\ThumbnailTrait;
use CURLFile;

class VideoNote extends Option
{

    use BusinessConnectionIdTrait, MessageThreadIdTrait, ThumbnailTrait;
    use DisableNotificationTrait, ProtectContentTrait, AllowPaidBroadcastTrait;
    use MessageEffectIdTrait, ReplyParametersTrait, ReplyMarkupTrait;
    use DurationTrait, LengthTrait;



    protected $data = [];


    /**
     * Video note to send.
     * Pass a file_id as String to send a video note that exists on the Telegram servers (recommended) or upload a new video using multipart/form-data.
     * @param mixed $audio
     */
    public function __construct($video_note)
    {
        $this->data['video_note'] = $video_note;
    }


    /**
     * Video note to send.
     * Pass a file_id as String to send a video note that exists on the Telegram servers (recommended) or upload a new video using multipart/form-data.
     * @param mixed $audio
     */
    public static function create(MarkdownBuilder|CURLFile|string $video_note): static
    {
        return new static($video_note);
    }

    /**
     * Send the Video Note message
     * @return mixed
     */
    public function send()
    {
        return Bot::sendVideoNote($this);
    }
}
