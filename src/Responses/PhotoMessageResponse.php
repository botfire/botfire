<?php

namespace Botfire\Responses;

use Botfire\Responses\Traits\OkResponseTrait;


class PhotoMessageResponse
{

    protected $json_result;

    use OkResponseTrait;



    public function __construct($response)
    {
        $this->json_result = $response;
    }


    public function getResult()
    {
        return new PhotoMessageResult($this->json_result['result']);
    }

}