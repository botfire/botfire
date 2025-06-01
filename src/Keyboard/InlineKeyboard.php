<?php
namespace Botfire\Keyboard;


use Botfire\Keyboard\InlineButton;

class InlineKeyboard
{


    protected $buttons = [];
    protected $currentRow = 0;



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