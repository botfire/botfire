<?php

namespace Botfire\Models;

use Botfire\Bot;
use Botfire\Helper\MarkdownBuilder;
use Botfire\TraitMethods\AllowPaidBroadcastTrait;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\CaptionEntitiesTrait;
use Botfire\TraitMethods\CaptionAndParseModeTrait;
use Botfire\TraitMethods\CoverTrait;
use Botfire\TraitMethods\DisableNotificationTrait;
use Botfire\TraitMethods\DurationTrait;
use Botfire\TraitMethods\HasSpoilerTrait;
use Botfire\TraitMethods\HeightTrait;
use Botfire\TraitMethods\MessageEffectIdTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;
use Botfire\TraitMethods\ProtectContentTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;
use Botfire\TraitMethods\ReplyParametersTrait;
use Botfire\TraitMethods\ShowCaptionAboveMediaTrait;
use Botfire\TraitMethods\StartTimestampTrait;
use Botfire\TraitMethods\SupportsStreamingTrait;
use Botfire\TraitMethods\ThumbnailTrait;
use Botfire\TraitMethods\WidthTrait;
use CURLFile;

class Video extends Option
{

    use BusinessConnectionIdTrait, MessageThreadIdTrait, ThumbnailTrait;
    use CaptionAndParseModeTrait, CaptionEntitiesTrait;
    use DisableNotificationTrait, ProtectContentTrait, AllowPaidBroadcastTrait;
    use MessageEffectIdTrait, ReplyParametersTrait, ReplyMarkupTrait;
    use SupportsStreamingTrait, DurationTrait, StartTimestampTrait, CoverTrait, WidthTrait, HeightTrait, ShowCaptionAboveMediaTrait, HasSpoilerTrait;


    protected $data = [];


    /**
     * Video to send.
     * Pass a file_id as String to send a video that exists on the Telegram servers (recommended),
     * pass an HTTP URL as a String for Telegram to get a video from the Internet, or upload a new video using multipart/form-data.
     * The video must be at most 50 MB in size.
     * The video’s width and height must not exceed 10000 in total.
     * Width and height ratio must be at most 20.
     * @param MarkdownBuilder|\CURLFile|string $video
     */
    public function __construct(MarkdownBuilder|CURLFile|string $video)
    {
        $this->data['video'] = $video;
    }



    /**
     * Video to send.
     * Pass a file_id as String to send a video that exists on the Telegram servers (recommended),
     * pass an HTTP URL as a String for Telegram to get a video from the Internet, or upload a new video using multipart/form-data.
     * The video must be at most 50 MB in size.
     * The video’s width and height must not exceed 10000 in total.
     * Width and height ratio must be at most 20.
     * @param MarkdownBuilder|\CURLFile|string $video
     * @return Video
     */
    public static function create(MarkdownBuilder|CURLFile|string $video): static
    {
        return new static($video);
    }


    /**
     * Send the Video message
     * @return mixed
     */
    public function send()
    {
        return Bot::sendVideo($this);
    }
}
