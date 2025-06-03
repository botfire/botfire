<?php
namespace Botfire\Models;
use Botfire\Keyboard\InlineKeyboard;
use Botfire\Keyboard\ReplyKeyboard;
use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\CaptionEntitiesTrait;
use Botfire\TraitMethods\CaptionTrait;
use Botfire\TraitMethods\InlineMessageIdTrait;
use Botfire\TraitMethods\ParseModeTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;
use Botfire\TraitMethods\ShowCaptionAboveMediaTrait;

class EditCaption extends Option
{


    use BusinessConnectionIdTrait, CaptionTrait,ParseModeTrait, InlineMessageIdTrait;
    use CaptionEntitiesTrait,ShowCaptionAboveMediaTrait, ReplyMarkupTrait;


    protected $data = [];




    /**
     * New caption of the message, 0-1024 characters after entities parsing
     * @param mixed $caption
     */
    public function __construct($caption)
    {
        $this->data['caption'] = $caption;
    }





}