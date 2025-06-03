<?php
namespace Botfire\TraitMethods;

use Botfire\Keyboard\InlineKeyboard;
use Botfire\Keyboard\ReplyKeyboard;

trait ReplyMarkupTrait
{
    /**
     * Additional interface options for the message.
     * @param array $reply_markup
     * @return static
     */
    public function replyMarkup(InlineKeyboard|ReplyKeyboard $reply_markup)
    {
        $this->data['reply_markup'] = $reply_markup;
        return $this;
    }
}