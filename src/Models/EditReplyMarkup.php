<?php
namespace Botfire\Models;

use Botfire\TraitMethods\BusinessConnectionIdTrait;
use Botfire\TraitMethods\InlineMessageIdTrait;
use Botfire\TraitMethods\MessageIdTrait;
use Botfire\TraitMethods\ReplyMarkupTrait;

class EditReplyMarkup extends Option
{

    use BusinessConnectionIdTrait,InlineMessageIdTrait,MessageIdTrait,ReplyMarkupTrait;



    protected $data = [];
}