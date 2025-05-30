<?php
namespace Botfire;


class MessageParser
{

    /**
     * Input data from the request.
     * @var array
     */
    private array $input;


    /**
     * Message body from the request.
     * This will contain the message data if it exists.
     * @var array
     */
    private array $messageBody = [];

    /**
     * Callback data from the request.
     * @var array
     */
    private array $callbackBody = [];


    /**
     * Indicates if the message body exists.
     * @var bool
     */
    private bool $hasMessage = false;


    /**
     * Indicates if the callback body exists.
     * @var bool
     */
    private bool $hasCallback = false;


    /**
     * Constructor to initialize the input data.
     * @param array $input The input data from the request.
     */
    public function __construct(array $input)
    {
        $this->input = $input;
        $this->parse();
    }


    /**
     * Parse the input data to extract message and callback information.
     * This method checks if the input contains a callback query and separates
     * the message and callback data accordingly.
     */
    private function parse()
    {
        $input = $this->input;

        if (isset($input[GetMessage::TYPE_CALLBACK_QUERY])) {

            $message = ['message' => $input[GetMessage::TYPE_CALLBACK_QUERY]['message']];

            unset($input[GetMessage::TYPE_CALLBACK_QUERY]['message']);

            $callback = $input[GetMessage::TYPE_CALLBACK_QUERY];

            $this->messageBody = $message;
            $this->callbackBody = $callback;

            $this->hasMessage = true;
            $this->hasCallback = true;
        } else {
            $this->messageBody = $input;
            $this->callbackBody = [];

            $this->hasMessage = true;
            $this->hasCallback = false;
        }

        $this->input = [];
    }


    /**
     * Get the message body.
     * @return array
     */
    public function getMessageBody(): array
    {
        return $this->messageBody;
    }

    /**
     * Get the callback body.
     * @return array
     */
    public function getCallbackBody(): array
    {
        return $this->callbackBody;
    }

    /**
     * Check if the message body exists.
     * @return bool
     */
    public function hasMessage(): bool
    {
        return $this->hasMessage;
    }

    /**
     * Check if the callback body exists.
     * @return bool
     */
    public function hasCallback(): bool
    {
        return $this->hasCallback;
    }
}

