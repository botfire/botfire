<?php
namespace Botfire\Responses\Traits;

trait OkResponseTrait
{


    protected $json_result;


    public function isOK(): bool
    {
        return $this->json_result['ok'] ?? false;
    }


    public function getErrorCode(): int
    {
        return $this->json_result['error_code'] ?? 0;
    }


    public function getErrorMessage(): string{
        return $this->json_result['description'] ?? ($this->isOK() ? '' : 'Unknown error');
    }
}