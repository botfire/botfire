<?php
namespace Botfire;

class Keyboard {
    private $buttons = [];
    private $currentRow = -1;

    public function __construct() {
        $this->row();
    }

    public function btn($text, $callback_data) {
        $this->buttons[$this->currentRow][] = [
            'text' => $text,
            'callback_data' => $callback_data
        ];
        return $this;
    }

    public function btnUrl($text, $url) {
        $this->buttons[$this->currentRow][] = [
            'text' => $text,
            'url' => $url
        ];
        return $this;
    }

    public function row() {
        $this->currentRow++;
        $this->buttons[$this->currentRow] = [];
        return $this;
    }

    public function autoRow($columns) {
        $newButtons = [];
        $row = [];
        foreach ($this->buttons as $buttonRow) {
            foreach ($buttonRow as $button) {
                $row[] = $button;
                if (count($row) >= $columns) {
                    $newButtons[] = $row;
                    $row = [];
                }
            }
        }
        if ($row) {
            $newButtons[] = $row;
        }
        $this->buttons = $newButtons;
        return $this;
    }

    public function toArray() {
        return [
            'inline_keyboard' => array_filter($this->buttons)
        ];
    }
}