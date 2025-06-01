<?php
namespace Botfire;

use Botfire\Models\KeybardOption;

class InlineKeyboard
{


    protected $buttons = [];
    protected $currentRow = 0;


    public function row(array $buttons = [])
    {
        if (!empty($buttons)) {
            $this->buttons[] = array_map(function ($button) {
                if ($button instanceof InlineKeyboardButton) {
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



    public function toArray()
    {
        return [
            'inline_keyboard' => array_filter($this->buttons)
        ];
    }

    public function toJson(){
        return json_encode($this->toArray());
    }
}