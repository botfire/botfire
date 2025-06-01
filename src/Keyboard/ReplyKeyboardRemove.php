<?php
namespace Botfire\Keyboard;

class ReplyKeyboardRemove{

    private bool $selective = false;


    public function setSelective(bool $selective): static {
        $this->selective = $selective;
        return $this;
    }

    public function toArray() {
        return [
            'remove_keyboard' => true,
            'selective' => $this->selective,
        ];
    }
}