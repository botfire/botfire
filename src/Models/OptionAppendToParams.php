<?php
namespace Botfire\Models;

trait OptionAppendToParams
{

    protected $data = [];


    public function appendToSendParams(&$data)
    {
        foreach ($this->data as $key => $value) {
            $data[$key] = $value;
        }
    }

}