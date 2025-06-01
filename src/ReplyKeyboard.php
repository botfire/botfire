<?php
namespace Botfire;

use Botfire\Models\KeybardOption;

class ReplyKeyboard
{



    protected $buttons = [];
    private int $currentRow = 0;

    private bool $selective = false;

    private string $input_field_placeholder = '';

    private bool $one_time_keyboard = false;

    private bool $resize_keyboard = false;






    /**
     * Optional
     * Use this parameter if you want to show the keyboard to specific users only.
     * Targets: 
     *   1) users that are @mentioned in the text of the Message object;
     *   2) if the bot's message is a reply to a message in the same chat and forum topic, sender of the original message.
     * @param bool $selective
     * @return static
     */
    public function selective(bool $selective)
    {
        $this->selective = $selective;
        return $this;
    }


    /**
     * Optional
     * The placeholder to be shown in the input field when the keyboard is active; 1-64 characters
     * @param string $placeholder
     * @return static
     */
    public function inputFieldPlaceholder(string $placeholder)
    {
        $this->input_field_placeholder = $placeholder;
        return $this;
    }


    /**
     * Optional
     * Requests clients to hide the keyboard as soon as it's been used.
     * The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat - the user can press a special button in the input field to see the custom keyboard again.
     * Defaults to false.
     * @param bool $one_time_keyboard
     * @return static
     */
    public function oneTimeKeyboard(bool $one_time_keyboard)
    {
        $this->one_time_keyboard = $one_time_keyboard;
        return $this;
    }

    /**
     * Optional
     * Requests clients to resize the keyboard vertically for optimal fit
     * (e.g., make the keyboard smaller if there are just two rows of buttons)
     * Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     * @param bool $resize_keyboard
     * @return static
     */
    public function resizeKeyboard(bool $resize_keyboard)
    {
        $this->resize_keyboard = $resize_keyboard;
        return $this;
    }



    public function row(array $buttons = [])
    {
        if (!empty($buttons)) {
            $this->buttons[] = array_map(function ($button) {
                if ($button instanceof KeyboardButton) {
                    return $button->toArray();
                }
                return ['text' => $button];
            }, $buttons);
            $this->currentRow++;
            return $this;
        }

        // Start a new row
        if ($this->currentRow >= 0 && !empty($this->buttons[$this->currentRow])) {
            $this->currentRow++;
        }

        // $this->buttons[] = [];
        return $this;
    }


    /**
     * Convert the keyboard to an array format suitable for Telegram API.
     * @return array{keyboard: array, one_time_keyboard: bool, resize_keyboard: bool}
     */
    public function toArray()
    {
        $result = [
            'keyboard' => array_filter($this->buttons),
            'resize_keyboard' => $this->resize_keyboard,
            'one_time_keyboard' => $this->one_time_keyboard,
        ];

        if ($this->selective) {
            $result['selective'] = $this->selective;
        }

        if (!empty($this->input_field_placeholder)) {
            $result['input_field_placeholder'] = $this->input_field_placeholder;
        }

        return $result;
    }


    public function toJson(){
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}