<?php
namespace Botfire\Models;
use Botfire\Helper\MarkdownBuilder;
use Botfire\TraitMethods\AllowPaidBroadcastTrait;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\CaptionEntitiesTrait;
use Botfire\TraitMethods\CaptionAndParseModeTrait;
use Botfire\TraitMethods\DisableNotificationTrait;
use Botfire\TraitMethods\DurationTrait;
use Botfire\TraitMethods\MessageThreadIdTrait;
use Botfire\TraitMethods\PerformerTrait;
use Botfire\TraitMethods\ProtectContentTrait;
use Botfire\TraitMethods\TitleTrait;
use CURLFile;


class Voice extends Option
{

    use BusinessConnectionIdTrait, MessageThreadIdTrait;
    use DurationTrait, PerformerTrait;
    use CaptionAndParseModeTrait, CaptionEntitiesTrait, TitleTrait, DurationTrait;
    use DisableNotificationTrait, ProtectContentTrait, AllowPaidBroadcastTrait;

    protected $data = [];


    /**
     * Audio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data
     * @param MarkdownBuilder|CURLFile|string $voice
     */
    public function __construct($voice)
    {
        $this->data['voice'] = $voice;
    }


    /**
     * Audio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data
     * @param MarkdownBuilder|CURLFile|string $voice
     */
    public static function create(MarkdownBuilder|CURLFile|string $voice)
    {
        return new static($voice);
    }


}