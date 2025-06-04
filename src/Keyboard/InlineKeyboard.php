<?php
namespace Botfire\Keyboard;
use Botfire\Keyboard\InlineButton;



/**
 * Class InlineKeyboardMarkup
 * Represents an inline keyboard markup for Telegram bots.
 *
 * @see https://core.telegram.org/bots/api#inlinekeyboardmarkup
 */
class InlineKeyboard
{


    private $buttons = [];
    private int $currentRow = 0;



    /**
     * 
     * @param array $buttons
     * @return static
     */
    public function row(array $buttons = [])
    {
        if (!empty($buttons)) {
            $this->buttons[] = array_map(function ($button) {
                if ($button instanceof InlineButton) {
                    return $button->toArray();
                }
            }, $buttons);
            $this->currentRow++;
            return $this;
        }

        // Start a new row
        if ($this->currentRow >= 0 && !empty($this->buttons[$this->currentRow])) {
            $this->currentRow++;
        }

        return $this;
    }



    /**
     * Convert the inline keyboard to an array format suitable for Telegram API.
     * @return array{inline_keyboard: array}
     */
    public function toArray(): array
    {
        return [
            'inline_keyboard' => array_filter($this->buttons)
        ];
    }


    /**
     * Convert the inline keyboard to JSON format.
     * This method encodes the keyboard to JSON format, which is suitable for sending to the Telegram API.
     * It uses the `toArray` method to get the array representation of the keyboard and then encodes it.
     * @return bool|string
     */
    public function toJson(): bool|string
    {
        return json_encode($this->toArray());
    }
}