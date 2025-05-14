<?php
namespace Botfire;

class MarkupKeyboard {
    private $buttons = [];
    private $currentRow = -1;

    public function __construct() {
        $this->row();
    }

    public function btn($text) {
        $this->buttons[$this->currentRow][] = [
            'text' => $text
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
            'keyboard' => array_filter($this->buttons),
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];
    }
}