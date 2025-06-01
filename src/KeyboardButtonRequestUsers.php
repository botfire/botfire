<?php
namespace Botfire;

/**
 * Represents the criteria used to request suitable users.
 * Information about the selected users will be shared with the bot
 * when the corresponding button is pressed.
 */
class KeyboardButtonRequestUsers
{
    private int $request_id;
    private ?bool $user_is_bot;
    private ?bool $user_is_premium;
    private int $max_quantity;
    private ?bool $request_name;
    private ?bool $request_username;
    private ?bool $request_photo;

    /**
     * Constructor to initialize the KeyboardButtonRequestUsers object.
     *
     * @param int $request_id Signed 32-bit identifier of the request. Must be unique within the message.
     */
    public function __construct(int $request_id) {
        $this->requestId($request_id);
    }

    
    // Setters

    public function requestId(int $request_id): void
    {
        $this->request_id = $request_id;
    }

    public function userIsBot(?bool $user_is_bot): void
    {
        $this->user_is_bot = $user_is_bot;
    }

    public function userIsPremium(?bool $user_is_premium): void
    {
        $this->user_is_premium = $user_is_premium;
    }

    public function maxQuantity(int $max_quantity): void
    {
        if ($max_quantity < 1 || $max_quantity > 10) {
            throw new \InvalidArgumentException("max_quantity must be between 1 and 10.");
        }
        $this->max_quantity = $max_quantity;
    }

    public function requestName(?bool $request_name): void
    {
        $this->request_name = $request_name;
    }

    public function requestUsername(?bool $request_username): void
    {
        $this->request_username = $request_username;
    }

    public function requestPhoto(?bool $request_photo): void
    {
        $this->request_photo = $request_photo;
    }

    public function toArray(): array
    {
        $data = [
            'request_id' => $this->request_id,
            'user_is_bot' => $this->user_is_bot,
            'user_is_premium' => $this->user_is_premium,
            'max_quantity' => $this->max_quantity,
        ];

        if ($this->request_name !== null) {
            $data['request_name'] = $this->request_name;
        }
        if ($this->request_username !== null) {
            $data['request_username'] = $this->request_username;
        }
        if ($this->request_photo !== null) {
            $data['request_photo'] = $this->request_photo;
        }

        return $data;
    }
}