<?php
namespace Botfire\Responses\Models;


class PhotoCollection {
    private $items;

    public function __construct($data) {
        foreach ($data as $itemData) {
            $this->items[] = new PhotoItem($itemData);
        }
    }

    public function getFirst() {
        return $this->items[0];
    }

    public function getLast() {
        return end($this->items);
    }

    public function count() {
        return count($this->items);
    }

    public function getIndex($index) {
        return $this->items[$index];
    }

    public function getData() {
        return $this->items;
    }

    public function each(callable $callback) {
        foreach ($this->items as $item) {
            $callback($item);
        }
    }
}